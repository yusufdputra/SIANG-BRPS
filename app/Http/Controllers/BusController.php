<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $buses = Bus::all();
        return view('Bus.index', compact('buses'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validate(request(), [
        //     'nama_kategori'        => 'required',
        //     ]);
            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }


            $buss = new Bus;
            $buss->nama_kategori = $request->input('nama_kategori');
            $buss->slug = Str::slug($request->nama_kategori);
            $buss->save();

            // if ($validator->fails()) {
            //     return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            // }


            Alert::success('Succes', 'Data Berhasil Ditambahkan');

            return redirect()->back();

    }


    public function edit($id)
    {
        $bus = Bus::findOrFail($id);

        return view('Bus.edit',[
            'bus' => $bus,

        ]);

    }

    public function update(Request $request, Bus $bus)
    {
        // dd($request->all());
        $this->validate(request(), [
            'nama_kategori'        => 'required',
        ]);
        // dd($request->all());

        $bus->nama_kategori = request('nama_kategori');
        $bus->slug = request('nama_kategori');
        $bus->save();


        Alert::success('Succes', 'Data Berhasil Diupdate');
        return redirect()->route('bus.index');
    }



    public function destroy($id)
    {
        $item = Bus::findOrFail($id);
        $item->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();



    }
}
