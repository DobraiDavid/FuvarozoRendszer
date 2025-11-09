<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('jarmu', function (Blueprint $table) {
            $table->id();
            $table->string('marka');
            $table->string('tipus')->nullable();
            $table->string('rendszam')->unique();
            $table->foreignId('fuvarozo_id')->nullable()->constrained('fuvarozo')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('jarmu');
    }
};
