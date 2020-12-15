<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Article::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.


        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
        $title = $faker->sentence;
        $slug = Str::slug($title);
        $image = $faker->imageUrl($width=640, $height=480);

            Article::create([
                'title' => $title,
                'doctor_id' => $faker->numberBetween($min = 1, $max=6),
                'blog_category_id' => $faker->numberBetween($min = 1, $max=3),
                'slug' => $slug,
                'body' => $faker->text,
                'image' => $image,
            ]);
        }
    }
}
