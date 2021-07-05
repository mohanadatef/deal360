<?php

namespace App\Repositories\Setting;

use App\Interfaces\Setting\LabelInterface;
use App\Models\Setting\Label;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\DB;

class LabelRepository implements LabelInterface
{
    use ServiceDataTrait;

    protected $data;

    public function __construct(Label $Label)
    {
        $this->data = $Label;
    }

    public function getData()
    {
        return $this->data->with('translation_language')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            $this->storeCheckLanguage($data,$request);
        });
    }

    public function showData($id)
    {
        return $this->data->with('translation')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            $this->updateCheckLanguage($data,$request);
        });
    }
}
