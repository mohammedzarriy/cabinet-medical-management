<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rendezvous extends Model
{
    use HasFactory;

    protected $table = 'rendezvous';

    protected $fillable = [
        'patient_id',
        'medecin_id',
        'service_id',
        'date_heure',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'date_heure' => 'datetime',
        ];
    }

    // ── Relations ──

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}