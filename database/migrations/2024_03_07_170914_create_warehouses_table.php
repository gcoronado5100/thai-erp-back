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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('address_line_1', 150);
            $table->string('address_line_2', 150);
            $table->string('town', 150);
            $table->string('city', 200);
            $table->string('state', 200);
            $table->string('zip', 200);
            $table->string('phone', 200);
            $table->unsignedBigInteger('manager')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
