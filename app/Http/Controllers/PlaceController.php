<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Selected_category;
use App\Models\Place;
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
        $truc = array();

        $places = DB::table('places')
            ->select('places.*', "selected_categories.*", "categories.id as id_categories", "categories.name_category as name_category")
            ->leftJoin('selected_categories', 'places.id', 'selected_categories.place_id')
            ->leftJoin('categories', 'selected_categories.category_id', 'categories.id')
            ->get();

        return response()->json([
            'status' => 'true',
            'message' => 'Voici vos lieux',
            $places
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

    public function show(Place $place, Int $id)
    {
        // $place['category_id'] = $place->getCategory();
        $place = Place::find($id);


        // $note = Note::where('book_id', $book->id)->avg('note');

        return response()->json([
            'status' => 'true',
            'message' => 'Voici votre lieu',
            $place
        ]);
    }
}
