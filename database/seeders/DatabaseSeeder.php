<?php

namespace Database\Seeders;

use Database\Seeders\Acl\PermissionTableSeeder;
use Database\Seeders\Acl\RolePermissionTableSeeder;
use Database\Seeders\Acl\RoleTableSeeder;
use Database\Seeders\Acl\UserTableSeeder;
use Database\Seeders\CoreData\CountryTableSeeder;
use Database\Seeders\CoreData\LanguageTableSeeder;
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
        $this->call(LanguageTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
