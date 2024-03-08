<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pdvs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        DB::table('pdvs')->insert([
            ['name' => 'Freddo','slug' => 'freddo'],
            ['name' => 'Glasse', 'slug' => 'glasse'],
            ['name' => 'Ciampi', 'slug' => 'ciampi'],
            ['name' => 'Almacen', 'slug' => 'warehouse'],
            ['name' => 'Soporte', 'slug' => 'support'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdvs');
    }
};
