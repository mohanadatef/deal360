<?php

namespace Database\Seeders\CoreData;

use App\Models\CoreData\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $currency = Currency::all();
        foreach ($currency as $currencys) {
            $currencys->forceDelete();
        }
        $currency = Currency::onlyTrashed()->get();
        foreach ($currency as $currencys) {
            $currencys->forceDelete();
        }
        Currency::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $currency = [
            //currency
            [
                'order' => '0',
                'country_id' => 1,
                'title' => ['en' => 'ADE', 'ar' => 'درهم'],
            ],
        ];
        foreach ($currency as $value) {
            $data = Currency::create(['order' => $value['order'],'country_id' => $value['country_id']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $value['title'][$lang->code],
                    'language_id' => $lang->id]);
            }
        }
    }
}
