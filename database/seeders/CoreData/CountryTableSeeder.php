<?php

namespace Database\Seeders\CoreData;

use App\Models\CoreData\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $country = Country::all();
        foreach ($country as $countrys) {
            $countrys->forceDelete();
        }
        $country = Country::onlyTrashed()->get();
        foreach ($country as $countrys) {
            $countrys->forceDelete();
        }
        Country::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $country = [
            //country
            [
                'order' => '0',
                'title' => ['en' => 'united arab emirates', 'ar' => 'الامارات'],
            ],
        ];
        foreach ($country as $value) {
            $data = Country::create(['order' => $value['order']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $value['title'][$lang->code],
                    'language_id' => $lang->id]);
            }
        }
    }
}
