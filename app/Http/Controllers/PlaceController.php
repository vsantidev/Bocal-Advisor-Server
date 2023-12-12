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
        $tests = Place::all();
        foreach ($tests as $test) {
            $category = $test->categories->name_category;
            dd($test);
        }
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
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000'
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
                'category' => $request->category_id,
                'street' => $request->street,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'description' => $request->description,
                'file' => $fileName,
            ]);

            return response()->json([
                'status' => 'true',
                'message' => 'Lieu créé avec succès',
                $place
            ]);
        }

        if (!$request->file('file')->isValid()) {
            return response()->json(['status' => 'false', 'message' => 'File upload failed']);
        }
    }
}
