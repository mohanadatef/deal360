<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\HighLight\CreateRequest;
use App\Http\Requests\Admin\CoreData\HighLight\EditRequest;
use App\Repositories\Admin\CoreData\HighLightRepository;

class HighLightController extends Controller
{
    private $highlightRepository;

    public function __construct(HighLightRepository $HighLightRepository)
    {
        $this->highlightRepository = $HighLightRepository;
    }

    public function index()
    {
        $datas = $this->highlightRepository->Get_All_Data();
        return view(check_view('admin.core_data.highlight.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->highlightRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->highlightRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->highlightRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->highlightRepository->Delete_Data($id);
    }

    public function remove($id)
    {
        $this->highlightRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->highlightRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.highlight.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->highlightRepository->Back_Data_Delete($id);
    }

    public function list_all()
    {
        return $this->highlightRepository->List_Data();
    }

    public function show($id)
    {
        return $this->highlightRepository->Get_Data($id);
    }
}
