<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('munka', function (Blueprint $table) {
            $table->id();
            $table->string('indulas');
            $table->string('erkezes');
            $table->string('cimzett_neve');
            $table->string('cimzett_telefonszama');
            $table->enum('status', ['kiosztva','folyamatban','elvegezve','sikertelen'])->default('kiosztva');
            $table->foreignId('fuvarozo_id')->nullable()->constrained('fuvarozo')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('munka');
    }
};
