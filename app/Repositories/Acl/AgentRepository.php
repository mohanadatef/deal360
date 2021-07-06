<?php

namespace App\Repositories\Acl;

use App\Http\Resources\Acl\Agent\AgentListResource;
use App\Interfaces\Acl\UserInterface;
use App\Models\Acl\Agent;
use App\Models\CoreData\Status;
use App\Models\CoreData\Type;
use App\Traits\ImageTrait;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\DB;

class AgentRepository implements UserInterface
{
    use ServiceDataTrait, ImageTrait;

    protected $data, $userRepository;

    public function __construct(Agent $Agent, UserRepository $UserRepository)
    {
        $this->data = $Agent;
        $this->userRepository = $UserRepository;
    }

    public function getData($request)
    {
        $data = $this->data->with('user', 'company');
        if (isset($request->web)) {
            $data = $data->join('users', 'agents.user_id', 'users.id')
                ->where('users.status', 1)->where('users.approve', 1)->select('agents.*');
        }
        if (isset($request->web)) {
            if (isset($request->filter_rating)) {
                if ($request->filter_rating == 1) {
                    $data = $data->orderby('users.avg_rating', 'asc');
                } elseif ($request->filter_rating == 0) {
                    $data = $data->orderby('users.avg_rating', 'desc');
                }
            }
            if (isset($request->filter_new)) {
                if ($request->filter_new == 1) {
                    $data = $data->orderBy('users.created_at', 'asc');
                } elseif ($request->filter_new == 0) {
                    $data = $data->orderBy('users.created_at', 'desc');
                }
            }
        }
        $data = isset($request->paginate) && !empty($request->paginate) ? $data->paginate($request->paginate) : $data->paginate(25);
        foreach ($data as $datas) {
            $type = DB::table('translations')->where('category_type', Type::class)
                ->where('key', 'title');
            $type_buy = $type->wherein('value', ['buy', 'Buy'])->pluck('category_id');
            $type_rent = $type->wherein('value', ['rent', 'Rent'])->pluck('category_id');
            $type_commercial = $type->where('value', 'like', 'Commercial')
                ->orwhere('value', 'like', 'commercial')->pluck('category_id');
            $property = DB::table('properties')->where('user_id',$datas->id)->join('translations', 'properties.status_id', 'translations.category_id')
                ->where('translations.category_type', Status::class)->where('translations.key', 'title')
                ->where('translations.value', 'publish');
            $datas->buy_count = $property->wherein('type_id', $type_buy)->count();
            $datas->rent_count = $property->wherein('type_id', $type_rent)->count();
            $datas->commercial_count = $property->wherein('type_id', $type_commercial)->count();
        }
        return $data;
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $request->request->add(['role_id' => 5]);
            $user['user_id'] = $this->userRepository->storeData($request)->id;
            $data = $this->data->create(array_merge($request->all(), $user));
            foreach (language() as $lang) {
                if (isset($request->address[$lang->code])) {
                    $data->translation()->create(['key' => 'address', 'value' => $request->address[$lang->code],
                        'language_id' => $lang->id]);
                } else {
                    $data->translation()->create(['key' => 'address', 'value' => $request->address['en'],
                        'language_id' => $lang->id]);
                }
                if (isset($request->about_me[$lang->code])) {
                    $data->translation()->create(['key' => 'about_me', 'value' => $request->about_me[$lang->code],
                        'language_id' => $lang->id]);
                } else {
                    $data->translation()->create(['key' => 'about_me', 'value' => $request->about_me['en'],
                        'language_id' => $lang->id]);
                }
            }
        });
    }

    public function showData($id)
    {
        return $this->data->with('user', 'about_me', 'address', 'company')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            $this->userRepository->updateData($request, $data->user_id);
            foreach (language() as $lang) {
                $translation = $data->translation->where('language_id', $lang->id)->where('key', 'about_me')->first();
                if ($translation) {
                    $translation->update(['value' => $request->about_me[$lang->code]]);
                } else {
                    if (isset($request->about_me[$lang->code])) {
                        $data->translation()->create(['key' => 'about_me',
                            'value' => $request->about_me[$lang->code],
                            'language_id' => $lang->id]);
                    } else {
                        $data->translation()->create(['key' => 'about_me', 'value' => $request->about_me['en'],
                            'language_id' => $lang->id]);
                    }
                }
                $translation = $data->translation->where('language_id', $lang->id)->where('key', 'address')->first();
                if ($translation) {
                    $translation->update(['value' => $request->address[$lang->code]]);
                } else {
                    if (isset($request->address[$lang->code])) {
                        $data->translation()->create(['key' => 'address', 'value' => $request->address[$lang->code],
                            'language_id' => $lang->id]);
                    } else {
                        $data->translation()->create(['key' => 'address', 'value' => $request->address['en'],
                            'language_id' => $lang->id]);
                    }
                }
            }
        });
    }

    public function updateStatusData($id)
    {
        $this->userRepository->updateStatusData($id);
    }

    public function updateApproveData($id)
    {
        $this->changeApprove($this->userRepository->showData($id));
    }

    public function deleteData($id)
    {
        $this->showData($id)->delete();
    }

    public function getDataDelete()
    {
        return $this->data->onlyTrashed()->with('user', 'company')->paginate(25);
    }

    public function restoreData($id)
    {
        $this->data->withTrashed()->find($id)->restore();
    }

    public function removeData($id)
    {
        $data = $this->data->withTrashed()->find($id);
        $data->forceDelete();
    }

    public function listData()
    {
        return AgentListResource::collection(DB::table('agents')->join('users', 'users.id', '=', 'agents.user_id')
            ->where('users.status', 1)->where('users.approve', 1)->orderby('users.fullname', 'asc')->select('users.fullname', 'agents.*')->get());
    }
}
