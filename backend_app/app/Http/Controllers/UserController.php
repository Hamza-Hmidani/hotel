<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Lister tous les utilisateurs
    public function index()
    {
        return response()->json(User::all(),200);
    }

    // Afficher un utilisateur spécifique
    public function show($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Utilisateur non trouvé'],404);
        }
        return response()->json($user,200);
    }

     // Ajouter un utilisateur
     public function store(Request $request)
     {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'mot_de_passe' => 'required|string|min:6',
            'role' => ['required', Rule::in(['admin', 'employe', 'client'])],
            'numero_telephone' => 'nullable|string|max:20',
            'statut' => ['nullable', Rule::in(['actif', 'inactif', 'suspendu'])],
            'message' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_chambre' => 'nullable|exists:chambres,id',
            'fichier_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cin' => 'required|string',
            'adresse' => 'required|string',
        ]);

        $validated['mot_de_passe'] = Hash::make($validated['mot_de_passe']);

        if($request->hasFile('avatar')){
            $validated['avatar'] = $request->file('avatar')->store('users','public');
        }
        if($request->hasFile('fichier_upload')){
            $validated['fichier_upload'] = $request->file('fichier_upload')->store('users','public');
        }

        $user = User::create($validated);
        return response()->json($user,201);
     }

    // Mettre à jour un utilisateur
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Utilisateur non trouvé'],404);
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'mot_de_passe' => 'required|string|min:6',
            'role' => ['required', Rule::in(['admin', 'employe', 'client'])],
            'numero_telephone' => 'nullable|string|max:20',
            'statut' => ['nullable', Rule::in(['actif', 'inactif', 'suspendu'])],
            'message' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_chambre' => 'nullable|exists:chambres,id',
            'fichier_upload' => 'nullable',
            'cin' => 'required|string',
            'adresse' => 'required|string',
        ]);

        if($request->has('mot_de_passe')){
            $validated['mot_de_passe'] = Hash::make($request->mot_de_passe);
        }

        if($request->hasFile('avatar')){
            if($user->avatar){
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('users','public');
        }
        if($request->hasFile('fichier_upload')){
            if($user->avatar){
                Storage::disk('public')->delete($user->fichier_upload);
            }
            $validated['fichier_upload'] = $request->file('fichier_upload')->store('users','public');
        }

        $user->update($validated);
        return response()->json($user,200);

    }

    // Supprimer un utilisateur
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Utilisateur non trouvé'],404);
        }

        if($user->avatar){
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        return response()->json(['message' => 'Utilisateur supprimé'],200);
    }
}
