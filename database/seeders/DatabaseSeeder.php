<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;
use App\Models\Post;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()

    {  
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');
        
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
    }
}
