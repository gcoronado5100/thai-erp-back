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
        Schema::create('clients_freddo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registered_by')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('address_street')->nullable();
            $table->string('address_ext')->nullable();
            $table->string('address_int')->nullable();
            $table->string('address_col')->nullable();
            $table->string('address_town')->nullable();
            $table->string('address_state')->nullable();
            $table->string('address_zip')->nullable();

            $table->foreign('registered_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients_freddo');
    }
};
