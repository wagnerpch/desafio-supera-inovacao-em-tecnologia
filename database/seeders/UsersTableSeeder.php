<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'name' => 'admin',
            'email' => 'teste@example.com',
            'password' => '$2y$10$i9rzgRoWmeXU0or6tSkqBefIrRqQOYjsxuICD8ViURqqAdBicjI.e', // 12345678
            'remember_token' => Str::random(10),
        ]);

    }

}
