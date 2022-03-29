<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //get all permissions
    public function getAllPermissions()
   {
       $allPermissions  = Permission::all();
       $index = 0;
       return view ('permission.permissionList')->with('allPermissions',$allPermissions)->with('index',$index);

   }

   //this is used for developer usage. We can mannually add permissions using this function.
   public function createPermission()
   {
    Permission::create(['name'=>"display wards"]);
    return "success";
   }
}
