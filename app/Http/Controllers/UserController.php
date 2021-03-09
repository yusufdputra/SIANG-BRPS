<?php

namespace App\Http\Controllers;

use App\Po;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        // simpan data user
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'permission' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

       

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        
        if ( $request->input('permission') == 'po') {
            // set roles nya 2 (sebagai user)
            $user->roles()->attach(2);
              // simpan data PO
            $pos = new Po;
            $pos->nama_po = $request->input('name');
            $pos->slug = Str::slug($request->input('name'));
            $pos->user_id = $user->id;
            $pos->save();
        }else{
            $user->roles()->attach(9);
        }
       

        Alert::success('Succes', 'Data Berhasil Ditambahkan');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        $item2 = Po::where('user_id', $id);
        $item2->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();
    }
}
