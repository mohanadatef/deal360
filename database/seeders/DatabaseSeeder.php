<?php

namespace Database\Seeders;

use App\Http\Controllers\Wordpress\CoreData\CoreDataController;
use Database\Seeders\Acl\PermissionTableSeeder;
use Database\Seeders\Acl\RolePermissionTableSeeder;
use Database\Seeders\Acl\RoleTableSeeder;
use Database\Seeders\Acl\UserTableSeeder;
use Database\Seeders\CoreData\CountryTableSeeder;
use Database\Seeders\CoreData\CurrencyTableSeeder;
use Database\Seeders\CoreData\LanguageTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $core_data;
    public function __construct(CoreDataController $CoreDataController)
    {
        $this->core_data=$CoreDataController;
    }
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
        executionTime();
        $this->call(RoleTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        executionTime();
        $this->call(CountryTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(UserTableSeeder::class);
        executionTime();
        $this->core_data->index(0);
    }
}
