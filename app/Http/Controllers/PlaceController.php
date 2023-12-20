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
    /**
     * Display a listing of the resource.
     */

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

        $places = DB::table('places')
            ->select('places.*', "category_place.*", "categories.id as id_categories", "categories.name_category as name_category")
            ->leftJoin('category_place', 'places.id', 'category_place.place_id')
            ->leftJoin('categories', 'category_place.category_id', 'categories.id')
            ->get();
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
        /*         if($request->title =="s"){
            return $request;
        } else {
            return 'coucouc';
        } */
        // Vérifie que tous les champs requis sont bien renseignés
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

            $verifyPlace = DB::table('places')
                ->where('places.title', $request->title)
                ->where('places.street', $request->street)
                ->get();


            if ($verifyPlace->count() == 0) {

                // Créé le lieu dans la bdd et le renvoie en format json 

                $place = Place::create([
                    'title' => $request->title,
                    'category' => $request->category_id,
                    'street' => $request->street,
                    'postcode' => $request->postcode,
                    'city' => $request->city,
                    'description' => $request->description,
                    'file' => $fileName,

                    /*                     'x' => $request->x,
                    'y' => $request->y, */
                ]);

                $findPlace = DB::table('places')
                    ->where('places.title', $request->title)
                    ->where('places.street', $request->street)
                    ->get();

                foreach ($findPlace as $key => $element) {

                    $pla = Place::find($element->id);
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
                    'message' => 'existe déja',

                ]);
            }
        }

        if (!$request->file('file')->isValid()) {
            return response()->json(['status' => 'false', 'message' => 'File upload failed']);
        }
    }

    public function show(Place $place, Int $id)
    {
        // $place['category_id'] = $place->getCategory();
        $place = Place::find($id);

        $places = DB::table('Reviews')->where('reviews.place_id', $id)->get();
        foreach ($places as $place) {
            $place->file_review = asset('storage/images/' . $place->file_review);
        }
        // $place->reviews()->where('reviews.place_id', $id)->get();


        // $note = Note::where('book_id', $book->id)->avg('note');


        return response()->json([
            'status' => 'true',
            'message' => 'Voici votre lieu',
            'place' => $place,
            'review' => $places
        ]);
    }

    // public function edit(Request $request, $id)
    // {
    //     // Récupère l'ID du lieu à modifier
    //     $place = Place::findOrFail($id);

    //     // Valide la requête
    //     $request->validate([
    //         'title' => 'required',
    //         'category_id' => 'required|exists:categories,id',
    //         'city' => 'required',
    //         'street' => 'required',
    //         'postcode' => 'required',
    //         'description' => 'required',
    //         'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000',

    //     ]);

    //     // Gestion de l'image
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->storeAs('public/images', $filename);
    //         $place->file = $filename;
    //     }

    //     // Update le lieu
    //     $place->title = ucwords(strtolower($request->title));
    //     $place->category_id = $request->category_id;
    //     $place->city = $request->city;
    //     $place->street = $request->street;
    //     $place->postcode = $request->postcode;
    //     $place->description = $request->description;
    //     $place->file = $request->file;

    //     // Sauvegarde les changements
    //     $place->save();

    //     return response()->json([
    //         'status' => 'true',
    //         'message' => 'Lieu modifié avec succès',
    //         'place' => $place
    //     ]);
    // }

    public function edit(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'street' => 'required',
            'description' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            // 'category' => 'required',
            'file' => 'required'
        ]);


        $place = Place::findOrFail($request->id);
        $place->title = $request->title;
        $place->street = $request->street;
        $place->description = $request->description;
        $place->postcode = $request->postcode;
        $place->city = $request->city;
        $place->file = $request->file;
        $place->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Lieu modifié avec succès',
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
