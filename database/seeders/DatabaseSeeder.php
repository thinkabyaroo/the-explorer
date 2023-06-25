<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Kabyar",
            'email' => "kabyar@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password') ,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Thin Thin",
            'email' => "thinthin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password') ,
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Kabyar Oo",
            'email' => "kabyaroo@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password') ,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Thin Thin Oo",
            'email' => "thinthinoo@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password') ,
            'remember_token' => Str::random(10),
        ]);

        User::create([
        'name' => "Kabyar",
        'email' => "tkokabyar@gmail.com",
        'email_verified_at' => now(),
        'password' => Hash::make('password') ,
        'remember_token' => Str::random(10),
    ]);

        User::create([
            'name' => "Thin Thin",
            'email' => "tkothinthin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password') ,
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Kabyar Oo",
            'email' => "kabyaroo11@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password') ,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Thin Thin Oo",
            'email' => "thinthinoo12@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password') ,
            'remember_token' => Str::random(10),
        ]);
        User::create([
        'name' => "Kabyar Oo",
        'email' => "kabyaroo1@gmail.com",
        'email_verified_at' => now(),
        'password' => Hash::make('password') ,
        'remember_token' => Str::random(10),
    ]);

        User::create([
            'name' => "Thin Thin Oo",
            'email' => "thinthinoo1@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password') ,
            'remember_token' => Str::random(10),
        ]);

//        Post::create([
//            "title" => "Dior Sauvage",
//            'description' => "Sauvage is an act of creation inspired by wide-open spaces. An ozone blue sky that dominates a white-hot rocky landscape. A bold composition for a true-to-himself man. To create Sauvage, I used man as my starting point. A strong and unmistakable masculinity. Like the image of a man who transcends...",
//            'cover' => "",
//            'user_id' => User::all()->random()->id,
//        ]);

//        User::factory(25)->create();
//        Post::factory(120)->create();
//        Comment::factory(340)->create();
//        Gallery::factory(25)->create();
    }
}
