<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required',
            'birthday' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'data' => $validator->errors()
            ]);
        } else {
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => $request->password,
                'username' => $request->username,
                'birthday' => $request->birthday,
                'role' => $request->role,

            ]);

            $token = $user->createToken('remember_token')->plainTextToken;

            return response()->json([
                'status' => 'true',
                'message' => 'Utilisateur inscrit avec succès',
                'user' => $user,
                'token' => $token,
            ]);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Utilisation de Sanctum pour créer un jeton d'accès
            $token = $user->createToken(time())->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user, 
            ]);
        } else {
            return response()->json(['error' => 'Email ou mot de passe incorrect'], 401);
        }
    }

    public function dashboard(Request $request): JsonResponse
    {

        $user = $request->user();


        $userData = [
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'pseudo' => $user->username,
            'email' => $user->email,
            'birthday' => $user->birthday,
            'password' => $user->password,
            'role' => $user->role

        ];

        return response()->json(['success' => $userData]);
    }

    public function updateUser(Request $request): JsonResponse
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'pseudo' => 'required',
            'email' => 'required',
            'birthday' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'data' => $validator->errors()
            ]);
        }

        $user->update([
            'id' => $user->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return response()->json([
        'status' => 'true',
        'message' => 'Profil utilisateur mis à jour avec succès',
        'user' => $user,
        ]);
    }
}
