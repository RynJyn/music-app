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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("genre");
            $table->string("photo");
        });

        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("genre");
            $table->string("art");
            $table->dateTime("released");
            $table->integer("artist_id")->unsigned();
            $table->foreign("artist_id")->references("id")->on("artists")->cascadeOnDelete();
        });

        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("duration");
            $table->string("filename");
            $table->integer("album_id")->unsigned();
            $table->foreign("album_id")->references("id")->on("albums")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
        Schema::dropIfExists('albums');
        Schema::dropIfExists('tracks');
    }
};
