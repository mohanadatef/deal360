<?php

namespace App\Repositories\Acl;

use App\Interfaces\Acl\FavouriteInterface;
use App\Models\Acl\Favourite;
use App\Repositories\Property\PropertyRepository;

class FavouriteRepository implements FavouriteInterface
{
	protected $data,$userRepository,$propertyRepository;

	public function __construct(Favourite $Favourite,UserRepository $UserRepository,PropertyRepository   $PropertyRepository)
	{
		$this->data=$Favourite;
		$this->userRepository=$UserRepository;
		$this->propertyRepository=$PropertyRepository;
	}

	public function getUser($property)
	{
		return $this->userRepository->showData($this->data->where('property_id',$property)->pluck('user_id'));
	}
	public function getProperty($user)
	{
        return $this->propertyRepository->showData($this->data->where('user_id',$user)->pluck('property_id'));
	}

	public function storeData($request)
	{
        $data=$this->showData($request->user_id,$request->property_id);
		!$data?$this->data->create($request->all()):true;
	}

	public function showData($user,$property)
	{
        return $this->data->where('property_id',$property)->where('user_id',$user)->first();
	}

	public function deleteData($user,$property)
	{
        $data=$this->showData($user,$property);
        $data?$data->delete():true;
	}
}
