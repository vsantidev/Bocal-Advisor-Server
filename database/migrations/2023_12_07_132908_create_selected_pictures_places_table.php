<?php

use App\Models\Picture;
use App\Models\Place;
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
        Schema::create('selected_pictures_places', function (Blueprint $table) {
            $table->foreignIdFor(Place::class);
            $table->foreignIdFor(Picture::class);
            $table->primary(['place_id','picture_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selected_pictures_places');
    }
};
