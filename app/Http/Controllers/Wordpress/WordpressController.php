<?php

namespace App\Http\Controllers\Wordpress;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wordpress\Acl\UserController;
use App\Http\Controllers\Wordpress\CoreData\AmenityController;
use App\Http\Controllers\Wordpress\CoreData\CategoryController;
use App\Http\Controllers\Wordpress\CoreData\CityController;
use App\Http\Controllers\Wordpress\CoreData\HighLightController;
use App\Http\Controllers\Wordpress\CoreData\PackageController;
use App\Http\Controllers\Wordpress\CoreData\TypeController;
use Illuminate\Support\Facades\Http;

class WordpressController extends Controller
{
    private $amenity, $category, $type, $city, $high_light, $package, $user;

    public function __construct(AmenityController $AmenityController, CategoryController $CategoryController,
                                TypeController $TypeController, CityController $CityController, UserController $UserController,
                                HighLightController $HighLightController, PackageController $PackageController)
    {
        $this->amenity = $AmenityController;
        $this->category = $CategoryController;
        $this->type = $TypeController;
        $this->city = $CityController;
        $this->high_light = $HighLightController;
        $this->package = $PackageController;
        $this->user = $UserController;
    }

    public function index($return)
    {
        $response = Http::get('https://crm.deal360.ae/backend/api/fillPackages')->json();
        executionTime();
        $this->package->store($response);
        executionTime();
        $response = Http::withToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzc5YjZiNjkwOWI4OGNhMmUxZTdkZmQ3ZDI5ZjEyMGQyNDQ2YmRhOTE5NWVkNzc4ZDliZGU0NzI5MWYxNGMwM2ExNzgzMGVlODZjNTI3OWQiLCJpYXQiOjE2MTM5MTM3MzMsIm5iZiI6MTYxMzkxMzczMywiZXhwIjoxNjQ1NDQ5NzMzLCJzdWIiOiIxNyIsInNjb3BlcyI6W119.f1p3jcbeXdrVkyoSjCnHfCQHT5xm8S_vL7o4MLY41iITHHpBLNq1Coa2uhELWtE_Yt0Tjc7SKXw6_lpQO84haLcDVjba1M3oyadiiYywBwSNbK6fsrGzKotxug8EYUnjmt0bhD92luJKne8sx197QVM_Z2WhoiVY-fFRz3ZmDh4Yd3acmJVZ74jI3_PhQqCf5WSuaeCala4Y-I4Ffh9-w5q8tswHP_wNOLVanWVfcGnFORLSP5Vml6wpxWxTznkUknal7VE9hiuRl7RkIdpxWHXdCh74_wY9u9TZ5l6TDFZjA-U8g6IgQYeKGfOf7xAsZxETT0kU8AKIseDW_Ba9MUo7oG_wB4BpMrD9_jUQBw1fjAmkZQhuYHBp1n-a1f1jbSIVBgRI-uWFw3jmpMkeRV5d1DmZyc-RaOSmXTwkiWghWuFhRd6iWs8bw9H3gGw4co7D8tUk9cxYH4jL45FdMRyPPhoTxQ95tP0gIlWI7q6kH89FwW8Mlm3eCjVh8FDc09YYKmmY9LDH5PJb6FGSTSEoK_UCmeT_I3fpp7vu1vWUJvwD26KpHqJD5WcCHuPcSS899Y5d_MgW8cAoYrXqlpnhFcDAi_9g0uKKMceWk8v7qVKN23pGJrBE-OdA55YdQji2uj6aP1QoSMXFEG6arx6gaSre4KECBNSyzbFi1VA')
            ->get('https://crm.deal360.ae/backend/api/getData?lang=en')->json();
        executionTime();
        $this->amenity->store($response);
        executionTime();
        $this->category->store($response);
        executionTime();
        $this->type->store($response);
        executionTime();
        $this->city->store($response);
        executionTime();
        $this->high_light->store($response);
        executionTime();
        $this->user->store($response);
        executionTime();
        if ($return == 1) {
            return redirect(route('admin.dashboard'));
        }
    }
}
