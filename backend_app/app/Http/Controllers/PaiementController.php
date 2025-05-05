<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index() {
        return response()->json(Paiement::all());
    }

    public function show($id) {
        return response()->json(Paiement::findOrFail($id));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'id_reservation' => 'required|exists:reservations,id',
            'montant' => 'required|numeric|min:0',
            'methode_paiement' => 'required|string|max:255',
            'statut' => 'string|in:payé,en attente,échoué',
            'numero_carte' => 'nullable|string|digits:16', // Ensure it's a 16-digit card number
            'CCV' => 'nullable|string|digits:3', // Ensure it's a 3-digit numeric value
            'email_paypal' => 'nullable|string|email|max:255', // Validate as a proper email
            'compte' => 'nullable|string|max:255', // Limit the length of the account string
        ]);

        $paiement = Paiement::create($validated);
        return response()->json($paiement, 201);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'id_reservation' => 'sometimes|exists:reservations,id',
            'montant' => 'sometimes|numeric|min:0',
            'methode_paiement' => 'sometimes|string|max:255',
            'statut' => 'sometimes|string|in:payé,en attente,échoué',
            'numero_carte' => 'nullable|string|digits:16', // Ensure it's a 16-digit card number
            'CCV' => 'nullable|string|digits:3', // Ensure it's a 3-digit numeric value
            'email_paypal' => 'nullable|string|email|max:255', // Validate as a proper email
            'compte' => 'nullable|string|max:255', // Limit the length of the account string
        ]);

        $paiement = Paiement::findOrFail($id);
        $paiement->update($validated);
        return response()->json($paiement);
    }

    public function destroy($id) {
        Paiement::destroy($id);
        return response()->json(null, 204);
    }
}
