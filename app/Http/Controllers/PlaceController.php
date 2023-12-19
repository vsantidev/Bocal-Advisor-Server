<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Selected_category;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function renderPlace()
    {

        // Récupère tous les lieux enregistrés dans la bdd
        $places = DB::table('places')
            ->select('places.*', "selected_categories.*", "categories.id as id_categories", "categories.name_category as name_category")
            ->leftJoin('selected_categories', 'places.id', 'selected_categories.place_id')
            ->leftJoin('categories', 'selected_categories.category_id', 'categories.id')
            ->get();

        // Récupère les images dans leur emplacement
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

        // Vérifie que tous les champs requis soient bien renseignés
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

            // Créé le lieu dans la bdd 
            $place = Place::create([
                'title' => $request->title,
                'category' => $request->category_id,
                'street' => $request->street,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'description' => $request->description,
                'file' => $fileName,

            ]);


            // Renvoie le lieu en format JSON
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

    public function show(Place $place, Int $id)
    {
        // $place['category_id'] = $place->getCategory();

        // Récupère l'ID du lieu à afficher
        $place = Place::find($id);

        // $review = Review::select(['place_id'])->find(1);
        // $reviews = Review::with('place_id')->get();

        // Récupère l'ID du commentaire à afficher
        $review = DB::table('Reviews')->where('reviews.place_id', $id)->get();
        // $place->reviews()->where('reviews.place_id', $id)->get();

        $place->file = asset('storage/images/' . $place->file);


        // $note = Note::where('book_id', $book->id)->avg('note');


        return response()->json([
            'status' => 'true',
            'message' => 'Voici votre lieu',
            'place' => $place,
            'review' => $review
        ]);
    }

    public function edit(Request $request, $id)
    {
        // Récupère l'ID du lieu à modifier
        $place = Place::findOrFail($id);

        // Valide la requête
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000',

        ]);

        // Gestion de l'image
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images', $filename);
            $place->file = $filename;
        }

        // Update le lieu
        $place->title = ucwords(strtolower($request->title));
        $place->category_id = $request->category_id;
        $place->city = $request->city;
        $place->street = $request->street;
        $place->postcode = $request->postcode;
        $place->description = $request->description;
        $place->file = $request->file;

        // Sauvegarde les changements
        $place->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Lieu modifié avec succès',
            'place' => $place
        ]);
    }

    public function destroy(Place $place, $id)
    {

        $place = Place::findOrFail($id);
        $place->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'Lieu supprimé avec succès',
            'place' => $place
        ]);
    }
}
