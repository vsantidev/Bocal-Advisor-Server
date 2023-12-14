<?php

use App\Models\Picture_review;
use App\Models\Review;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('selected_pictures_reviews', function (Blueprint $table) {
            $table->foreignIdFor(Review::class);
            $table->foreignIdFor(Picture_review::class);
            $table->primary(['review_id','picture_review_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selected_pictures_reviews');
    }
};
