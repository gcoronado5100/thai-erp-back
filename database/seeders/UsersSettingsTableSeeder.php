<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_settings')->insert([
            [
                'user_id' => 1,
                'theme' => 'dark',
                'pdv_id' => 1,
                'showNews' => false
            ],
            [
                'user_id' => 2,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 3,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 4,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 5,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 6,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 7,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 8,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 9,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 10,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 11,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 12,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 13,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 14,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 15,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 16,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 17,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 18,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 19,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 20,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 21,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
            [
                'user_id' => 22,
                'theme' => 'system',
                'pdv_id' => null,
                'showNews' => true
            ],
        ]);
    }
}
