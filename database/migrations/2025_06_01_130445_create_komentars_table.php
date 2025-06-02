<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->id();
            $table->string('berita_id'); // ini sesuai 'id' dari API berita
            $table->string('nama');
            $table->text('isi');
            $table->timestamps();
        });
    }
};
