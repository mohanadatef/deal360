<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Amenity\CreateRequest;
use App\Http\Requests\Admin\CoreData\Amenity\EditRequest;
use App\Http\Resources\Admin\Amenity\AmenityListResource;
use App\Repositories\Admin\CoreData\AmenityRepository;

class AmenityController extends Controller
{
    private $amenityRepository;

    public function __construct(AmenityRepository $AmenityRepository)
    {
        $this->amenityRepository = $AmenityRepository;
    }

    public function index()
    {
        $datas = $this->amenityRepository->Get_All_Data();
        return view(check_view('admin.core_data.amenity.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->amenityRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->amenityRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->amenityRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->amenityRepository->Delete_Data($id);
    }

    public function remove($id)
    {;
        $this->amenityRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->amenityRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.amenity.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->amenityRepository->Back_Data_Delete($id);
    }

    public function list_all()
    {
        return $this->amenityRepository->List_Data();
    }

    public function show($id)
    {
        return $this->amenityRepository->Get_Data($id);
    }
}
