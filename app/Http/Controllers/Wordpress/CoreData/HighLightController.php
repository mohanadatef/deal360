<?php

namespace App\Http\Controllers\Wordpress\CoreData;

use App\Http\Controllers\Controller;
use App\Models\CoreData\HighLight;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HighLightController extends Controller
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
        $count_high_light = HighLight::latest('id')->first();
        $count_high_light = empty($count_high_light) ? 0 : $count_high_light;
        $data_high_light = array();
        $data_translation = array();
        $language = language();
        $wp_high_lights_id = DB::table('high_lights')->pluck('wp_high_light_id', 'wp_high_light_id')->toarray();
        foreach ($response['data']['property_status'] as $key => $high_light) {
            if (!in_array($high_light['id'], $wp_high_lights_id)) {
                $data_high_light[] = array('id' => $count_high_light + $key + 1,
                    'order' => $count_high_light + $key + 1,
                    'wp_high_light_id' => $high_light['id']);
                foreach ($language as $lang) {
                    $data_translation[] = array('category_type' => HighLight::class,
                        'category_id' => $count_high_light + $key + 1, 'key' => 'title', 'value' => !empty($high_light['name']) ? $high_light['name'] : 'free ' . ($key + 1),
                        'language_id' => $lang->id);
                }
            }
        }
         DB::transaction(function () use ($data_high_light,$data_translation) {
            DB::table('high_lights')->insert($data_high_light);
            DB::table('translations')->insert($data_translation);
         });
    }
}
