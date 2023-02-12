<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
      $this->call([
        HouseSeeder::class,
        FlatSeeder::class,
        ContactsSeeder::class,
        DeclareWaterSeeder::class,
        PricelistSeeder::class,
        PermissionSeeder::class,
        RolesSeeder::class,
        UserSeeder::class,
        NkfSeeder::class,
        PostsSeeder::class,


      ]);
    }
}
