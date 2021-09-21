<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
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
        User::truncate();
        Category::truncate();
        
        $user = User::factory()->create([
            'name' => 'Raul Marin',
        ]);

        Post::factory(3)->create([
            'user_id' => $user->id,
        ]);

        Post::factory(10)->create();

        //\App\Models\User::factory(10)->create();
      /*  $user = User::factory()->create();


        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        $hobbies = Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies'
        ]);

        Post::create([
            'category_id' => $work->id,
            'user_id' =>  $user->id,
            'title' => 'My First post',
            'slug' => 'my-First-post',
            'resumen' => 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...',
            'body' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...'
        ]);*/
    }
}
