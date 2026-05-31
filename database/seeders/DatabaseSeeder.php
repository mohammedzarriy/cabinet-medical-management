<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Rendezvous;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1 Admin ──
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@cabinet.test',
            'password' => Hash::make('123456789'),
            'role'     => 'admin',
            'telephone'=> '0600000001',
        ]);

        // ── 1 Médecin ──
        User::create([
            'name'       => 'Dr. Ahmed Benali',
            'email'      => 'medecin@cabinet.test',
            'password'   => Hash::make('123456789'),
            'role'       => 'medecin',
            'telephone'  => '0600000002',
            'specialite' => 'Cardiologie',
        ]);

        // ── 1 Patient ──
        User::create([
            'name'     => 'Fatima Zahra',
            'email'    => 'patient@cabinet.test',
            'password' => Hash::make('123456789'),
            'role'     => 'patient',
            'telephone'=> '0600000003',
        ]);

        // ── 7 extra users (mix of medecin/patient) ──
        User::factory(3)->medecin()->create();
        User::factory(4)->patient()->create();

        // ── 5 Services ──
        Service::factory(5)->create();

        // ── 20 Rendez-vous ──
        $patients = User::where('role', 'patient')->get();
        $medecins = User::where('role', 'medecin')->get();
        $services = Service::all();

        for ($i = 0; $i < 20; $i++) {
            Rendezvous::create([
                'patient_id' => $patients->random()->id,
                'medecin_id' => $medecins->random()->id,
                'service_id' => $services->random()->id,
                'date_heure' => now()->addDays(rand(1, 60))->setHour(rand(8, 17))->setMinute(0),
                'statut'     => ['en_attente', 'confirme', 'annule'][rand(0, 2)],
            ]);
        }
    }
}