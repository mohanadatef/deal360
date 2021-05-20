<?php
namespace Database\Seeders\CoreData;
use App\Models\CoreData\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Language::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $languages = [
            [
                'title' => 'english',
                'code' => 'en',
                'order' => '1',
                'status' => '1',
            ],
            [
                'title' => 'عربى',
                'code' => 'ar',
                'order' => '2',
                'status' => '1',
            ],
        ];
        foreach ($languages as $key => $value) {
            Language::create($value);
        }
    }
}
