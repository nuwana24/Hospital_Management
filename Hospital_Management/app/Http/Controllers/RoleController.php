<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use app\Models\User;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    //creation of a role
    public function createRole(Request $request)
    {
        Role::create(['name'=>$request->input('name')]);
        Session::flash('status_code','success');
        
        return redirect('/getRoles')->with('status', 'succesfully added a new role.');
    }

    //get all the roles
    public function getRoles()
    {
        
        $roles = Role::all();
        $index = 0;
        return view('role.roleList')->with('roles',$roles)->with('index',$index);

    }

    //allows to get the page of assign permission page to relavent role
    public function editAssigningPermissionToRole($id)
    {
        $role = Role::find($id);
        $assingedPermissions = ($role->permissions->pluck('name'))->toArray();
        $allPermissions = Permission::all();
        $index = 0;

        return view('role.assignPermissionToRole')->with('assingedPermissions',$assingedPermissions)->with('allPermissions',$allPermissions)->with('role',$role)->with('index',$index);;


    }

    //update and assign permissions to given role
    public function updateAssigningPermissionToRole(Request $request,$id)
    {

        $role = Role::find($id);
        $allPermissions = Permission::all();
        $newlyassignedPermissions = $request->input('permissions');
        $oldassingedPermissions = ($role->permissions->pluck('id'))->toArray();

        if ($newlyassignedPermissions == null)
        {
            if($oldassingedPermissions !== null)
            {
                foreach($oldassingedPermissions as $oldPermission)
                {
                    $role->revokePermissionTo(Permission::find($oldPermission));
                }
            } 
        }

        else
        {
            foreach($allPermissions as $permission)
            {
                if(in_array($permission -> id, $newlyassignedPermissions))
                {
                    if(!in_array($permission -> id, $oldassingedPermissions))
                    {
                        $role->givePermissionTo($permission);
                    }
                }
                else
                {
                    if(in_array($permission -> id, $oldassingedPermissions))
                    {
                        $role->revokePermissionTo($permission);
                    }
                }
    
            }
        }
        
        Session::flash('status_code','info');
        return redirect('/getRoles')->with('status', 'succesfully changed the assigned permissions.');

    }

    //get the edit role page
    public function editRole($id)
    {
        $role = Role::find($id);
        return view ('role.editRole')->with('role',$role);

    }

    //update the given role 
    public function updateRole(Request $request , $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        Session::flash('status_code','success');
        return redirect('/getRoles')->with('status', 'succesfully updated role name !');
    }

}
