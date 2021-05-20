<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\User\UserResource;
use App\Interfaces\Admin\Acl\UserInterface;
use App\Models\Acl\User;
use App\Traits\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface
{
    use Service;

    protected $data;

    public function __construct(User $User)
    {
        $this->data = $User;
    }

    public function getData()
    {
        return $this->data->with('role', 'country','image')->order('asc')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            if (Auth::user())
            {
                $data_auth['approve']=1;
                $data_auth['email_verified_at']=Carbon::now();
                $data=$this->data->create(array_merge($request->all(),$data_auth->toarray()));
            }else
            {
                $data=$this->data->create($request->all());
            }
            $data=$this->data->create($request->all());
            $imageName = time() . $request->image->getClientOriginalname();
            $image = $data->image()->create(['image' => $imageName]);
            !$image->image ? false : $this->uploadImage($request->image, 'user', $imageName);
        });
    }

    public function showData($id)
    {
        return $this->data->with('role', 'country','image')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $data->image()->forceDelete();
                $image = $data->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->uploadImage($request->image, 'user', $imageName);
            }
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
        return $this->data->onlyTrashed()->with('role', 'country','image')->order('asc')->get();
    }

    public function restoreData($id)
    {
        $this->data->withTrashed()->find($id)->restore();
    }

    public function removeData($id)
    {
        $this->data->withTrashed()->find($id)->forceDelete();
    }
}
