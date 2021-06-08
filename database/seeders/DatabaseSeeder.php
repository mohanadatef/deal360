<?php

namespace Database\Seeders;

use App\Http\Controllers\Wordpress\WordpressController;
use Database\Seeders\Acl\PermissionTableSeeder;
use Database\Seeders\Acl\RolePermissionTableSeeder;
use Database\Seeders\Acl\RoleTableSeeder;
use Database\Seeders\Acl\UserTableSeeder;
use Database\Seeders\CoreData\CityTableSeeder;
use Database\Seeders\CoreData\CountryTableSeeder;
use Database\Seeders\CoreData\CurrencyTableSeeder;
use Database\Seeders\CoreData\LanguageTableSeeder;
use Database\Seeders\CoreData\RejoinTableSeeder;
use Database\Seeders\CoreData\StatusTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $wordpress;
    public function __construct(WordpressController $WordpressController)
    {
        $this->wordpress=$WordpressController;
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
        executionTime();
        $this->call(CityTableSeeder::class);
        $this->call(RejoinTableSeeder::class);
        executionTime();
        $this->call(StatusTableSeeder::class);
        $this->call(UserTableSeeder::class);
        executionTime();
        $this->wordpress->index(0);
        executionTime();
    }
}
