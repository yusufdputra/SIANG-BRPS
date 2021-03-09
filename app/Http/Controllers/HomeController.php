<?php

namespace App\Http\Controllers;

use App\Bus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user =  Auth::user();
        $role = $user->getRoleNames();
        if ($role[0] == null) {
            $user->assignRole('User');
        }
        $buses = Bus::all();

        return view('home', compact('buses'));
    }


    public function setting()
    {
        $users = User::all();
        $roles = Auth::user()->getRoleNames();
        $buses = Bus::all();
        return view('User.index', compact('users','roles', 'buses'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        $roles_name = $user->getRoleNames();
        $permission_name = $user->permissions;

        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $role = Role::findById($data['role']);

            if ($roles_name == true) {
                $user->removeRole($roles_name[0]);
                $user->revokePermissionTo($permission_name);
            }
            // dd($role);

            if (count($data['permission'] > 0)) {
                foreach ($data['permission'] as $key => $value) {
                    $user->givePermissionTo($data['permission'][$key]);
                    $user->assignRole($role);
                    $role->givePermissionTo($data['permission'][$key]);
                }
            }
            return redirect()->route('user.data')->with('status','User berhasil diupdate');
        }
        return view('User.edit', compact('user','roles','permissions'));
    }
}
