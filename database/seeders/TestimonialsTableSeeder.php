<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Testimonial;
use Illuminate\Support\Str;


class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Testimonial::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.


        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
            Testimonial::create([
                'doctor_Id' => $faker->numberBetween($min = 1, $max=6),
                'user_id' => $faker->numberBetween($min = 1, $max=6),
                'body' => $faker->text,
            ]);
        }

    }
}
