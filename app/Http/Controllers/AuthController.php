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
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                'token' => $user->createToken(time())->plainTextToken
            ]);
        }else{
            return ['error' => 'Email ou mot de passe incorrect'];
        }
        return $user;
    }

    public function dashboard(): JsonResponse
    {
        return response()->json([
            'success' => 'Bienvenue!'
        ]);
    }

    
}
