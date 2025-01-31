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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('objective');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('budget')->nullable();
            $table->enum('status', ['holding', 'processing', 'completed', 'cancelled'])->default('processing');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
