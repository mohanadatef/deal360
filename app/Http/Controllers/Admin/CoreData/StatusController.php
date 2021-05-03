<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Status\CreateRequest;
use App\Http\Requests\Admin\CoreData\Status\EditRequest;
use App\Repositories\Admin\CoreData\StatusRepository;

class StatusController extends Controller
{
    private $statusRepository;

    public function __construct(StatusRepository $StatusRepository)
    {
        $this->statusRepository = $StatusRepository;
    }

    public function index()
    {
        $datas = $this->statusRepository->Get_All_Data();
        return view(check_view('admin.core_data.status.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->statusRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->statusRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->statusRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->statusRepository->Delete_Data($id);
    }

    public function remove($id)
    {
        $this->statusRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->statusRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.status.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->statusRepository->Back_Data_Delete($id);
    }

    public function list_all()
    {
        return $this->statusRepository->List_Data();
    }

    public function show($id)
    {
        return $this->statusRepository->Get_Data($id);
    }
}
