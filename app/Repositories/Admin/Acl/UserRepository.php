<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\User\UserResource;
use App\Interfaces\Admin\Acl\UserInterface;
use App\Models\Acl\User;
use App\Traits\Service;
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
        return $this->data->with('role', 'country')->order('asc')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            return '<tr id="' . $data->id . '"><td id="fullname-' . $data->id . '" data-order="' . $data->order . '">' . $data->fullname . '</td>
                <td id="username-' . $data->id . '" >' . $data->username . '</td><td id="email-' . $data->id . '" >' . $data->email . '</td>
                <td id="role-' . $data->id . '" >' . $data->role->title->value . '</td>
                <td id="country-' . $data->id . '" >' . $data->country->title->value . '</td>
            <td><input onfocus="changeStatus(' . $data->id . ')" type="checkbox" name="status"
            id="status-' . $data->id . '" checked data-bootstrap-switch data-off-color="danger"
            data-on-color="success"></td><td><a href="' . route('user.edit', $data->id) . '"
              class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-edit"></i>' . trans('lang.Edit') . '</a>
                <button data="button" class="btn btn-outline-danger btn-block btn-sm"
                onclick="selectItem(' . $data->id . ')" data-toggle="modal"
                data-target="#modal-delete"><i></i> ' . trans('lang.Delete') . '</button></td></tr>';
        });
    }

    public function showData($id)
    {
        return $this->data->with('role', 'country')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id)->update($request->all());
            return new UserResource($data);
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
        return $this->data->onlyTrashed()->with('role', 'country')->order('asc')->get();
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
