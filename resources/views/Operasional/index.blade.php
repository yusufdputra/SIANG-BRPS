@extends('layouts.master')
@section('content')
<title>OPERASIONAL {{strtoupper($jenis)}}</title>


<div class="card" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3>DATA OPERASIONAL {{strtoupper($jenis)}}</h3>
            </div>
            @if ( strtoupper($jenis) == 'KEBERANGKATAN')
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                        Tambah Data
                    </button>
                </div>
            @else
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default2">
                    Tambah Data
                </button>
            </div>
            @endif
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Tanggal</th>
                    @if ( strtoupper($jenis) == 'KEBERANGKATAN')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0;?>
                @foreach($operasionals as $operasional)
                <?php $no++ ;?>
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$operasional->kendaraans->plat_nomor}}</td>
                    <td>{{ date("d F Y", strtotime($operasional->tanggal))}}</td>
                    @if ( strtoupper($jenis) == 'KEBERANGKATAN')
                    <td>
                        @if (($operasional->status == 'N'))
                             
                         
                            <div class="row justify-content-center">
                                <a href="{{route('operasional.edit', $operasional->id)}}" class="btn btn-info mt-1 mb-1 mr-1 ml-1"><i
                                        class="fas fa-edit"></i></a>

                                <a href="{{ route('operasional.delete', $operasional->id) }}" class="btn btn-danger mt-1 mb-1 mr-1 ml-1"
                                    data-placement="bottom" title="Delete" data-container="body" data-toggle="tooltip"><i
                                        class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        @else
                        <p class="text-center">Sudah di Approve</p>
                         @endif 

                            
                        </td>
                        @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>





@endsection


{{-- modal jika jenis operasional KEBERANGKATAN --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Operasional Keberangkatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('operasional.store')}}" method="post">
                    @csrf
                   
                    <input type="hidden" name="po_id" value="{{ $pos->id }}">

                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                             required>
                    </div>

                    <div class="form-group">
                        <label for="">Plat Nomor </label>
                        <select name="plat_nomor" id="plat_nomor" class="form-control select2" required>
                            <option value="" selected disabled>Pilih Salah Satu</option>
                            @foreach ($kendaraans as $k)
                            <option value="{{$k->id}}">{{$k->plat_nomor}} - {{ Auth::user()->name }}</option>
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

{{-- modal jika jenis operasional KEDATANGAN --}}
<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Operasional Kedatangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('operasional.approve')}}" method="post">
                    @csrf
                   
                    
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                             required>
                    </div>

                    <div class="form-group">
                        <label for="">Plat Nomor (plat terdaftar dalam keberangkatan) </label>
                        <select name="plat_nomor" id="plat_nomor" class="form-control select2" required>
                            <option value="" selected disabled>Pilih Salah Satu</option>
                            @foreach ($operasionals2 as $k)
                            <option value="{{$k->id_kendaraan}}| {{$k->id}}">{{$k->kendaraans->plat_nomor}} - {{$k->nama_po}}
                                
                            
                            </option>
                           
                          
                            
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
