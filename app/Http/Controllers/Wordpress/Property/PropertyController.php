<?php
    
    namespace App\Http\Controllers\Wordpress\Property;
    
    use App\Http\Controllers\Controller;
    use App\Models\CoreData\Amenity;
    use App\Models\CoreData\Category;
    use App\Models\CoreData\City;
    use App\Models\CoreData\Currency;
    use App\Models\CoreData\HighLight;
    use App\Models\CoreData\Status;
    use App\Models\CoreData\Type;
    use App\Models\Property\Property;
    use App\Models\Property\PropertyFloorPlan;
    use App\Traits\ImageTrait;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Http;
    
    class PropertyController extends Controller
    {
        use ImageTrait;
        
        public function index($return)
        {
            $link='http://crm.deal360.ae/backend/api/fillProperty?num=50&page=1';
            $response=Http::get($link)->json();
            $this->store($response);
            if($return==1)
            {
                return redirect(route('admin.dashboard'));
            }
        }
        
        public function store($response)
        {
            $count_property=Property::latest('id')->first();
            $count_property=empty($count_property)?0:$count_property->id;
            $data_property=array();
            $data_translation=array();
            $property_image=array();
            $property_image_plan=array();
            $language=language();
            $image_plan=language();
            $image=array();
            $photographer=array();
            $floor_plan=array();
            $amenity_property=array();
            $status_name=DB::table('translations')->where('category_type',Status::class)
                ->where('language_id',languageId())->where('key','title')->pluck('value','category_id')->toarray();
            $currency_name=DB::table('translations')->where('category_type',Currency::class)
                ->where('language_id',languageId())->where('key','title')->pluck('value','category_id')->toarray();
            $category_name=DB::table('translations')->where('category_type',Category::class)
                ->where('language_id',languageId())->where('key','title')->pluck('value','category_id')->toarray();
            $type_name=DB::table('translations')->where('category_type',Type::class)->where('language_id',languageId())
                ->where('key','title')->pluck('value','category_id')->toarray();
            $high_light_name=DB::table('translations')->where('category_type',HighLight::class)
                ->where('language_id',languageId())->where('key','title')->pluck('value','category_id')->toarray();
            $city_name=DB::table('translations')->where('category_type',City::class)->where('language_id',languageId())
                ->where('key','title')->pluck('value','category_id')->toarray();
            $amenity_name=DB::table('translations')->where('category_type',Amenity::class)
                ->where('language_id',languageId())->where('key','title')->pluck('value','category_id')->toarray();
            $wp_properties_id=DB::table('properties')->pluck('wp_property_id','wp_property_id')->toarray();
            $wp_users_id=DB::table('users')->pluck('wp_user_id','id')->toarray();
            $last=$response['pages']['lastPage'];
            executionTime();
            for($page=1;$page<=$last;$page++)
            {
                executionTime();
                $link='http://crm.deal360.ae/backend/api/fillProperty?num=50&page='.$page;
                executionTime();
                $response=Http::get($link)->json();
                executionTime();
                foreach($response['data'] as $key=>$property)
                {
                    executionTime();
                    if($property['language_code']=='en')
                    {
                        executionTime();
                        if(!in_array($property['wp_id'],$wp_properties_id))
                        {
                            executionTime();
                            $data_property[]=array('id'            =>$count_property+$key+1,
                                                   'wp_property_id'=>$property['wp_id'],
                                                   'status_id'     =>in_array(strtolower($property["post_status"]),$status_name)?array_search(strtolower($property["post_status"]),$status_name):1,
                                                   'price'         =>empty($property['price'])?0:$property['price'],
                                                   'youtube_id'    =>empty($property['embed_Video_id'])?:$property['embed_Video_id'],
                                                   'virtual_tour'  =>empty($property['virtual_tour'])?:$property['virtual_tour'],
                                                   'latitude'      =>empty($property['latitude'])?:$property['latitude'],
                                                   'longitude'     =>empty($property['longitude'])?:$property['longitude'],
                                                   'country_id'     =>1,
                                                   'rejoin_id'     =>1,
                                                   'order' => $count_property + $key + 1,
                                                   'user_id'       =>!empty($property['agent_id'])&&$property['agent_id']!=0?(!in_array($property['agent_id'],$wp_users_id)?:array_search($property['agent_id'],$wp_users_id)):(!empty($property['agency_id'])&&$property['agency_id']!=0?(!in_array($property['agency_id'],$wp_users_id)?:array_search($property['agency_id'],$wp_users_id)):1),
                                                   'size'          =>empty($property['size'])?0:$property['size'],
                                                   'lot_size'      =>empty($property['lot_size'])?0:$property['lot_size'],
                                                   'room'          =>empty($property['rooms'])?0:$property['rooms'],
                                                   'area'          =>empty($property['area'])?0:$property['area'],
                                                   'bedroom'       =>empty($property['bedrooms'])?0:$property['bedrooms'],
                                                   'bathroom'      =>empty($property['bathrooms'])?0:$property['bathrooms'],
                                                   'floor_number'  =>empty($property['floors_num'])?0:$property['floors_num'],
                                                   'garage'        =>empty($property['garages'])?0:$property['garages'],
                                                   'type_date'     =>empty($property['rent_time_id'])?:$property['rent_time_id'],
                                                   'available_from'=>empty($property['available_from'])?:$property['available_from'],
                                                   'currency_id'   =>in_array(strtolower($property["currency_id"]),$currency_name)?array_search(strtolower($property["currency_id"]),$currency_name):1,
                                                   'category_id'   =>in_array(strtolower($property["category_id"]),$category_name)?array_search(strtolower($property["category_id"]),$category_name):1,
                                                   'high_light_id' =>in_array(strtolower($property["status_id"]),$high_light_name)?array_search(strtolower($property["status_id"]),$high_light_name):1,
                                                   'city_id'       =>in_array(strtolower($property["city"]),$city_name)?array_search(strtolower($property["city"]),$city_name):1,
                                                   'type_id'       =>in_array(strtolower($property["type"]),$type_name)?array_search(strtolower($property["type"]),$type_name):1,);
                            executionTime();
                            foreach($language as $lang)
                            {
                                executionTime();
                                $data_translation[]=array('category_type'=>Property::class,
                                                          'category_id'  =>$count_property+$key+1,'key'=>'title',
                                                          'value'        =>!empty($property['title'][$lang->code])?$property['title'][$lang->code]:" ",
                                                          'language_id'  =>$lang->id);
                                $data_translation[]=array('category_type'=>Property::class,
                                                          'category_id'  =>$count_property+$key+1,'key'=>'description',
                                                          'value'        =>!empty($property['description'][$lang->code])?$property['description'][$lang->code]:" ",
                                                          'language_id'  =>$lang->id);
                                $data_translation[]=array('category_type'=>Property::class,
                                                          'category_id'  =>$count_property+$key+1,'key'=>'address',
                                                          'value'        =>!empty($property['address'])?$property['address']:" ",
                                                          'language_id'  =>$lang->id);
                            }
                            executionTime();
                            if(!empty($property['image']))
                            {
                                executionTime();
                                foreach($property['image'] as $property_image)
                                {
                                    executionTime();
                                    $image[]=array('id'=>$count_property+$key+1,'image_url'=>$property_image);
                                }
                            }
                            executionTime();
                            if(!empty($property['photographer']))
                            {
                                executionTime();
                                if(!empty($property['photographer']['shooting_date']))
                                {
                                    executionTime();
                                    $photographer[]=array('property_id'=>$count_property+$key+1,'user_id'=>Auth::id(),
                                                          'date'       =>$property['photographer']['shooting_date'],
                                                          'time'       =>$property['photographer']['shooting_time'],
                                                          'name'       =>$property['photographer']['site_contact_name'],
                                                          'number'     =>$property['photographer']['site_contact_number'],
                                                          'address'    =>$property['photographer']['site_contact_address'],
                                                          'notes'      =>$property['photographer']['notes']);
                                }
                            }
                            executionTime();
                            if(!empty($property['property_features']))
                            {
                                executionTime();
                                foreach($property['property_features'] as $property_amenity)
                                {
                                    executionTime();
                                    $amenity_property[]=array('property_id'=>$count_property+$key+1,
                                                              'amenity_id' =>in_array(strtolower($property_amenity),$amenity_name)?array_search(strtolower($property_amenity),$amenity_name):1);
                                }
                            }
                            executionTime();
                            if(!empty($property['plans']))
                            {
                                executionTime();
                                foreach($property['plans'] as $keys=>$property_plan)
                                {
                                    executionTime();
                                    $floor_plan[]=array('id'         =>$count_property+$keys+1,
                                                        'property_id'=>$count_property+$key+1,
                                                        'size'       =>!empty($property_plan['size'])?$property_plan['size']:0,
                                                        'room'       =>!empty($property_plan['rooms'])?$property_plan['rooms']:0,
                                                        'bathroom'   =>!empty($property_plan['bathRooms'])?$property_plan['bathRooms']:0,
                                                        'bedroom'    =>!empty($property_plan['bedRooms'])?$property_plan['bedRooms']:0,
                                                        'price'      =>!empty($property_plan['price'])?$property_plan['price']:0);
                                    if($property_plan['image'])
                                    {
                                        executionTime();
                                        $image_plan[]=array('id'       =>$count_property+$keys+1,
                                                            'image_url'=>$property_plan['image']);
                                    }
                                    foreach($language as $lang)
                                    {
                                        executionTime();
                                        $data_translation[]=array('category_type'=>PropertyFloorPlan::class,
                                                                  'category_id'  =>$count_property+$keys+1,
                                                                  'key'          =>'title',
                                                                  'value'        =>!empty($property['title'])?$property['title']:" ",
                                                                  'language_id'  =>$lang->id);
                                        $data_translation[]=array('category_type'=>PropertyFloorPlan::class,
                                                                  'category_id'  =>$count_property+$keys+1,
                                                                  'key'          =>'description',
                                                                  'value'        =>!empty($property['description'])?$property['description']:" ",
                                                                  'language_id'  =>$lang->id);
                                    }
                                }
                            }
                        }
                        executionTime();
                    }
                    executionTime();
                }
                executionTime();
            }
            executionTime();
            DB::transaction(function() use ($data_property,$data_translation,$image,$photographer,$amenity_property,$floor_plan,$image_plan,$property_image,$property_image_plan)
            {
                DB::table('properties')->insert($data_property);
                executionTime();
                DB::table('translations')->insert($data_translation);
                executionTime();
                DB::table('property_photographic_informations')->insert($photographer);
                executionTime();
                DB::table('property_floor_plans')->insert($floor_plan);
                executionTime();
                DB::table('property_amenities')->insert($amenity_property);
                executionTime();
                foreach($image as $im)
                {
                    executionTime();
                    $name=$this->uploadImageWordpress($im['image_url'],'property');
                    executionTime();
                    $property_image[]=array('category_type'=>Property::class,'category_id'=>$im['id'],'image'=>$name);
                    executionTime();
                }
                executionTime();
                DB::table('images')->insert($property_image);
                executionTime();
                foreach($image_plan as $im)
                {
                    executionTime();
                    $name=$this->uploadImageWordpress($im['image_url'],'property_plan');
                    executionTime();
                    $property_image_plan[]=array('category_type'=>PropertyFloorPlan::class,'category_id'=>$im['id'],
                                                 'image'        =>$name);
                    executionTime();
                }
                executionTime();
                DB::table('images')->insert($property_image_plan);
            });
        }
    }
