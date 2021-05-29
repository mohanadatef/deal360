<?php

namespace App\Http\Controllers\Wordpress\CoreData;

use App\Http\Controllers\Controller;
use App\Models\Acl\Role;
use App\Models\CoreData\Package;
use App\Models\Translation;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function store()
    {
        $count_package = Package::latest('id')->first();
        $count_package = empty($count_package) ? 0 : $count_package;
        $url = 'https://crm.deal360.ae/backend/api/fillPackages';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch), TRUE);
        curl_close($ch);
        $data_package = array();
        $data_role = array();
        $data_translation = array();
        $language = language();
        $wp_packages_id = DB::table('packages')->pluck('wp_package_id', 'wp_package_id')->toarray();
        $role_name = DB::table('Translations')->where('category_type', Role::class)
            ->where('key', 'title')->pluck('value', 'category_id')->toarray();
        foreach ($response['data'] as $key => $package) {
            if (!in_array($package['wp_packages_id'], $wp_packages_id)) {
                $data_package[] = array('id' => $count_package + $key + 1,
                    'count_listing' => !empty($package['pack_listings']) ? $package['pack_listings'] : "0",
                    'image_included' => !empty($package['pack_image_included']) ? $package['pack_image_included'] : "0",
                    'count_featured' => !empty($package['pack_featured_listings']) ? $package['pack_featured_listings'] : "0",
                    'price' => !empty($package['pack_price']) ? $package['pack_price'] : "0",
                    'type_date' => !empty(strtolower($package['biling_period'])) ? strtolower($package['biling_period']) : "day",
                    'count_date' => !empty($package['billing_freq']) ? $package['billing_freq'] : "0",
                    'status' => $package['status'] == "publish" ? 1 : 0,
                    'order' => $count_package + $key + 1,
                    'currency_id' => 1,
                    'wp_package_id' => $package['wp_packages_id']);
                if (!empty($package['pack_visible_user_role'])) {
                    foreach ($package['pack_visible_user_role'] as $role) {
                        if (in_array(strtolower($role),$role_name)) {
                            $data_role[] = array('package_id' => $count_package + $key + 1, 'role_id' => array_search(strtolower($role),$role_name));
                        }
                    }
                }
                foreach ($language as $lang) {
                    $data_translation[] = array('category_type' => Package::class,
                        'category_id' => $count_package + $key + 1, 'key' => 'title', 'value' => !empty($package['name']) ? $package['name'] : 'free ' . ($key + 1),
                        'language_id' => $lang->id);
                }
            }
        }
        DB::table('packages')->insert($data_package);
        DB::table('package_roles')->insert($data_role);
        DB::table('translations')->insert($data_translation);
        return redirect(route('admin.dashboard'));
    }
}
