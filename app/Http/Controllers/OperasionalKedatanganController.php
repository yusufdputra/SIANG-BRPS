<?php

namespace App\Http\Controllers;
use App\Kendaraan;
use App\OpKeberangkatan;
use App\OpKedatangan;
use App\Po;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OperasionalKedatanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
  
        $jenis = 'Kedatangan';
      
        $operasionals2 = OpKeberangkatan::select('op_keberangkatans.*', 'pos.nama_po')
        ->join('kendaraans', 'kendaraans.id', '=', 'op_keberangkatans.id_kendaraan')
        ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
        ->where('status', 'N')->orderBy('tanggal')->get();
        
        $operasionals = OpKedatangan::select('op_kedatangans.*')
        ->join('kendaraans', 'kendaraans.id', '=', 'op_kedatangans.id_kendaraan')
        ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
        ->orderBy('tanggal')->get();

        $kendaraans = Kendaraan::select('kendaraans.*')
            ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
            ->get();
        $po = Po::all();

        return view('Operasional.index', compact('po','operasionals', 'operasionals2', 'jenis', 'kendaraans'));
    }

    
    public function approve(Request $request)
    {

        // pisahkan value yg dikirim dari request dengan delimiter '|' menjadi array
        $plat_nomor = explode('|', $request->input('plat_nomor'));

        $tanggal =  $request->input('tanggal');
        $id_op_keberangkatan =  $request->input('id_op_keberangkatan');

        // simpan ke tabel kedatangan
        $page2 = new OpKedatangan();
        $page2->id_kendaraan = $plat_nomor[0];
        $page2->tanggal = $tanggal;
        $page2->save();

        
        // update status di tabel operasional keberangkatan
        $page = OpKeberangkatan::find($plat_nomor[1]);
        if($page) {
            $page->status = 'Y';
            $page->save();
        }
      
        Alert::success('Succes', 'Data Berhasil Diubah');
        return back();
    }
}
