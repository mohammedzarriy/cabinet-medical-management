<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    private static array $services = [
        ['nom' => 'Consultation Générale',  'description' => 'Examen médical général et diagnostic', 'prix' => 200],
        ['nom' => 'Radiologie',             'description' => 'Imagerie médicale et radiographies', 'prix' => 350],
        ['nom' => 'Analyse de Sang',        'description' => 'Prélèvement et analyse sanguine', 'prix' => 150],
        ['nom' => 'Cardiologie',            'description' => 'Consultation et électrocardiogramme', 'prix' => 400],
        ['nom' => 'Dermatologie',           'description' => 'Traitement des maladies de la peau', 'prix' => 250],
        ['nom' => 'Ophtalmologie',          'description' => 'Examen de la vue et correction', 'prix' => 300],
        ['nom' => 'Pédiatrie',              'description' => 'Soins médicaux pour enfants', 'prix' => 200],
        ['nom' => 'Orthopédie',             'description' => 'Traumatologie et troubles osseux', 'prix' => 450],
    ];

    private static int $index = 0;

    public function definition(): array
    {
        $service = self::$services[self::$index % count(self::$services)];
        self::$index++;
        return $service;
    }
}