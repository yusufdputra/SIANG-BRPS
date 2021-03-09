<?php

namespace App\Http\Controllers;

use App\Kendaraan;
use App\OpKeberangkatan;
use App\OpKedatangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OperasionalKeberangkatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $idUser = Auth::user()->id;

        // inisialisasi jenis operasional
        $jenis = 'Keberangkatan';

        // get data operasional keberangkatan by User
        $operasionals = OpKeberangkatan::select('op_keberangkatans.*')
            ->join('kendaraans', 'kendaraans.id', '=', 'op_keberangkatans.id_kendaraan')
            ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
            ->where('pos.user_id', $idUser)
            ->orderBy('tanggal')->get();

        // get data kendaraan by User
        $kendaraans = Kendaraan::select('kendaraans.*')
            ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
            ->where('pos.user_id', $idUser)
            ->get();

        return view('Operasional.index', compact('operasionals', 'jenis', 'kendaraans'));
    }

    public function store(Request $request)
    {
        $plat_nomor =  $request->input('plat_nomor');
        $tanggal =  $request->input('tanggal');

        $validator = Validator::make($request->all(), [
            'plat_nomor' => 'required',
            'tanggal' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        // cek apakah id kendaraan sudah ada atau belum
        $query = OpKeberangkatan::where('id_kendaraan', $plat_nomor)
            ->where('tanggal', $tanggal);
        if ($query->exists()) { //jika ada

            Alert::warning('Warning', 'Kendaraan sudah ada di waktu yang sama ');
            return redirect()->back();
        } else { // jika belum 

            $operasionals = new OpKeberangkatan();
            $operasionals->id_kendaraan = $plat_nomor;
            $operasionals->tanggal = $tanggal;
            $operasionals->status = 'N';
            $operasionals->save();

            Alert::success('Succes', 'Data Berhasil Ditambahkan');

            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $idUser = Auth::user()->id;

        $jenis = 'Keberangkatan';
        $operasionals = OpKeberangkatan::findOrFail($id);

        $kendaraans = Kendaraan::select('kendaraans.*')
            ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
            ->where('pos.user_id', $idUser)
            ->get();

        return view('Operasional.edit', compact('operasionals', 'kendaraans'));
    }

    public function update(Request $request, OpKeberangkatan $operasional)
    {

        $plat_nomor =  $request->input('id_kendaraan');
        $tanggal =  $request->input('tanggal');

        $this->validate(request(), [
            'id_kendaraan' => 'required',
            'tanggal' => 'required',

        ]);

        // cek apakah id kendaraan sudah ada atau belum
        $query = OpKeberangkatan::where('id_kendaraan', $plat_nomor)
            ->where('tanggal', $tanggal);
        if ($query->exists()) { //jika ada

            Alert::warning('Warning', 'Kendaraan sudah ada di waktu yang sama ');
            return redirect()->back();
        } else { // jika belum 
            $operasional->id_kendaraan = $plat_nomor;
            $operasional->tanggal = $tanggal;
            $operasional->save();


            Alert::success('Succes', 'Data Berhasil Ditambahkan');

            return redirect()->route('operasional.keberangkatan');
        }
    }

    public function destroy($id)
    {
        $item = OpKeberangkatan::findOrFail($id);
        $item->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();
    }
}
