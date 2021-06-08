<?php

namespace Database\Seeders\CoreData;

use App\Models\CoreData\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $city = City::all();
        foreach ($city as $citys) {
            $citys->forceDelete();
        }
        $city = City::onlyTrashed()->get();
        foreach ($city as $citys) {
            $citys->forceDelete();
        }
        City::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $city = [
            //city
            [
                'order' => '0',
                'country_id'=>'1',
                'title' => ['en' => 'united arab emirates', 'ar' => 'الامارات'],
            ],
        ];
        foreach ($city as $value) {
            $data = City::create(['order' => $value['order'],'country_id' => $value['country_id']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $value['title'][$lang->code],
                    'language_id' => $lang->id]);
            }
        }
    }
}
