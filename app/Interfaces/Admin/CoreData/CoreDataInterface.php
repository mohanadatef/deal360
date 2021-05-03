<?php

namespace App\Interfaces\Admin\CoreData;

interface CoreDataInterface
{
    public function Get_All_Data();
    public function Create_Data($request);
    public function Get_Data($id);
    public function Update_Data($request, $id);
    public function Update_Status_Data($id);
    public function Delete_Data($id);
    public function Get_All_Data_Delete();
    public function Back_Data_Delete($id);
    public function Remove_Data($id);
    public function List_Data();
}
