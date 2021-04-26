<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;

class AuthorizationController extends Controller
{
    public function role_index()
    {
        $roles=Role::all();
        return view('Role.index',compact('roles'));
    }
 
    public function role_create()
    {
        return view('Role.create');
    }
    public function role_store(Request $request)
    {
        $role= new Role;
        $role->name=$request->name;
       $role->display_name=$request->display_name;
        $role->description=$request->description;
        $role->save();
        return redirect()->route('role.index');
    }

    public function role_edit($id)
    {
       $permissions=Permission::all();
       $role=Role::find($id);
       return view('role.edit',compact('permissions','role'));
    }
    public function role_update(Request $request,$id)
    {
       $role=Role::find($id);
       $role->name=$request->name;
       $role->description=$request->description;
       $role->display_name=$request->display_name;
       $role->save();
       $role->permissions()->sync($request->permissions);
       return redirect()->route('role.index');
    }

    public function role_destroy($id)
    {
        $role=Role::find($id);
        $role->permissions()->delete();
        $role->delete();
        session()->flash('success', 'role Deleted !');
        return redirect()->back();
    }
    //permission
    public function permission_index()
    {
        $permissions=Permission::all();
        return view('Permission.index',compact('permissions'));
    }
 
    public function permission_create()
    {
        return view('Permission.create');
    }
    public function permission_store(Request $request)
    {
        $permission= new Permission;
        $permission->name=$request->name;
        $permission->display_name=$request->display_name;
        $permission->description=$request->description;
        $permission->save();
        return redirect()->route('permission.index');
    }

    public function permission_edit($id)
    {
       $permission=Permission::find($id);
       return view('permission.edit')->withPermission($permission);
    }
    public function permission_update(Request $request,$id)
    {
       $permission=Permission::find($id);
       $permission->name=$request->name;
       $permission->display_name=$request->display_name;

       $permission->description=$request->description;
       $permission->save();
       return redirect()->route('permission.index');
    }

    public function permission_destroy($id)
    {
        $permission=Permission::find($id);
        session()->flash('success', 'permission Deleted !');
        $permission->delete();
        return redirect()->back();
    }

    //user role

    public function user_role_index()
    {
        $users=User::all();
        return view('UserRole.index',compact('users'));
    }
 

    public function user_role_edit($id)
    {
        $roles=Role::all();
       $user=User::find($id);
     
       return view('UserRole.edit',compact('user','roles'));
       //->withRoles($roles)
       //->withUser($user);
    }
    public function user_role_update(Request $request,$id)
    {
       $user=User::find($id);

       $user->roles()->sync($request->roles);
       $user->save();
       return redirect()->route('user.role.index');
    }

 

}