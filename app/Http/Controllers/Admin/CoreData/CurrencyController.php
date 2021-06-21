<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Currency\CreateRequest;
use App\Http\Requests\Admin\CoreData\Currency\EditRequest;
use App\Repositories\CoreData\CountryRepository;
use App\Repositories\CoreData\CurrencyRepository;

class CurrencyController extends Controller
{
    private $currencyRepository;
    private $countryRepository;

    public function __construct(CurrencyRepository $CurrencyRepository,CountryRepository $CountryRepository)
    {
        $this->currencyRepository = $CurrencyRepository;
        $this->countryRepository = $CountryRepository;
        $this->middleware(['permission:currency-list','permission:core-data-list'])->except('listIndex');
        $this->middleware('permission:currency-index')->only('index');
        $this->middleware('permission:currency-create')->only('store');
        $this->middleware('permission:currency-edit')->only('show','update');
        $this->middleware('permission:currency-status')->only('changeStatus');
        $this->middleware('permission:currency-delete')->only('destroy');
        $this->middleware('permission:currency-index-delete')->only('destroyIndex');
        $this->middleware('permission:currency-restore')->only('restore');
        $this->middleware('permission:currency-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->currencyRepository->getData();
        $country = $this->countryRepository->listData();
        return view(checkView('admin.core_data.currency.index'), compact('datas','country'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->currencyRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->currencyRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->currencyRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->currencyRepository->deleteData($id);
    }

    public function remove($id)
    {
        $this->currencyRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->currencyRepository->getDataDelete();
        return view(checkView('admin.core_data.currency.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->currencyRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->currencyRepository->listData();
    }

    public function show($id)
    {
        return $this->currencyRepository->showData($id);
    }
}
