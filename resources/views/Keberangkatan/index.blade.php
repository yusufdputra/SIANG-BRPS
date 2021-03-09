@extends('layouts.master')
@section('content')
<title>KEBERANGKATAN</title>


<div class="card" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3>DATA KEBERANGKATAN</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                @role('Admin|Pelaksana')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Tambah Data
                </button>
                @endrole
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jam</th>
                    <th>Tanggal</th>
                    <th>PO</th>
                    <th>PLAT NO</th>
                    <th>ASAL</th>
                    <th>Tujuan</th>
                    <th>Jumlah Penumpang</th>
                    <th>Jenis Bus</th>
                    @role('Admin|Pelaksana')
                    <th>Aksi</th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                <?php
                  
                    $no = 0;?>
                @foreach($keberangkatans as $keberangkatan)
                <?php $no++ ;?>
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$keberangkatan->jam}}</td>
                    <td>{{ date("d F Y", strtotime($keberangkatan->tanggal)) }}</td>
                    <td>{{$keberangkatan->nama_po}}</td>
                    <td>{{$keberangkatan->plat_nomor}}</td>
                    <td>PEKANBARU</td>
                    <td>{{$keberangkatan->tujuan}}</td>
                    <td>{{$keberangkatan->penumpang}}</td>
                    <td>{{$keberangkatan->nama_kategori}}</td>
                    @role('Admin|Pelaksana')
                    <td>

                        <div class="row justify-content-center">
                            <a href="{{route('keberangkatan.edit', $keberangkatan->id)}}" class="btn btn-info mt-1 mb-1 mr-1 ml-1"><i
                                    class="fas fa-edit"></i></a>

                            <a href="{{ route('keberangkatan.delete', $keberangkatan->id) }}" class="btn btn-danger mt-1 mb-1 mr-1 ml-1"
                                data-placement="bottom" title="Delete" data-container="body" data-toggle="tooltip"><i
                                    class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                    @endrole
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
                <h4 class="modal-title">Tambah Keberangkatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              
                <form action="{{route('keberangkatan.store')}}" method="post">
                    @csrf

                    
                    <div class="form-group">
                        <label for="">Jam</label>
                        <input type="time" name="jam" id="jam" class="form-control"
                             required>
                    </div>

                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                             required>
                    </div>
                   

                    <div class="form-group">
                        <label for="">Plat Nomor</label>
                        <select class="form-control select2" id="plat_nomor" name="plat_nomor" >
                            <option value="" selected disabled>Pilih Salah Satu</option>
                            @foreach ($kendaraans as $k)
                            
                            <option value="{{$k->id}}">{{$k->plat_nomor}} - {{$k->po->nama_po}} </option>
                            @endforeach
                        </select>
                       
                    </div>

                  

                    <div class="form-group">
                        <label for="">Tujuan</label>
                        <input type="text" name="tujuan" id="tujuan" class="form-control"
                             required>
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah Penumpang</label>
                        <input type="number" name="penumpang" id="penumpang" class="form-control"
                             required>
                    </div>



            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
