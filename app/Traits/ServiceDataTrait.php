<?php

namespace App\Traits;
use App\Events\Admin\Acl\EmailVerifiedEvent;
use App\Models\CoreData\Status;
use Illuminate\Support\Facades\DB;

trait ServiceDataTrait
{
    use EmailMessageTrait;
    public function changeStatus($data)
    {
        if ($data->status) {
            $data->status = 0;
        } else{
            $data->status = 1;
        }
        $data->update();
    }

    public function changeApprove($data)
    {
        if ($data->approve) {
            $data->approve = 0;
        } else{
            $data->approve = 1;
	       event(new EmailVerifiedEvent($data,$this->approveEmail()));
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

    public function getPropertyCompany($data)
    {
        $user_id[] = $data->id;
        $agents = $data->agent;
        if($agents)
        {
        foreach ($agents as $agent) {
            $user_id[] = $agent->id;
        }
        }
        return DB::table('properties')->wherein('user_id', $user_id)->join('translations', 'properties.status_id', 'translations.category_id')
            ->where('translations.category_type', Status::class)->where('translations.key', 'title')
            ->where('translations.value', 'publish');
    }
}
