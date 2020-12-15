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

            $name1 = 'Fitness';
            $slug1 = Str::slug($name1);
            BlogCategory::create([
                'name' => $name1,
                'slug' => $slug1,
                'description' => $faker->sentence,
            ]);

            $name2 = 'Heart';
            $slug2 = Str::slug($name2);
            BlogCategory::create([
                'name' => $name2,
                'slug' => $slug2,
                'description' => $faker->sentence,
            ]);

            $name3 = 'Diet';
            $slug3 = Str::slug($name3);
            BlogCategory::create([
                'name' => $name3,
                'slug' => $slug3,
                'description' => $faker->sentence,
            ]);


    }
}
