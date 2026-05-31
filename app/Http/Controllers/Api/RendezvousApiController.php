<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rendezvous;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RendezvousApiController extends Controller
{
    /**
     * GET /api/rendezvous
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

        return response()->json($query->orderByDesc('date_heure')->paginate(15));
    }

    /**
     * POST /api/rendezvous
     */
    public function store(Request $request)
    {
        $request->validate([
            'medecin_id'  => 'required|exists:users,id',
            'service_id'  => 'required|exists:services,id',
            'date_heure'  => 'required|date|after:now',
            'patient_id'  => 'sometimes|exists:users,id',
        ]);

        $user = Auth::user();
        $patientId = $user->isAdmin() ? $request->input('patient_id', $user->id) : $user->id;
        $medecinId = $request->input('medecin_id');
        $dateHeure = Carbon::parse($request->input('date_heure'));

        // Conflict check
        $start = $dateHeure->copy()->subHour();
        $end   = $dateHeure->copy()->addHour();

        $conflict = Rendezvous::where('statut', '!=', 'annule')
            ->whereBetween('date_heure', [$start, $end])
            ->where(function ($q) use ($medecinId, $patientId) {
                $q->where('medecin_id', $medecinId)
                  ->orWhere('patient_id', $patientId);
            })->exists();

        if ($conflict) {
            return response()->json([
                'message' => 'Conflit : un rendez-vous existe déjà dans un créneau d\'1 heure.'
            ], 422);
        }

        $rdv = Rendezvous::create([
            'patient_id' => $patientId,
            'medecin_id' => $medecinId,
            'service_id' => $request->input('service_id'),
            'date_heure' => $dateHeure,
            'statut'     => 'en_attente',
        ]);

        return response()->json($rdv->load(['patient', 'medecin', 'service']), 201);
    }

    /**
     * GET /api/services
     */
    public function services()
    {
        return response()->json(Service::all());
    }
}
