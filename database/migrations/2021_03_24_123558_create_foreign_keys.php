<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('rejoins', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('agents', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('agencies', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('currencies', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('agency_agents', function (Blueprint $table) {
            $table->foreign('agency_id')->references('id')->on('agencies')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('agent_id')->references('id')->on('agents')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('package_roles', function (Blueprint $table) {
            $table->foreign('package_id')->references('id')->on('packages')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('save_searchs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('rejoin_id')->references('id')->on('rejoins')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('high_light_id')->references('id')->on('high_lights')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('forgot_passwords', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('user_packages', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('package_id')->references('id')->on('packages')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('favourites', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('property_id')->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('property_floor_plans', function (Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('property_photographic_informations', function (Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('user_package_properties', function (Blueprint $table) {
            $table->foreign('user_package_id')->references('id')->on('user_packages')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('property_id')->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('property_amenities', function (Blueprint $table) {
            $table->foreign('amenity_id')->references('id')->on('amenities')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('property_id')->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('rejoin_id')->references('id')->on('rejoins')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('high_light_id')->references('id')->on('high_lights')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('status_id')->references('id')->on('status')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->dropForeign('translations_language_id_foreign');
        });
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign('cities_country_id_foreign');
        });
        Schema::table('rejoins', function (Blueprint $table) {
            $table->dropForeign('rejoins_country_id_foreign');
            $table->dropForeign('rejoins_city_id_foreign');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropForeign('users_country_id_foreign');
        });
        Schema::table('agents', function (Blueprint $table) {
            $table->dropForeign('agents_user_id_foreign');
        });
        Schema::table('agencies', function (Blueprint $table) {
            $table->dropForeign('agencies_user_id_foreign');
        });
        Schema::table('currencies', function (Blueprint $table) {
            $table->dropForeign('currencies_country_id_foreign');
        });
        Schema::table('agency_agents', function (Blueprint $table) {
            $table->dropForeign('agency_agents_agent_id_foreign');
            $table->dropForeign('agency_agents_agency_id_foreign');
        });
        Schema::table('package_roles', function (Blueprint $table) {
            $table->dropForeign('package_roles_package_id_foreign');
            $table->dropForeign('package_roles_role_id_foreign');
        });
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropForeign('role_permissions_role_id_foreign');
            $table->dropForeign('role_permissions_permission_id_foreign');
        });
        Schema::table('save_searchs', function (Blueprint $table) {
            $table->dropForeign('save_searchs_user_id_foreign');
            $table->dropForeign('save_searchs_high_light_id_foreign');
            $table->dropForeign('save_searchs_country_id_foreign');
            $table->dropForeign('save_searchs_city_id_foreign');
            $table->dropForeign('save_searchs_rejoin_id_foreign');
            $table->dropForeign('save_searchs_type_id_foreign');
            $table->dropForeign('save_searchs_category_id_foreign');
        });
        Schema::table('forgot_passwords', function (Blueprint $table) {
            $table->dropForeign('forgot_passwords_user_id_foreign');
        });
        Schema::table('user_packages', function (Blueprint $table) {
            $table->dropForeign('user_packages_user_id_foreign');
            $table->dropForeign('user_packages_package_id_foreign');
        });
        Schema::table('favourites', function (Blueprint $table) {
            $table->dropForeign('favourites_user_id_foreign');
            $table->dropForeign('favourites_property_id_foreign');
        });
        Schema::table('user_package_properties', function (Blueprint $table) {
            $table->dropForeign('user_package_properties_user_package_id_foreign');
            $table->dropForeign('user_package_properties_property_id_foreign');
        });
        Schema::table('property_amenities', function (Blueprint $table) {
            $table->dropForeign('property_amenities_amenity_id_foreign');
            $table->dropForeign('property_amenities_property_id_foreign');
        });
        Schema::table('property_floor_plans', function (Blueprint $table) {
            $table->dropForeign('property_floor_plans_property_id_foreign');
        });
        Schema::table('property_photographic_informations', function (Blueprint $table) {
            $table->dropForeign('property_photographic_informations_property_id_foreign');
            $table->dropForeign('property_photographic_informations_user_id_foreign');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_property_id_foreign');
            $table->dropForeign('reviews_user_id_foreign');
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign('properties_user_id_foreign');
            $table->dropForeign('properties_high_light_id_foreign');
            $table->dropForeign('properties_country_id_foreign');
            $table->dropForeign('properties_city_id_foreign');
            $table->dropForeign('properties_rejoin_id_foreign');
            $table->dropForeign('properties_type_id_foreign');
            $table->dropForeign('properties_category_id_foreign');
            $table->dropForeign('properties_status_id_foreign');
        });
    }
}
