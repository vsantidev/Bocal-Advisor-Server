<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function renderPlace()
    {

        // Récupère tous les endroits enregistrés dans la bdd et les renvoie en format json
        $place = Place::all()->sortBy('name');
        return response()->json([
            'status' => 'true',
            'message' => 'Voici vos lieux',
            $place
        ]);
    }

    public function place(Request $request)
    {
        // Vérifie que tous les champs requis sont bien renseignés
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Enregistre l'image dans public/storage/images en local sur vscode
        $fileName = time() . '.' . $request->file->extension();
        $request->file->storeAs('public/images', $fileName);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'data' => $validator->errors()
            ]);
        } else {

            // Créé le lieu dans la bdd et le renvoie en format json 
            $place = Place::create([
                'title' => $request->title,
                'category_id' => $request->category,
                'street' => $request->street,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'description' => $request->description,
                'file' => $fileName
            ]);

            return response()->json([
                'status' => 'true',
                'message' => 'Lieu créé avec succès',
                $place
            ]);
        }
    }
}
