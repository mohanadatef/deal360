<?php

namespace Database\Seeders\CoreData;

use App\Models\CoreData\Rejoin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RejoinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $rejoin = Rejoin::all();
        foreach ($rejoin as $rejoins) {
            $rejoins->forceDelete();
        }
        $rejoin = Rejoin::onlyTrashed()->get();
        foreach ($rejoin as $rejoins) {
            $rejoins->forceDelete();
        }
        Rejoin::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $rejoin = [
            //rejoin
            [
                'order' => '0',
                'city_id'=>'1',
                'country_id'=>'1',
                'title' => ['en' => 'united arab emirates', 'ar' => 'الامارات'],
            ],
        ];
        foreach ($rejoin as $value) {
            $data = Rejoin::create(['order' => $value['order'],'city_id' => $value['city_id'],'country_id' => $value['country_id']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $value['title'][$lang->code],
                    'language_id' => $lang->id]);
            }
        }
    }
}
