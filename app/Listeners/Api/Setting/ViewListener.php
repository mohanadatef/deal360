<?php

namespace App\Listeners\Api\Setting;

use App\Models\Acl\User;
use App\Models\Property\Property;
use App\Models\View;
use App\Repositories\Acl\UserRepository;
use App\Repositories\Property\PropertyRepository;
use Illuminate\Support\Facades\DB;

class ViewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $userRepository, $propertyRepository;

    public function __construct(UserRepository $UserRepository, PropertyRepository $PropertyRepository)
    {
        $this->userRepository = $UserRepository;
        $this->propertyRepository = $PropertyRepository;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $view = View::where('category_id',$event->id)
            ->where('category_type',$event->type)
            ->where('user_id',$event->auth_id)->count();
        if($view == 0)
        {
        $data = new View();
        $data->category_type=$event->type;
        $data->category_id=$event->id;
        $data->ip_address=$event->ip_address;
        $data->user_id=$event->auth_id;
        $data->save();
        if ($event->type == User::class) {
            DB::table('users')->where('id',$event->id)->increment('count_view', 1);
        } elseif ($event->type == Property::class) {
            DB::table('properties')->where('id',$event->id)->increment('count_view', 1);
        }
        }
    }
}
