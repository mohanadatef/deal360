<?php

namespace App\Traits;

trait ServiceData
{
    public function changeStatus($data)
    {
        if ($data->status) {
            $data->status = 0;
        } else{
            $data->status = 1;
        }
        $data->update();
    }

    public function storeCheckLanguage($data,$request)
    {
        foreach (language() as $lang) {
            if (isset($request->title[$lang->code])) {
                $data->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id' => $lang->id]);
            } else {
                $data->translation()->create(['key' => 'title', 'value' => $request->title['en'],
                    'language_id' => $lang->id]);
            }
        }
    }

    public function updateCheckLanguage($data,$request)
    {
        foreach (language() as $lang) {
            $translation = $data->translation->where('language_id', $lang->id)->first();
            if ($translation) {
                $translation->update(['value' => $request->title[$lang->code]]);
            } else {
                if (isset($request->title[$lang->code])) {
                    $data->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                } else {
                    $data->translation()->create(['key' => 'title', 'value' => $request->title['en'],
                        'language_id' => $lang->id]);
                }
            }
        }
    }
}