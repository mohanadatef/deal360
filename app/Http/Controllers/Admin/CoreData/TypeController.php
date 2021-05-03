<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Type\CreateRequest;
use App\Http\Requests\Admin\CoreData\Type\EditRequest;
use App\Repositories\Admin\CoreData\TypeRepository;

class TypeController extends Controller
{
    private $typeRepository;

    public function __construct(TypeRepository $TypeRepository)
    {
        $this->typeRepository = $TypeRepository;
    }

    public function index()
    {
        $datas = $this->typeRepository->Get_All_Data();
        return view(check_view('admin.core_data.type.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->typeRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->typeRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->typeRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->typeRepository->Delete_Data($id);
    }

    public function remove($id)
    {;
        $this->typeRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->typeRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.type.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->typeRepository->Back_Data_Delete($id);
    }

    public function list_all()
    {
        return $this->typeRepository->List_Data();
    }

    public function show($id)
    {
        return $this->typeRepository->Get_Data($id);
    }
}
