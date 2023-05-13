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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->enum('type', ['short_answer', 'long_answer', 'number', 'dropdown', 'scale']);
            $table->json('options')->nullable();
            $table->integer('index')->nullable();
            $table->timestamps();
            $table->foreignUuid('form_id')->references('id')->on('forms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
