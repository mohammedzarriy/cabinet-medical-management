<?php

namespace Database\Factories;

use App\Models\Rendezvous;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rendezvous>
 */
class RendezvousFactory extends Factory
{
    protected $model = Rendezvous::class;

    public function definition(): array
    {
        return [
            'patient_id' => User::where('role', 'patient')->inRandomOrder()->first()?->id ?? User::factory()->patient(),
            'medecin_id' => User::where('role', 'medecin')->inRandomOrder()->first()?->id ?? User::factory()->medecin(),
            'service_id' => Service::inRandomOrder()->first()?->id ?? Service::factory(),
            'date_heure' => $this->faker->dateTimeBetween('+1 day', '+60 days'),
            'statut'     => $this->faker->randomElement(['en_attente', 'confirme', 'annule']),
        ];
    }
}
