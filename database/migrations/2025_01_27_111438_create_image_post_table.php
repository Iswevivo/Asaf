<?php

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
        Schema::create('image_post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')
                  ->constrained('images')
                  ->onDelete('cascade'); // Supprime les relations si l'image est supprimée
            $table->foreignId('post_id')
                  ->constrained('posts')
                  ->onDelete('cascade'); // Supprime les relations si le post est supprimé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_post');
    }
};
