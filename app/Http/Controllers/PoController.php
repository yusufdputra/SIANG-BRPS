<?php

namespace App\Http\Controllers;

use App\{User,Bus,Provinsi,Po};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $buses = Bus::all();
        $pos = Po::all();
        return view('Po.index', compact('buses','pos'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validate(request(), [
        //     'nama_kategori'        => 'required',
        //     ]);
            $validator = Validator::make($request->all(), [
                'nama_po' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }


            $pos = new Po;
            $pos->nama_po = $request->input('nama_po');
            $pos->slug = Str::slug($request->nama_po);
            $pos->save();

            // if ($validator->fails()) {
            //     return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            // }


            Alert::success('Succes', 'Data Berhasil Ditambahkan');

            return redirect()->back();

    }


    public function edit($id)
    {
        $po = Po::findOrFail($id);

        return view('Po.edit',[
            'po' => $po,

        ]);

    }

    public function update(Request $request, Po $po)
    {
        // dd($request->all());
        $this->validate(request(), [
            'nama_po'        => 'required',
        ]);
        // dd($request->all());

        $po->nama_po = request('nama_po');
        $po->slug = request('nama_po');
        $po->save();


        Alert::success('Succes', 'Data Berhasil Diupdate');
        return redirect()->route('po.index');
    }



    public function destroy($id)
    {
        $item = Po::findOrFail($id);
        $item->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();



    }
}
