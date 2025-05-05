<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accompagnant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reservation_id',
        'nom',
        'prenom',
        'age',
        'cin',
        'relation',
    ];

    /**
     * Get the reservation associated with the accompagnant.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
