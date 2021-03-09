<?php

namespace App\Http\Controllers;

use App\{User, Bus, Provinsi, Po, Keberangkatan, Kendaraan, Terminal};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Alert;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


class KeberangkatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $buses = Bus::all();
        $pos = Po::all();

        // get data keberangkatan 
        $keberangkatans = Keberangkatan::select('keberangkatans.*', 'kendaraans.plat_nomor', 'buses.nama_kategori', 'pos.nama_po')
            ->join('kendaraans', 'kendaraans.id', '=', 'keberangkatans.id_kendaraan')
            ->join('buses', 'buses.id', '=', 'kendaraans.bus_id')
            ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
            ->orderBy('tanggal', 'DESC')
            ->orderBy('jam')
            ->latest()->get();

        $kendaraans = Kendaraan::orderBy('po_id')->get();

        return view('Keberangkatan.index', compact('buses', 'pos', 'keberangkatans', 'kendaraans'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'jam' => 'required',
            'tanggal' => 'required',
            'plat_nomor' => 'required',
            'tujuan' => 'required',
            'penumpang' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        $keberangkatans = new Keberangkatan;
        $keberangkatans->jam = $request->input('jam');
        $keberangkatans->tanggal = $request->input('tanggal');
        $keberangkatans->id_kendaraan = $request->input('plat_nomor');
        $keberangkatans->tujuan = $request->input('tujuan');
        $keberangkatans->penumpang = $request->input('penumpang');
        $keberangkatans->save();


        Alert::success('Succes', 'Data Berhasil Ditambahkan');

        return redirect()->back();
    }


    public function edit($id)
    {
        // $barang2 = DB::table('barangs')->where('id_barang', $id)->first();
        // where('slug', $slug)->firstOrFail()
        $keberangkatans2 = Keberangkatan::where('id', $id)->first();
        $keberangkatans = Keberangkatan::firstOrFail();
        $kendaraans = Kendaraan::orderBy('po_id')->get();
        
        // dd($kategori);
        return view('Keberangkatan.edit', compact('keberangkatans', 'keberangkatans2', 'kendaraans'));
    }


    public function update(Request $request, Keberangkatan $keberangkatan)
    {
        // dd($request->all());
        $this->validate(request(), [
            'jam' => 'required',
            'tanggal' => 'required',
            'plat_nomor' => 'required',
            'tujuan' => 'required',
            'penumpang' => 'required',

        ]);
        // dd($request->all());

        $keberangkatan->jam = request('jam');
        $keberangkatan->tanggal = request('tanggal');
        $keberangkatan->id_kendaraan = request('plat_nomor');
        $keberangkatan->tujuan = request('tujuan');
        $keberangkatan->penumpang = request('penumpang');
        $keberangkatan->save();


        Alert::success('Succes', 'Data Berhasil Diupdate');
        return redirect()->route('keberangkatan.index');
    }

    public function destroy($id)
    {
        $item = Keberangkatan::findOrFail($id);
        $item->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();
    }
}
