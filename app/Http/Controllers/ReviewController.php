<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function review(Request $request)
    {
        // CRÉATION DU COMMENTAIRE POUR ENVOYER DANS LA BDD
        $request -> validate([
            "comment" => "required|string",
            "rate" => "required|integer"
        ]);
        
        // ------> Mise en attente pour la connexion avec le token de l'user <-----
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

    public function renderReview()
    {
        // RÉCUPÉRATION DE LA BDD AFIN DE LES RENVOYER EN FORMAT JSON POUR LES AFFICHER
        $reviews = Review::all();
        return response()->json([
            'status' => 'true',
            'message' => 'Voici vos commentaires',
            $reviews
        ]);
    }

}
