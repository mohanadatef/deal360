<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Language\CreateRequest;
use App\Http\Requests\Admin\CoreData\Language\EditRequest;
use App\Repositories\Admin\CoreData\LanguageRepository;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $languageRepository;

    public function __construct(LanguageRepository $LanguageRepository)
    {
        $this->languageRepository = $LanguageRepository;
    }

    public function index()
    {
        $datas = $this->languageRepository->Get_All_Data();
        return view(check_view('admin.core_data.language.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->languageRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->languageRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->languageRepository->Update_Status_Data($id);
    }

    public function language(Request $request)
    {
        //save for 1 month
        return redirect()->back()->withCookie('language', $request->lang, 45000);
    }

    public function destroy($id)
    {
        $this->languageRepository->Delete_Data($id);
    }

    public function remove($id)
    {
        $this->languageRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->languageRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.language.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->languageRepository->Back_Data_Delete($id);

    }

    public function list_all()
    {
        return $this->languageRepository->List_Data();
    }
}
