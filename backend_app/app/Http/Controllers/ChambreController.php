<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return response()->json(Chambre::all());
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Chambre::findOrFail($id));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type_chambre_id' => 'required|exists:type_chambres,id',
            'tarif' => 'required|numeric|min:0',
            'climatisation' => 'required',
            'repas' => 'required',
            'nombre_lits' => 'required|numeric|min:1|max:10',
            'frais_annulation' => 'required',
            'numero_telephone' => 'required|numeric|min:1',
            'fichier_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'message' => 'required|string',
        ]);
        if($request->hasFile('fichier_upload')){
            $validated['fichier_upload'] = $request->file('fichier_upload')->store('chambres','public');
        }
        $chambre = Chambre::create($validated);
        return response()->json($chambre, 201);
    }

    public function update(Request $request, $id) {
        $chambre = Chambre::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'type_chambre_id' => 'sometimes|exists:type_chambres,id',
            'tarif' => 'sometimes|numeric|min:0',
            'climatisation' => 'sometimes',
            'repas' => 'sometimes',
            'nombre_lits' => 'sometimes|numeric|min:1|max:10',
            'frais_annulation' => 'sometimes',
            'numero_telephone' => 'sometimes|numeric|min:1',
            'fichier_upload' => 'nullable|max:2048',
            'message' => 'sometimes|string',
        ]);

        if($request->hasFile('fichier_upload')){
            if($chambre->avatar){
                Storage::disk('public')->delete($chambre->fichier_upload);
            }
            $validated['fichier_upload'] = $request->file('fichier_upload')->store('chambres','public');
        }


        $chambre->update($validated);
        return response()->json($chambre);
    }
    public function destroy($id) {
        Chambre::destroy($id);
        return response()->json(null, 204);
    }
}
