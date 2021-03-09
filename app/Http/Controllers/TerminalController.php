<?php

namespace App\Http\Controllers;

use App\{User,Bus,Provinsi,Terminal};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

class TerminalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $provinsis = Provinsi::all();
        $terminals = Terminal::all();
        $buses = Bus::all();

        return view('Terminal.index', compact('buses','provinsis','terminals'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validate(request(), [
        //     'nama_kategori'        => 'required',
        //     ]);
            $validator = Validator::make($request->all(), [
                'nama_terminal' => 'required',
                'provinsi_id' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }


            $terminals = new Terminal;
            $terminals->nama_terminal = $request->input('nama_terminal');
            $terminals->slug = Str::slug($request->nama_terminal);
            $terminals->provinsi_id = $request->input('provinsi_id');
            $terminals->save();

            // if ($validator->fails()) {
            //     return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            // }


            Alert::success('Succes', 'Data Berhasil Ditambahkan');

            return redirect()->back();

    }

    public function edit($id)
    {
        // $barang2 = DB::table('barangs')->where('id_barang', $id)->first();
        // where('slug', $slug)->firstOrFail()
        $terminal2 = Terminal::where('id', $id)->first();
        $terminal = Terminal::firstOrFail();
        $provinsi = Provinsi::get();

        // dd($kategori);
        return view('Terminal.edit', compact('terminal2','terminal','provinsi'));

    }

    public function update(Request $request, Terminal $terminal)
    {
        // dd($request->all());
        $this->validate(request(), [
            'nama_terminal'        => 'required',
            'provinsi_id' => 'required',

        ]);
        // dd($request->all());

        $terminal->nama_terminal = request('nama_terminal');
        $terminal->slug = request('nama_terminal');
        $terminal->provinsi_id = request('provinsi_id');
        $terminal->save();


        Alert::success('Succes', 'Data Berhasil Diupdate');
        return redirect()->route('terminal.index');
    }

    public function destroy($id)
    {
        $item = Terminal::findOrFail($id);
        $item->delete();

        Alert::warning('Succes', 'Data Berhasil Dihapus');
        return back();



    }
}
