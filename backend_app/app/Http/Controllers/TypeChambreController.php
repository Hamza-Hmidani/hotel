<?php

namespace App\Http\Controllers;

use App\Models\TypeChambre;
use Illuminate\Http\Request;

class TypeChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(TypeChambre::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'nom_chambre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $typeChambre = TypeChambre::create($validated);
        return response()->json($typeChambre, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(TypeChambre::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nom_chambre' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ]);

        $typeChambre = TypeChambre::findOrFail($id);
        $typeChambre->update($validated);
        return response()->json($typeChambre);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TypeChambre::destroy($id);
        return response()->json(null, 204);
    }
}
