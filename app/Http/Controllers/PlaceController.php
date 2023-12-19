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
                'data' => 'fail validator'
            ]);
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
                    $findPlace

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
        // $review = Review::select(['place_id'])->find(1);
        // $reviews = Review::with('place_id')->get();
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
}
