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
       //  \App\Models\Position::factory(15)->create();
      //  \App\Models\School::factory(10)->create();
       //  \App\Models\Employee::factory(20)->create();
         \App\Models\User::factory(1)->create();
      //   \App\Models\Training::factory(10)->create();
        
    }
}
