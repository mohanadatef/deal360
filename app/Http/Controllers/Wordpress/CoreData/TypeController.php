<?php

namespace App\Http\Controllers\Wordpress\CoreData;

use App\Http\Controllers\Controller;
use App\Models\CoreData\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TypeController extends Controller
{
    public function index($return)
    {
        $response = Http::withToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzc5YjZiNjkwOWI4OGNhMmUxZTdkZmQ3ZDI5ZjEyMGQyNDQ2YmRhOTE5NWVkNzc4ZDliZGU0NzI5MWYxNGMwM2ExNzgzMGVlODZjNTI3OWQiLCJpYXQiOjE2MTM5MTM3MzMsIm5iZiI6MTYxMzkxMzczMywiZXhwIjoxNjQ1NDQ5NzMzLCJzdWIiOiIxNyIsInNjb3BlcyI6W119.f1p3jcbeXdrVkyoSjCnHfCQHT5xm8S_vL7o4MLY41iITHHpBLNq1Coa2uhELWtE_Yt0Tjc7SKXw6_lpQO84haLcDVjba1M3oyadiiYywBwSNbK6fsrGzKotxug8EYUnjmt0bhD92luJKne8sx197QVM_Z2WhoiVY-fFRz3ZmDh4Yd3acmJVZ74jI3_PhQqCf5WSuaeCala4Y-I4Ffh9-w5q8tswHP_wNOLVanWVfcGnFORLSP5Vml6wpxWxTznkUknal7VE9hiuRl7RkIdpxWHXdCh74_wY9u9TZ5l6TDFZjA-U8g6IgQYeKGfOf7xAsZxETT0kU8AKIseDW_Ba9MUo7oG_wB4BpMrD9_jUQBw1fjAmkZQhuYHBp1n-a1f1jbSIVBgRI-uWFw3jmpMkeRV5d1DmZyc-RaOSmXTwkiWghWuFhRd6iWs8bw9H3gGw4co7D8tUk9cxYH4jL45FdMRyPPhoTxQ95tP0gIlWI7q6kH89FwW8Mlm3eCjVh8FDc09YYKmmY9LDH5PJb6FGSTSEoK_UCmeT_I3fpp7vu1vWUJvwD26KpHqJD5WcCHuPcSS899Y5d_MgW8cAoYrXqlpnhFcDAi_9g0uKKMceWk8v7qVKN23pGJrBE-OdA55YdQji2uj6aP1QoSMXFEG6arx6gaSre4KECBNSyzbFi1VA')
            ->get('https://crm.deal360.ae/backend/api/getData?lang=en')->json();
        $this->store($response);
        if($return == 1)
        {
            return redirect(route('admin.dashboard'));
        }
    }

    public function store($response)
    {
        $count_type = Type::latest('id')->first();
        $count_type = empty($count_type) ? 0 : $count_type->id;
        $data_type = array();
        $data_translation = array();
        $language = language();
        $wp_types_id = DB::table('types')->pluck('wp_type_id', 'wp_type_id')->toarray();
        foreach ($response['data']['property_action_category'] as $key => $type) {
            executionTime();
            if (!in_array($type['id'], $wp_types_id)) {
                executionTime();
                $data_type[] = array('id' => $count_type + $key + 1,
                    'order' => $count_type + $key + 1,
                    'wp_type_id' => $type['id']);
                foreach ($language as $lang) {
                    $data_translation[] = array('category_type' => Type::class,
                        'category_id' => $count_type + $key + 1, 'key' => 'title', 'value' => !empty($type['name']) ? $type['name'] : 'free ' . ($key + 1),
                        'language_id' => $lang->id);
                }
            }
        }
         DB::transaction(function () use ($data_type,$data_translation) {
            DB::table('types')->insert($data_type);
            DB::table('translations')->insert($data_translation);
         });
    }
}
