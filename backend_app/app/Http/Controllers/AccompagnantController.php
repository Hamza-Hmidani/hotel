<?php

namespace App\Http\Controllers;

use App\Models\Accompagnant;
use Illuminate\Http\Request;

class AccompagnantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accompagnants = Accompagnant::all();
        return response()->json($accompagnants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'cin' => 'nullable|string|max:20',
            'relation' => 'required|in:ami,famille,collègue,autre',
        ]);



        $accompagnant = Accompagnant::create($validated);
        return response()->json($accompagnant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $accompagnant = Accompagnant::findOrFail($id);
        return response()->json($accompagnant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $accompagnant = Accompagnant::findOrFail($id);

        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'cin' => 'nullable|string|max:20',
            'relation' => 'required|in:ami,famille,collègue,autre',
        ]);

        $accompagnant->update($validated);
        return response()->json($accompagnant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $accompagnant = Accompagnant::findOrFail($id);
        $accompagnant->delete();
        return response()->json(['message' => 'Accompagnant supprimé'], 200);
    }
}
