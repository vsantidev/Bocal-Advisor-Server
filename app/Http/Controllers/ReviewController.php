<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Int_;

use function Laravel\Prompts\error;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        // CRÉATION DU COMMENTAIRE POUR ENVOYER DANS LA BDD
        $request->validate([
            "comment" => "required|string",
            "rate" => "required|integer",
            "place_id" => "required|integer",
            // 'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ENREGISTRE L'IMAGE DANS LE "public/storage/images en local"
        // $fileName = time() . '.' . $request->file->extension();
        // $request->file->storeAs('public/images', $fileName);

        // ------> Mise en attente pour la connexion avec le token de l'user <-----
        // $user_id = Auth::id();

        // $place_id = DB::table('Reviews')->where('reviews.place_id', $id)->get();
        // $user_id =2;
        // dd($request);
        $newReview = [
            'comment' => $request->comment,
            'rate' => $request->rate,
            'user_id' => $request->user_id,
            'place_id' => $request->place_id,
        ];

        Review::create($newReview);

        return response()->json([
            'message' => 'Commentaire créé avec succès',
            $newReview
        ]);
    }

    public function deleteReview(Request $request)
    {
   
        $request->validate([
            "id" => "required|integer",
            // 'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $myreview = Review::findOrFail($request->id);
        $myreview->delete();
        //Review::destroy($myreview);
               
        return response()->json([
            'status' => 'true',
            'message' => 'Review supprimé',
            'review' => $request->id
        ]);
    }

    // public function renderReview()
    // {
    //     // RÉCUPÉRATION DE LA BDD AFIN DE LES RENVOYER EN FORMAT JSON POUR LES AFFICHER
    //     $reviews = Review::all();
    //     return response()->json([
    //         'status' => 'true',
    //         'message' => 'Voici vos commentaires',
    //         $reviews
    //     ]);
    // }

    // public function showReview()
    // {
    //     // RÉCUPÉRATION DE LA DONNÉE USER POUR L'AFFICHER
    //     $review = DB::table('Reviews')->where('reviews.place_id', $id)->get();
    // }

}
