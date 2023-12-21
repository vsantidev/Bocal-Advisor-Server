<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Selected_category;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function index()
    {
        $category = DB::table('categories')
            ->get();

        return response()->json([
            $category
        ]);
    }

    public function renderPlace()
    {
        // Récupère tous les lieux enregistrés dans la bdd et les catégories associées
        $places = DB::table('places')
            ->select('places.*', "category_place.*", "categories.id as id_categories", "categories.name_category as name_category")
            ->leftJoin('category_place', 'places.id', 'category_place.place_id')
            ->leftJoin('categories', 'category_place.category_id', 'categories.id')
            ->get();

        // Génère pour chaque lieu une url de l'image associée au lieu
        foreach ($places as $place) {
            $place->file = asset('storage/images/' . $place->file);
        }

        return response()->json([
            'status' => 'true',
            'message' => 'Voici vos lieux',
            $places
        ]);
    }

    public function place(Request $request)
    {

        // Vérifie que tous les champs requis sont bien renseignés puis les valide

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
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

            // Vérifie que le lieu n'est pas déjà existant
            $verifyPlace = DB::table('places')
                ->where('places.title', $request->title)
                ->where('places.street', $request->street)
                ->get();

            if ($verifyPlace->count() == 0) {

                $user_id = Auth::id();

               
                // Créé le lieu dans la bdd et le renvoie en format json 
                $place = Place::create([
                    'title' => $request->title,
                    'category' => $request->category_id,
                    'street' => $request->street,
                    'postcode' => $request->postcode,
                    'city' => $request->city,
                    'description' => $request->description,
                    'file' => $fileName,
                    'user_id' => $user_id,

                    /*                     'x' => $request->x,
                    'y' => $request->y, */
                ]);

                // Sélectionne dans la bdd le lieu dont le title et la street matchent les valeurs de la requête

                $findPlace = DB::table('places')
                    ->where('places.title', $request->title)
                    ->where('places.street', $request->street)
                    ->get();

                // Pour chaque lieu
                foreach ($findPlace as $key => $element) {
                    // Récupère le lieu grâce a son ID
                    $pla = Place::find($element->id);
                    // Synchronise la/les catégorie(s) associées au lieu
                    $cat = $pla->categories()->sync($request->category);
                }
                return response()->json([
                    'status' => 'true',
                    'message' => 'Lieu créé avec succès',
                    $cat,
                    $findPlace,
                ]);
            } else {
                return response()->json([
                    'status' => 'false',
                    'message' => 'Ce lieu existe déja',
                    // $cat,
                ]);
            }
        }
        if (!$request->file('file')->isValid()) {
            return response()->json(['status' => 'false', 'message' => "L'image n'a pas pu être téléchargée"]);
        }
    }

    public function show(Place $place, Int $id)
    {

        // Récupère le lieu par son ID
        $place = Place::find($id);
        // Génère une url de l'image associée au lieu
        $place->file = asset('storage/images/' . $place->file);
        // Récupère le(s) commentaire(s) associés à l'ID du lieu
        $reviews = DB::table('Reviews')->where('reviews.place_id', $id)->get();
        // Génère pour chaque commentaire une url de l'image associée au commentaire
        foreach ($reviews as $review) {
            $review->file_review = asset('storage/images/' . $review->file_review);
        }
       
        return response()->json([
            'status' => 'true',
            'place' => $place,
            'review' => $reviews
        ]);
    }

    public function edit(Request $request)
    {
        // Valide les données de la requête
        $request->validate([
            'title' => 'required',
            'street' => 'required',
            'description' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            // 'category' => 'required',
            'file' => 'required'
        ]);

        // Récupère le lieu par son ID
        $place = Place::findOrFail($request->id);
        // Remplace les données existantes par celles de la requête
        $place->title = $request->title;
        $place->street = $request->street;
        $place->description = $request->description;
        $place->postcode = $request->postcode;
        $place->city = $request->city;
        $place->file = $request->file;
        // Sauvegarde les changements dans la bdd
        $place->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Lieu modifié avec succès',
        ]);
    }

    public function destroy(Place $place, $id)
    {
        // Récupère le lieu par son ID
        $place = Place::findOrFail($id);
        // Supprime le lieu et tout ce qui lui est associé
        $place->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'Lieu supprimé avec succès',
            'place' => $place
        ]);
    }
}
