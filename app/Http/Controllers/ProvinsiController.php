<?php

namespace App\Http\Controllers;

use App\{User,Bus,Provinsi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProvinsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $buses = Bus::all();
        $provinsis = Provinsi::all();
        return view('Provinsi.index', compact('buses','provinsis'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validate(request(), [
        //     'nama_kategori'        => 'required',
        //     ]);
            $validator = Validator::make($request->all(), [
                'nama_provinsi' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }


            $provinsis = new Provinsi;
            $provinsis->nama_provinsi = $request->input('nama_provinsi');
            $provinsis->slug = Str::slug($request->nama_provinsi);
            $provinsis->save();

            // if ($validator->fails()) {
            //     return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            // }


            Alert::success('Succes', 'Data Berhasil Ditambahkan');

            return redirect()->back();

    }


    public function edit($id)
    {
        $provinsi = Provinsi::findOrFail($id);

        return view('Provinsi.edit',[
            'provinsi' => $provinsi,

        ]);

    }

    public function update(Request $request, Provinsi $provinsi)
    {
        // dd($request->all());
        $this->validate(request(), [
            'nama_provinsi'        => 'required',
        ]);
        // dd($request->all());

        $provinsi->nama_provinsi = request('nama_provinsi');
        $provinsi->slug = request('nama_provinsi');
        $provinsi->save();


        Alert::success('Succes', 'Data Berhasil Diupdate');
        return redirect()->route('provinsi.index');
    }



    public function destroy($id)
    {
        $item = Provinsi::findOrFail($id);
        $item->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();
    }
}
