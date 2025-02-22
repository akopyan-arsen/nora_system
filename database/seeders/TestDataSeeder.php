<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            TestUserSeeder::class,
            VisitTypesSeeder::class,
            LabelsSeeder::class,
            DiscountsSeeder::class,
            TestVisitSeeder::class,
        ]);
    }
}
