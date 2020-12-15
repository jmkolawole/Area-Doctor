<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Illuminate\Support\Str;


class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BlogCategory::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.


        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 5; $i++) {
            $name = $faker->word;
        $slug = Str::slug($name);
            BlogCategory::create([
                'name' => $name,
                'slug' => $slug,
                'description' => $faker->sentence,

            ]);
        }

    }
}
