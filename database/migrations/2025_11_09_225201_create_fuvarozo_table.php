<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('fuvarozo', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->string('email')->unique();
            $table->string('jelszo');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('fuvarozo');
    }
};

