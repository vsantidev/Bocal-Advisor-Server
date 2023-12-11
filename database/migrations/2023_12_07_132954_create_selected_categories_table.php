<?php

use App\Models\Category;
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
        Schema::create('selected_categories', function (Blueprint $table) {
            $table->foreignIdFor(Place::class)->constrained();
            $table->foreignIdFor(Category::class)->constrained();
            $table->primary(['place_id','category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selected_categories');
    }
};
