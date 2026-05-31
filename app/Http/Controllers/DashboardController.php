<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = [
            'totalServices' => Service::count(),
        ];

        if ($user->isAdmin()) {
            $data['totalRendezvous'] = Rendezvous::count();
            $data['enAttente']       = Rendezvous::where('statut', 'en_attente')->count();
            $data['confirmes']       = Rendezvous::where('statut', 'confirme')->count();
            $data['annules']         = Rendezvous::where('statut', 'annule')->count();
            $data['totalPatients']   = User::where('role', 'patient')->count();
            $data['totalMedecins']   = User::where('role', 'medecin')->count();
            $data['derniers']        = Rendezvous::with(['patient', 'medecin', 'service'])
                                        ->orderByDesc('created_at')->limit(5)->get();
        } elseif ($user->isMedecin()) {
            $data['totalRendezvous'] = Rendezvous::where('medecin_id', $user->id)->count();
            $data['enAttente']       = Rendezvous::where('medecin_id', $user->id)->where('statut', 'en_attente')->count();
            $data['confirmes']       = Rendezvous::where('medecin_id', $user->id)->where('statut', 'confirme')->count();
            $data['derniers']        = Rendezvous::with(['patient', 'service'])
                                        ->where('medecin_id', $user->id)
                                        ->orderByDesc('date_heure')->limit(5)->get();
        } else {
            $data['totalRendezvous'] = Rendezvous::where('patient_id', $user->id)->count();
            $data['enAttente']       = Rendezvous::where('patient_id', $user->id)->where('statut', 'en_attente')->count();
            $data['confirmes']       = Rendezvous::where('patient_id', $user->id)->where('statut', 'confirme')->count();
            $data['derniers']        = Rendezvous::with(['medecin', 'service'])
                                        ->where('patient_id', $user->id)
                                        ->orderByDesc('date_heure')->limit(5)->get();
        }

        return view('dashboard', $data);
    }
}
