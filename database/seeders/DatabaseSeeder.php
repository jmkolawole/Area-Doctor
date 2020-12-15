<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(TestimonialsTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
    }
}
