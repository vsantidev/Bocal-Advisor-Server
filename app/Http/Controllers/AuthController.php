<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required',
            'birthday' => 'required',
            'role' => 'required'
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
                'role' => $request->role
            ]);

            return response()->json([
                'status' => 'true',
                'message' => 'Utilisateur inscrit avec succès',
                'token' => $user->createToken('register_token')->plainTextToken
            ]);
        }
    }
}
