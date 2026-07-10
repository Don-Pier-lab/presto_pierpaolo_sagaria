<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->integer('adult')->nullable();
            $table->integer('violence')->nullable();
            $table->integer('racy')->nullable();
            $table->integer('spoof')->nullable();
            $table->integer('medical')->nullable();
            $table->text('labels')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};