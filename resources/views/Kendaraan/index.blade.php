@extends('layouts.master')
@section('content')
<title>KENDARARAAN</title>


<div class="card" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <h3>DATA KENDARARAAN</h3>
            </div>
            <div class="col-md-9 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Tambah Data
                </button>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Jenis Bus</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0;?>
                @foreach($kendaraans as $kendaraan)
                <?php $no++ ;?>
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$kendaraan->plat_nomor}}</td>
                    <td>{{$kendaraan->bus->nama_kategori}}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{route('kendaraan.edit', $kendaraan->id)}}" class="btn btn-info mt-1 mb-1 mr-1 ml-1"><i class="fas fa-edit"></i></a>

                            <a href="{{ route('kendaraan.delete', $kendaraan->id) }}" class="btn btn-danger mt-1 mb-1 mr-1 ml-1" data-placement="bottom" title="Delete" data-container="body" data-toggle="tooltip"><i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>





@endsection

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data kendaraan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('kendaraan.store')}}" method="post">
                    @csrf
                   
                    <input type="hidden" name="po_id" value="{{ $pos->id }}">
                    <div class="form-group">
                        <label for="">Plat Nomor</label>
                        <input type="text" name="plat_nomor" id="plat_nomor" class="form-control"
                            placeholder="Masukkan Plat Nomor" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Bus</label>
                        <select name="bus_id" id="bus_id" class="form-control" required>
                            <option value="" selected disabled>Pilih Salah Satu</option>
                            @foreach ($buses as $k)
                            <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
