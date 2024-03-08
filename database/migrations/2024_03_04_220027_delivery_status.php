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
        Schema::create('delivery_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->timestamps();
        });

        DB::table('delivery_status')->insert([
            ['name' => 'Pendiente', 'color' => 'warning'],
            ['name' => 'En Proceso', 'color' => 'info'],
            ['name' => 'Enviado', 'color' => 'primary'],
            ['name' => 'Entregado', 'color' => 'success'],
            ['name' => 'Cancelado', 'color' => 'danger'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_status');
    }
};
