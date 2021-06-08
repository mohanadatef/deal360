<?php

namespace Database\Seeders\CoreData;

use App\Models\CoreData\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $status = Status::all();
        foreach ($status as $statuss) {
            $statuss->forceDelete();
        }
        $status = Status::onlyTrashed()->get();
        foreach ($status as $statuss) {
            $statuss->forceDelete();
        }
        Status::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $status = [
            //status
            //1
            [
                'order' => '0',
                'title' => ['en' => 'pending', 'ar' => 'انتظار'],
            ],
            //2
            [
                'order' => '1',
                'title' => ['en' => 'publish', 'ar' => 'نشر'],
            ],
        ];
        foreach ($status as $value) {
            $data = Status::create(['order' => $value['order']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $value['title'][$lang->code],
                                              'language_id' => $lang->id]);
            }
        }
    }
}
