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
         \App\Models\Position::factory(100)->create();
         \App\Models\School::factory(10)->create();
         \App\Models\Employee::factory(500)->create();
        
    }
}
