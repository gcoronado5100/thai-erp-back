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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'Gabriel Coronado',
                'email' => 'gabriel@glasse.com.mx',
                'password' => bcrypt('Gabo0191$!$'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Luis Enrique Espinosa',
                'email' => 'luisenrique.espinosa@gmail.com',
                'password' => bcrypt('Tata1535!'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Jose Miguel Espinosa',
                'email' => 'direccion@freddo.com.mx',
                'password' => bcrypt('Freddo2021!'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Gabriela Marin',
                'email' => 'gabrielamarin@ciampi.com.mx',
                'password' => bcrypt('Ciampi2021!'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Blanca Citali Castañeda',
                'email' => 'blanca@glasse.com.mx',
                'password' => bcrypt('BlancaGlasse2023'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Samuel Moncada Ávila',
                'email' => 'samuel@ciampi.com.mx',
                'password' => bcrypt('CiampiSamuel2023'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Marily Lopez',
                'email' => 'marily@ciampi.com.mx',
                'password' => bcrypt('CiampiMarily2023'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Antonio Mandujano',
                'email' => 'antonio@ciampi.com.mx',
                'password' => bcrypt('CiampiAntonio2023'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Maria Freire',
                'email' => 'freiremaria@ciampi.com.mx',
                'password' => bcrypt('CiampiMafreire2023'),
                'email_verified_at' => now(),
                'active' => true
            ],
            [
                'name' => 'Harry Bazán',
                'email' => 'harry@ciampi.com.mx',
                'password' => bcrypt('CiampiHarry2023'),
                'email_verified_at' => now(),
                'active' => true
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
