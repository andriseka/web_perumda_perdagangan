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
        Schema::create('rkaps', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique();
            $table->string('desc', 255)->nullable();
            $table->string('total_anggaran', 255)->nullable();
            $table->text('file')->nullable();
            $table->timestamps();

            $table->index('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rkaps');
    }
};
