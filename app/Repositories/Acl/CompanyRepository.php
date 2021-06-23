<?php

namespace App\Repositories\Acl;

use App\Http\Resources\Acl\Company\CompanyListResource;
use App\Interfaces\Acl\CompanyInterface;
use App\Models\Acl\User;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements CompanyInterface
{
    protected $data,$agencyrepository,$developerrepository;

    public function __construct(User $User,AgencyRepository $AgencyRepository,DeveloperRepository $DeveloperRepository)
    {
        $this->data = $User;
        $this->agencyrepository = $AgencyRepository;
        $this->developerrepository = $DeveloperRepository;
    }

    public function getData($request)
    {
        $data = $this->data->with('developer.agent', 'agency.agent')->wherein('role_id', [4, 6])->status(1)->approve(1);
        return isset($request->paginate) && !empty($request->paginate) ? $data->paginate($request->paginate) : $data->paginate(25);
    }

    public function showData($id,$role_id)
    {
        if($role_id == 4)
        {
          return  $this->agencyrepository->showData($id);
        }elseif ($role_id == 6)
        {
            return  $this->developerrepository->showData($id);
        }
    }

    public function listData($request)
    {
        return CompanyListResource::collection(DB::table('users')
            ->wherein('users.role_id', [4, 6])
            ->where('users.status', 1)
            ->where('users.approve', 1)
            ->leftjoin('agencies', 'agencies.user_id', '=', 'users.id')
            ->leftjoin('developers', 'developers.user_id', '=', 'users.id')
            ->orderby('users.fullname', 'asc')
            ->select('users.*', 'users.fullname', 'agencies.id as company_id', 'developers.id as company_id1')->get());
    }
}
