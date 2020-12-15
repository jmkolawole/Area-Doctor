<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Doctor;
use Hash;
use Illuminate\Support\Str;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Doctor::truncate();
        $faker = \Faker\Factory::create();
        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.
        $password = Hash::make('password');
        $image = $faker->imageUrl($width=640, $height=480);
        Doctor::create([
            'name' => 'Ben Carson',
            'username' => 'BenC',
            'slug' => 'ben',
            'email' => 'admin@test.com',
            'phone' => '07062612572',
            'address' => 'victoria Island,Lagos',
            'image' => $image,
            'password' => $password,
        ]);

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 5; $i++) {
        $name = $faker->name;
        $slug = Str::slug($name);
        $image = $faker->imageUrl($width=640, $height=480);
            Doctor::create([
                'name' => $name,
                'username' => $faker->firstName,
                'slug' => $slug,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'image' => $image,
                'password' => $password,
            ]);
        }
    }
}
