<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['id_client', 'id_chambre', 'date_arrivee', 'date_depart', 'statut'];

    public function client()
    {
        return $this->belongsTo(User::class, 'id_client');
    }

    public function chambre()
    {
        return $this->belongsTo(Chambre::class, 'id_chambre');
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'id_reservation');
    }

    public function accompagnants()
    {
        return $this->hasMany(Accompagnant::class);
    }
}
