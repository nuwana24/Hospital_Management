<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //creation of a user 
    protected function createUser(Request $request)
    {

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password =  Hash::make($request['password']);

        $user->save();
        Session::flash('status_code','success');
        return redirect('/getRegisterdUsers')->with('status','User has been successfully added !');
    }

    //get all the registered users
    public function getUsers()
    {
        $users = User::all();
        $index=0;
        return view('user.users')->with('users',$users)->with('index',$index);
       
    }

    //get edit user page of a relavent user
    public function editUser($id)
    {
        $userToBeEdit = User::find($id);
        return view('user.updateUser')->with('userToBeEdit',$userToBeEdit);
    }


    //update the given user
    public function updateUser(Request $request, $id)
    {
        $userToBeUpdated = User::find($id);

        $userToBeUpdated->name = $request->input('username');
        $userToBeUpdated->email = $request->input('email');

        if($request->input('password') !== null)
        {
            $userToBeUpdated->password  = Hash::make($request['password']);
        }

        $userToBeUpdated->update();
        Session::flash('status_code','success');
        return redirect('/getRegisterdUsers')->with('status','User has been succfully updated.');
    }

    //delete the relavent user
    public function deleteUser($id)
    {
        $userToBeDelted = User::find($id);
        $userToBeDelted->delete();
        Session::flash('status_code','success');
        return redirect('/getRegisterdUsers')->with('status','User has been succfully deleted.');
    }


    //get the assign roles to the relavent user page
    public function editAssigningRolesToUser($id)
    {
        $user = User::find($id);
        $assingedRoles = ($user->roles->pluck('name'))->toArray();
        $allRoles = Role::all();
        $index = 0;

        return view('user.assignRolesToUser')->with('assingedRoles',$assingedRoles)->with('allRoles',$allRoles)->with('user',$user)->with('index',$index);;
    }


    //assign roles to the given user
    public function updateAssigningRolesToUser(Request $request,$id)
    {

        $user = User::find($id);
        $allRoles = Role::all();
        $newlyassignedRoles = $request->input('roles');
        $oldassingedRoles = ($user->roles->pluck('id'))->toArray();
    
        if ($newlyassignedRoles == null)
        {
            if($oldassingedRoles !== null)
            {
                foreach($oldassingedRoles as $oldassingedRole)
                {
                    $user->removeRole(Role::find($oldassingedRole)->name);
                    
                }
            } 
        }
    
        else
        {
            foreach($allRoles as $role)
            {
                if(in_array($role -> id, $newlyassignedRoles))
                {
                    if(!in_array($role -> id, $oldassingedRoles))
                    {
                        $user->assignRole($role->name);
                    }
                }
                else
                {
                    if(in_array($role -> id, $oldassingedRoles))
                    {
                        $user->removeRole($role->name);
                    }
                }
    
            }
        }

        Session::flash('status_code','success');
        return redirect('/getRegisterdUsers')->with('status','Successfully updated the user roles.');;
    }
    

    //this is for testing and can create a user manaully.
    public function create()
    {
        return User::create([
            'name' => "SA",
            'email' => "SA@gmail.com",
            'password' => Hash::make('12345678'),
        ]);
    }

}
