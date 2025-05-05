<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $reservations = Reservation::paginate(5); // 5 réservations par page
        // $total = Reservation::count();
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    public function count()
    {
        $total = Reservation::count();
        return response()->json(['total'=>$total]);
    }

    public function paginated()
    {
        $reservations = Reservation::paginate(5); // 5 réservations par page
        return response()->json($reservations);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'id_client' => 'required|exists:users,id',
            'id_chambre' => 'required|exists:chambres,id',
            'date_arrivee' => 'required|date|after:today',
            'date_depart' => 'required|date|after:date_arrivee',
            'statut' => 'required|string|in:confirmée,en attente,annulée,présente', // Ajout du statut "présent"
        ]);

        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Reservation::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'id_client' => 'sometimes|exists:users,id',
            'id_chambre' => 'sometimes|exists:chambres,id',
            'date_arrivee' => 'sometimes|date|after:today',
            'date_depart' => 'sometimes|date|after:date_arrivee',
            'statut' => 'sometimes|string|in:confirmée,en attente,annulée,présente', // Ajout du statut "présent"
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($validated);
        return response()->json($reservation);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Reservation::destroy($id);
        return response()->json(null, 204);
    }


}
