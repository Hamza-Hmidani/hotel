<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'type_chambre_id', 'climatisation', 'repas',
        'nombre_lits', 'frais_annulation', 'tarif', 'numero_telephone',
        'fichier_upload', 'message'
    ];

    public function typeChambre()
    {
        return $this->belongsTo(TypeChambre::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
