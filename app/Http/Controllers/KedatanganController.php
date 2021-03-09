<?php

namespace App\Http\Controllers;

use App\{User,Bus,Provinsi,Po,Keberangkatan,Kedatangan, Kendaraan, Terminal};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Alert;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class KedatanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $buses = Bus::all();
        $pos = Po::all();
        $kedatangans = Kedatangan::select('kedatangans.*', 'kendaraans.plat_nomor', 'buses.nama_kategori', 'pos.nama_po')
            ->join('kendaraans', 'kendaraans.id', '=', 'kedatangans.id_kendaraan')
            ->join('buses', 'buses.id', '=', 'kendaraans.bus_id')
            ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
            ->orderBy('tanggal', 'DESC')
            ->orderBy('jam')
            ->latest()->get();
        $kendaraans = Kendaraan::orderBy('po_id')->get();

        return view('Kedatangan.index', compact('buses', 'pos', 'kedatangans', 'kendaraans'));
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


        $kedatangans = new Kedatangan();
        $kedatangans->jam = $request->input('jam');
        $kedatangans->tanggal = $request->input('tanggal');
        $kedatangans->id_kendaraan = $request->input('plat_nomor');
        $kedatangans->tujuan = $request->input('tujuan');
        $kedatangans->penumpang = $request->input('penumpang');
        $kedatangans->save();


        Alert::success('Succes', 'Data Berhasil Ditambahkan');

        return redirect()->back();
    }


    public function edit($id)
    {
        // $barang2 = DB::table('barangs')->where('id_barang', $id)->first();
        // where('slug', $slug)->firstOrFail()
        $kedatangans2 = Kedatangan::where('id', $id)->first();
        $kedatangans = Kedatangan::firstOrFail();
        $kendaraans = Kendaraan::orderBy('po_id')->get();
        


        // dd($kategori);
        return view('Kedatangan.edit', compact('kedatangans', 'kedatangans2', 'kendaraans'));
    }


    public function update(Request $request, Kedatangan $kedatangan)
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

        $kedatangan->jam = request('jam');
        $kedatangan->tanggal = request('tanggal');
        $kedatangan->id_kendaraan = request('plat_nomor');
        $kedatangan->tujuan = request('tujuan');
        $kedatangan->penumpang = request('penumpang');
        $kedatangan->save();


        Alert::success('Succes', 'Data Berhasil Diupdate');
        return redirect()->route('kedatangan.index');
    }

    public function destroy($id)
    {
        $item = Kedatangan::findOrFail($id);
        $item->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();



    }

}
