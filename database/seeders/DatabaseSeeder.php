<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profile;
use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Wahyu Ramadhani',
            'email' => 'wahyurmd0512@gmail.com',
            'username' => 'wahyurmd',
            'password' => bcrypt('Rmdwahyu0512'),
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
        ]);

        $profile = SocialMedia::create([
            'user_id' => $user->id,
        ]);
    }
}
