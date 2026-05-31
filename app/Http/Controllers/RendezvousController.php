<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use App\Models\Service;
use App\Models\User;
use App\Mail\RendezvousConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RendezvousController extends Controller
{
    /**
     * List rendezvous filtered by role.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Rendezvous::with(['patient', 'medecin', 'service']);

        if ($user->isPatient()) {
            $query->where('patient_id', $user->id);
        } elseif ($user->isMedecin()) {
            $query->where('medecin_id', $user->id);
        }
        // admin sees all

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', fn($q2) => $q2->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('medecin', fn($q2) => $q2->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('service', fn($q2) => $q2->where('nom', 'like', "%{$search}%"));
            });
        }

        $rendezvous = $query->orderByDesc('date_heure')->paginate(10);
        $services = Service::all();
        $medecins = User::where('role', 'medecin')->get();
        $patients = User::where('role', 'patient')->get();

        if ($request->ajax()) {
            return view('rendezvous.partials.table', compact('rendezvous', 'services', 'medecins', 'patients'))->render();
        }

        return view('rendezvous.index', compact('rendezvous', 'services', 'medecins', 'patients'));
    }

    /**
     * Store a new rendezvous.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medecin_id'  => 'required|exists:users,id',
            'service_id'  => 'required|exists:services,id',
            'date_heure'  => 'required|date|after:now',
        ]);

        $user = Auth::user();
        $patientId = $user->isAdmin() ? $request->input('patient_id') : $user->id;
        $medecinId = $request->input('medecin_id');
        $dateHeure = Carbon::parse($request->input('date_heure'));

        // ── Conflict 1h rule ──
        $conflict = $this->hasConflict($medecinId, $patientId, $dateHeure);
        if ($conflict) {
            return back()->withErrors(['date_heure' => __('Conflit : un rendez-vous existe déjà dans un créneau d\'1 heure pour ce médecin ou ce patient.')])->withInput();
        }

        Rendezvous::create([
            'patient_id' => $patientId,
            'medecin_id' => $medecinId,
            'service_id' => $request->input('service_id'),
            'date_heure' => $dateHeure,
            'statut'     => 'en_attente',
        ]);

        return redirect()->route('rendezvous.index')->with('success', __('Rendez-vous créé avec succès.'));
    }

    /**
     * Update an existing rendezvous.
     */
    public function update(Request $request, Rendezvous $rendezvou)
    {
        $request->validate([
            'medecin_id'  => 'required|exists:users,id',
            'service_id'  => 'required|exists:services,id',
            'date_heure'  => 'required|date|after:now',
        ]);

        $user = Auth::user();
        $patientId = $user->isAdmin() ? $request->input('patient_id', $rendezvou->patient_id) : $rendezvou->patient_id;
        $medecinId = $request->input('medecin_id');
        $dateHeure = Carbon::parse($request->input('date_heure'));

        // ── Conflict 1h rule ──
        $conflict = $this->hasConflict($medecinId, $patientId, $dateHeure, $rendezvou->id);
        if ($conflict) {
            return back()->withErrors(['date_heure' => __('Conflit : un rendez-vous existe déjà dans un créneau d\'1 heure pour ce médecin ou ce patient.')])->withInput();
        }

        $rendezvou->update([
            'patient_id' => $patientId,
            'medecin_id' => $medecinId,
            'service_id' => $request->input('service_id'),
            'date_heure' => $dateHeure,
        ]);

        return redirect()->route('rendezvous.index')->with('success', __('Rendez-vous modifié avec succès.'));
    }

    /**
     * Delete a rendezvous.
     */
    public function destroy(Rendezvous $rendezvou)
    {
        $rendezvou->delete();
        return redirect()->route('rendezvous.index')->with('success', __('Rendez-vous supprimé.'));
    }

    /**
     * Confirm a rendezvous (admin only).
     */
    public function confirm(Rendezvous $rendezvou)
    {
        $rendezvou->update(['statut' => 'confirme']);

        // Send confirmation email
        $rendezvou->load(['patient', 'medecin', 'service']);
        Mail::to($rendezvou->patient->email)->send(new RendezvousConfirmation($rendezvou));

        return redirect()->route('rendezvous.index')->with('success', __('Rendez-vous confirmé et email envoyé.'));
    }

    /**
     * Cancel a rendezvous.
     */
    public function cancel(Rendezvous $rendezvou)
    {
        $rendezvou->update(['statut' => 'annule']);
        return redirect()->route('rendezvous.index')->with('success', __('Rendez-vous annulé.'));
    }

    /**
     * Check for 1-hour conflict on medecin OR patient.
     */
    private function hasConflict(int $medecinId, int $patientId, Carbon $dateHeure, ?int $excludeId = null): bool
    {
        $start = $dateHeure->copy()->subHour();
        $end   = $dateHeure->copy()->addHour();

        $query = Rendezvous::where('statut', '!=', 'annule')
            ->whereBetween('date_heure', [$start, $end])
            ->where(function ($q) use ($medecinId, $patientId) {
                $q->where('medecin_id', $medecinId)
                  ->orWhere('patient_id', $patientId);
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}
