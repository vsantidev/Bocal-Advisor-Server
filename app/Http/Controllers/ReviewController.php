<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function review(Request $request)
    {
        $request -> validate([
            "comment" => "required|string",
            "rate" => "required|integer"
        ]);
        
        // CRÉATION DU COMMENTAIRE DANS LA BD ET RENVOIE JSON POUR FRONT
        // $user_id = Auth::id();
        $newReview = [
            'comment' => $request->comment,
            'rate' => $request->rate,
            // 'user_id' => $user_id,
            // 'place_id' => $request->place_id
        ];
       
        Review::create($newReview);

        return response()->json([
            $newReview
        ]);
    }

}
