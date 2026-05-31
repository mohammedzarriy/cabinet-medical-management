<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
    ];

    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class);
    }
}
