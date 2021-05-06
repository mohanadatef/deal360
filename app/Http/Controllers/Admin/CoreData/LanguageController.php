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
        $datas = $this->languageRepository->getAllData();
        return view(checkView('admin.core_data.language.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->languageRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->languageRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->languageRepository->updateStatusData($id);
    }

    public function language(Request $request)
    {
        //save for 1 month
        return redirect()->back()->withCookie('language', $request->lang, 45000);
    }

    public function destroy($id)
    {
        $this->languageRepository->deleteData($id);
    }

    public function remove($id)
    {
        $this->languageRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->languageRepository->getAllDataDelete();
        return view(checkView('admin.core_data.language.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->languageRepository->restoreData($id);

    }

    public function listIndex()
    {
        return $this->languageRepository->listData();
    }

    public function show($id)
    {
        return $this->languageRepository->showData($id);
    }
}
