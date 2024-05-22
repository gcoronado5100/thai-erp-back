<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersCapabilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Maestro
        DB::table('user_capabilities')->insert([
            'user_id' => 1,
            'user_type_id' => 1,
            'pdv_id' => 1,
        ]);
        DB::table('user_capabilities')->insert([
            'user_id' => 1,
            'user_type_id' => 1,
            'pdv_id' => 2,
        ]);
        DB::table('user_capabilities')->insert([
            'user_id' => 1,
            'user_type_id' => 1,
            'pdv_id' => 3,
        ]);
        DB::table('user_capabilities')->insert([
            'user_id' => 1,
            'user_type_id' => 1,
            'pdv_id' => 4,
        ]);
        DB::table('user_capabilities')->insert([
            'user_id' => 1,
            'user_type_id' => 1,
            'pdv_id' => 5,
        ]);

        // Doctor
        DB::table('user_capabilities')->insert([
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 1,
            ],
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 2,
            ],
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 3,
            ],
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 4,
            ],
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 5,
            ],
        ]);


        // Mickey
        DB::table('user_capabilities')->insert([
            [
                'user_id' => 3,
                'user_type_id' => 3,
                'pdv_id' => 1,
            ],
            [
                'user_id' => 3,
                'user_type_id' => 3,
                'pdv_id' => 2,
            ],
            [
                'user_id' => 3,
                'user_type_id' => 3,
                'pdv_id' => 3,
            ],
            [
                'user_id' => 3,
                'user_type_id' => 3,
                'pdv_id' => 4,
            ],
            [
                'user_id' => 3,
                'user_type_id' => 3,
                'pdv_id' => 5,
            ],
        ]);

        // Gaby
        DB::table('user_capabilities')->insert([
            [
                'user_id' => 4,
                'user_type_id' => 4,
                'pdv_id' => 1,
            ],
            [
                'user_id' => 4,
                'user_type_id' => 4,
                'pdv_id' => 2,
            ],
            [
                'user_id' => 4,
                'user_type_id' => 4,
                'pdv_id' => 3,
            ],
            [
                'user_id' => 4,
                'user_type_id' => 4,
                'pdv_id' => 4,
            ],
            [
                'user_id' => 4,
                'user_type_id' => 4,
                'pdv_id' => 5,
            ],
        ]);

        // Blanca
        DB::table('user_capabilities')->insert([
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 1,
            ],
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 2,
            ],
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 3,
            ],
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 4,
            ],
            [
                'user_id' => 2,
                'user_type_id' => 2,
                'pdv_id' => 5,
            ],
        ]);
    }
}
