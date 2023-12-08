<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $place = Place::getAll();
        return response()->json([
            'status' => 'true',
            'message' => 'Endroit connu'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all()->sortBy('name_category');
        return response()->json([
            'status' => 'true',
            'message' => 'Endroit connu'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'description' => 'required',
            'picture_id' => 'required'
        ]);

        Place::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'street' => $request->street,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'description' => $request->description ,
            'picture_id' => $request->picture
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'Endroit connu'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        $place['category_id'] = $place->getCategory();

        return response()->json([
            'status' => 'true',
            'message' => 'Endroit connu'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        $category = Category::all()->sortBy('name_category');

        return response()->json([
            'status' => 'true',
            'message' => 'Endroit connu'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'description' => 'required',
            'picture_id' => 'required'
        ]);

        $place->title = ucwords(strtolower($request->name));
        $place->category = $request->category;
        $place->street = ucwords(strtolower($request->street));
        $place->postcode = $request->postcode;
        $place->city = $request->city;
        $place->description = $request->description;
        $place->picture = $request->picture;

        $place->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Endroit connu'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return response()->json([
            'status' => 'true',
            'message' => 'Au revoir'
        ]);
    }
}
