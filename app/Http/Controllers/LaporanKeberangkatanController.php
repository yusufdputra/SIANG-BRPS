<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Keberangkatan;
use App\Kendaraan;
use App\OpKeberangkatan;
use Illuminate\Http\Request;

class LaporanKeberangkatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // inisialisasi jenis laporan
        $jenis = 'keberangkatan';

        $buses = Bus::all();
        return view('Laporan.index', compact('buses', 'jenis'));
    }

    public function cari(Request $request)
    {
        $buses = Bus::all();

        // get request
        $bus_id = request('bus_id');
        $tanggal = request('tanggal');
        $jenis = request('jenis');
        //pisahkan tanggal request menjadi bulan dan tahun
        $bulan = date("m",strtotime($tanggal));
        $tahun = date("Y",strtotime($tanggal));
        
      
        // get data operasional keberangkatan berdasarkan 
        // jenis bus, bulan, dan tahun, 
        // urutkan berdasarkan pemilih PO
        $laporans = OpKeberangkatan::select('op_keberangkatans.*')
            ->join('kendaraans', 'kendaraans.id', '=', 'op_keberangkatans.id_kendaraan')
            ->join('buses', 'buses.id', '=', 'kendaraans.bus_id')
            ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
            ->where('kendaraans.bus_id', $bus_id)
            ->whereMonth('op_keberangkatans.tanggal', $bulan)
            ->whereYear('op_keberangkatans.tanggal', $tahun)
            ->orderBy('pos.id')
            ->get();

        // get kendaraan berdasarkan jenis kendaraan
        // urutkan berdasarkan pemilih PO
        $kendaraans = Kendaraan::select('kendaraans.*', 'buses.nama_kategori', 'pos.nama_po')
        ->where('kendaraans.bus_id', $bus_id  )
        ->join('buses', 'buses.id', '=', 'kendaraans.bus_id')
        ->join('pos', 'pos.id', '=', 'kendaraans.po_id')
        ->orderBy('pos.id')
        ->get();

        // get jenis bus 
        $nama_kategori = Bus::where('id', $bus_id)->first();

        // get jumlah banyak hari berdasarkan bulan dan tahun yg di request
        $banyak_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        return view('Laporan.index', compact('nama_kategori','laporans', 'kendaraans', 'buses', 'jenis', 'tanggal','banyak_hari'));
    }
}
