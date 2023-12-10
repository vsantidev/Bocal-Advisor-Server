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

    function renderPlace()
    {
        $place = Place::all()->sortBy('name');
        return response()->json([
            'status' => 'true',
            'message' => 'Endroit créé avec succès',
            $place
        ]);
    }

    public function place(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = time() . '.' . $request->file->extension();
        $request->file->storeAs('public/images', $fileName);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'data' => $validator->errors()
            ]);
        } else {
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
                'message' => 'Endroit créé avec succès',
                $place
            ]);
        }
    }
}
