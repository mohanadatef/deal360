<?php

namespace App\Repositories\Acl;

use App\Http\Resources\Acl\Company\CompanyListResource;
use App\Interfaces\Acl\CompanyInterface;
use App\Models\Acl\User;
use App\Models\CoreData\Status;
use App\Models\CoreData\Type;
use App\Repositories\Property\PropertyRepository;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements CompanyInterface
{
    protected $data, $agencyrepository, $developerrepository,$propertyRepository;

    public function __construct(User $User, AgencyRepository $AgencyRepository, DeveloperRepository $DeveloperRepository,PropertyRepository $PropertyRepository)
    {
        $this->data = $User;
        $this->agencyrepository = $AgencyRepository;
        $this->developerrepository = $DeveloperRepository;
        $this->propertyRepository = $PropertyRepository;
    }

    public function getData($request)
    {
        return cache()->remember('company_get_all', 60 * 60 * 60, function ()  {
           $data = $this->data->with('developer.agent', 'agency.agent')->wherein('role_id', [4, 6])->status(1)->approve(1);
           $data = isset($request->paginate) && !empty($request->paginate) ? $data->paginate($request->paginate) : $data->paginate(25);
           if (isset($request->web)) {
               foreach ($data as $datas) {
                   $type = DB::table('translations')->where('category_type', Type::class)
                       ->where('key', 'title');
                   $type_buy = $type->wherein('value', ['buy', 'Buy'])->pluck('category_id');
                   $type_rent = $type->wherein('value', ['rent', 'Rent'])->pluck('category_id');
                   $type_commercial = $type->where('value', 'like', 'Commercial')
                       ->orwhere('value', 'like', 'commercial')->pluck('category_id');
                   $user_id[] = $datas->developer ? $datas->developer->id : $datas->agency->id;
                   $agents = $datas->developer ? $datas->developer->agent : $datas->agency->agent;
                   foreach ($agents as $agent) {
                       $user_id[] = $agent->id;
                   }
                   $property = DB::table('properties')->wherein('user_id', $user_id)->join('translations', 'properties.status_id', 'translations.category_id')
                       ->where('translations.category_type', Status::class)->where('translations.key', 'title')
                       ->where('translations.value', 'publish');
                   $datas->buy_count = $property->wherein('type_id', $type_buy)->count();
                   $datas->rent_count = $property->wherein('type_id', $type_rent)->count();
                   $datas->commercial_count = $property->wherein('type_id', $type_commercial)->count();
               }
           }
           return $data;
       });
    }

    public function showData($id, $role_id)
    {
        if ($role_id == 4) {
            $data = $this->agencyrepository->showData($id);
        } elseif ($role_id == 6) {
            $data = $this->developerrepository->showData($id);
        }
        $type = DB::table('translations')->where('category_type', Type::class)
            ->where('key', 'title');
        $type_buy = $type->wherein('value', ['buy', 'Buy'])->pluck('category_id');
        $type_rent = $type->wherein('value', ['rent', 'Rent'])->pluck('category_id');
        $type_commercial = $type->where('value', 'like', 'Commercial')
            ->orwhere('value', 'like', 'commercial')->pluck('category_id');
        $user_id[] = $data->id;
        foreach ($data->agent as $agent) {
            $user_id[] = $agent->id;
        }
        $property = DB::table('properties')->wherein('user_id', $user_id)->join('translations', 'properties.status_id', 'translations.category_id')
            ->where('translations.category_type', Status::class)->where('translations.key', 'title')
            ->where('translations.value', '!=','publish');
        $property_id=$property->pluck('properties.id');
        $data->property = $this->propertyRepository->showData($property_id);
        $data->buy_count = $property->wherein('type_id', $type_buy)->count();
        $data->rent_count = $property->wherein('type_id', $type_rent)->count();
        $data->commercial_count = $property->wherein('type_id', $type_commercial)->count();
        return $data;
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
