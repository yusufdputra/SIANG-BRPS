<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Kendaraan;
use App\Po;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KendaraanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $idUser = Auth::user()->id;

        // get kendaraan berdasarkan user 
        $kendaraans = Kendaraan::select('kendaraans.*')
        ->join('pos', 'pos.id' , '=', 'kendaraans.po_id')
        ->join('users', 'users.id' , '=', 'pos.user_id')
        ->where('pos.user_id', $idUser)
        ->get();
        $buses = Bus::all();
        $pos = Po::where('user_id', $idUser)->first();
        return view('Kendaraan.index', compact('kendaraans', 'buses', 'pos'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'plat_nomor' => 'required',
            'bus_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        // cek plat nomor sudah terdaftar atau belum
        if (Kendaraan::where('plat_nomor', strtoupper($request->input('plat_nomor')))->exists()) {
            Alert::warning('Alert', 'Plat Nomor Sudah Terdaftar');

            return redirect()->back();
        } else {
            $kendaraans = new Kendaraan();
            $kendaraans->plat_nomor = strtoupper($request->input('plat_nomor'));
            $kendaraans->bus_id = $request->input('bus_id');
            $kendaraans->po_id = $request->input('po_id');
            $kendaraans->save();

            Alert::success('Succes', 'Data Berhasil Ditambahkan');

            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $kendaraans = Kendaraan::where('id', $id)->first();
        $buses = Bus::get();

        return view('Kendaraan.edit', compact('kendaraans', 'buses'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $this->validate(request(), [
            'plat_nomor' => 'required',
            'bus_id' => 'required',

        ]);

        $kendaraan->plat_nomor = strtoupper(request('plat_nomor'));
        $kendaraan->bus_id = request('bus_id');
        $kendaraan->save();

        Alert::success('Succes', 'Data Berhasil Diupdate');
        return redirect()->route('kendaraan.index');
    }

    public function destroy($id)
    {
        $item = Kendaraan::findOrFail($id);
        $item->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();
    }
}
