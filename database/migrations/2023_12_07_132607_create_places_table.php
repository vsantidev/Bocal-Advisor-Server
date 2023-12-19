<?php

use App\Models\Category;
use App\Models\Picture;
use App\Models\Review;
use App\Models\User;
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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('street');
            $table->integer('postcode');
            $table->string('city');
            $table->text('description');
            $table->float('x')->nullable();
            $table->float('y')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained();
/*             $table->foreignIdFor(Category::class)->nullable()->constrained(); */
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
