<?php

namespace App\Repositories\Admin\Setting;

use App\Http\Resources\Setting\FQ\FQListResource;
use App\Http\Resources\Setting\FQ\FQResource;
use App\Interfaces\Admin\MeanInterface;
use App\Models\Setting\FQ;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\DB;

class FQRepository implements MeanInterface
{
    use ServiceDataTrait;

    protected $data;

    public function __construct(FQ $FQ)
    {
        $this->data = $FQ;
    }

    public function getData()
    {
        return $this->data->with('answer', 'question')->order('asc')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            foreach (language() as $lang) {
                if (isset($request->question[$lang->code])) {
                    $data->translation()->create(['key' => 'question', 'value' => $request->question[$lang->code],
                        'language_id' => $lang->id]);
                } else {
                    $data->translation()->create(['key' => 'question', 'value' => $request->question['en'],
                        'language_id' => $lang->id]);
                }
                if (isset($request->answer[$lang->code])) {
                    $data->translation()->create(['key' => 'answer', 'value' => $request->answer[$lang->code],
                        'language_id' => $lang->id]);
                } else {
                    $data->translation()->create(['key' => 'answer', 'value' => $request->answer['en'],
                        'language_id' => $lang->id]);
                }
            }
            return '<tr id="' . $data->id . '"><td id="question-' . $data->id . '" data-order="' . $data->order . '">' . $data->question->value . '</td>
                    <td id="answer-' . $data->id . '">' . $data->answer->value . '</td>
                    <td><input onfocus="changeStatus(' . $data->id . ')" type="checkbox" name="status" id="status-' . $data->id . '"
                    checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                    <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                    onclick="showItem(' . $data->id . ')"><i class="fa fa-edit"></i> ' . trans('lang.Edit') . '</button>
                    <button id="openModael' . $data->id . '" type="button" class="d-none" data-toggle="modal"
                    data-target="#modal-edit"></button>
                    <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                    onclick="selectItem(' . $data->id . ')" data-toggle="modal"
                    data-target="#modal-delete"><i></i> ' . trans('lang.Delete') . '</button></td></tr>';
        });
    }

    public function showData($id)
    {
        return $this->data->with('translation.language')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            foreach (language() as $lang) {
                $translation = $data->translation->where('language_id', $lang->id)->where('key','question')->first();
                if ($translation) {
                    $translation->update(['value' => $request->question[$lang->code]]);
                } else {
                    if (isset($request->question[$lang->code])) {
                        $data->translation()->create(['key' => 'question', 'value' => $request->question[$lang->code],
                            'language_id' => $lang->id]);
                    } else {
                        $data->translation()->create(['key' => 'question', 'value' => $request->question['en'],
                            'language_id' => $lang->id]);
                    }
                }
                $translation = $data->translation->where('language_id', $lang->id)->where('key','answer')->first();
                if ($translation) {
                    $translation->update(['value' => $request->answer[$lang->code]]);
                } else {
                    if (isset($request->answer[$lang->code])) {
                        $data->translation()->create(['key' => 'answer', 'value' => $request->answer[$lang->code],
                            'language_id' => $lang->id]);
                    } else {
                        $data->translation()->create(['key' => 'answer', 'value' => $request->answer['en'],
                            'language_id' => $lang->id]);
                    }
                }
            }
            $data = $this->showData($id);
            return new FQResource($data);
        });
    }

    public function updateStatusData($id)
    {
        $this->changeStatus($this->showData($id));
    }

    public function deleteData($id)
    {
        $this->showData($id)->delete();
    }

    public function getDataDelete()
    {
        return $this->data->onlyTrashed()->with('translation')->order('asc')->get();
    }

    public function restoreData($id)
    {
        $this->data->withTrashed()->find($id)->restore();
    }

    public function removeData($id)
    {
        $this->data->withTrashed()->find($id)->forceDelete();
    }

    public function listData()
    {
        return FQListResource::collection($this->data->status('1')->order('asc')->with('answer', 'question')->get());
    }
}
