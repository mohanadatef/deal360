<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Language\CreateRequest;
use App\Http\Requests\Admin\CoreData\Language\EditRequest;
use App\Repositories\CoreData\LanguageRepository;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $languageRepository;

    public function __construct(LanguageRepository $LanguageRepository)
    {
        $this->languageRepository = $LanguageRepository;
        $this->middleware(['permission:language-list','permission:core-data-list'])->except('listIndex','language');
        $this->middleware('permission:language-index')->only('index');
        $this->middleware('permission:language-create')->only('store');
        $this->middleware('permission:language-edit')->only('show','update');
        $this->middleware('permission:language-status')->only('changeStatus');
        $this->middleware('permission:language-delete')->only('destroy');
        $this->middleware('permission:language-index-delete')->only('destroyIndex');
        $this->middleware('permission:language-restore')->only('restore');
        $this->middleware('permission:language-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->languageRepository->getData();
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
        $datas = $this->languageRepository->getDataDelete();
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
