@extends('layouts.master')
@section('content')
<title>TERMINAL</title>


<div class="card" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3>DATA NAMA TERMINAL</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
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
                    <th>Nama Terminal</th>
                    <th>Provinsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;?>
                @foreach($terminals as $terminal)
                <?php $no++ ;?>
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$terminal->nama_terminal}}</td>
                    <td>{{$terminal->provinsi->nama_provinsi}}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{route('terminal.edit', $terminal->id)}}" class="btn btn-info mt-1 mb-1 mr-1 ml-1"><i class="fas fa-edit"></i></a>

                            <a href="{{ route('terminal.delete', $terminal->id) }}" class="btn btn-danger mt-1 mb-1 mr-1 ml-1" data-placement="bottom" title="Delete" data-container="body" data-toggle="tooltip"><i class="fas fa-trash-alt"></i>
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
                <h4 class="modal-title">Tambah Nama Terminal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('terminal.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Terminal</label>
                        <input type="text" name="nama_terminal" id="nama_terminal" class="form-control"
                            placeholder="Masukkan Nama Terminal" required>
                    </div>

                    <div class="form-group">
                        <label for="">Provinsi</label>
                        <select name="provinsi_id" id="provinsi_id" class="form-control" required>
                            <option value="" selected disabled>Pilih Provinsi</option>
                            @foreach ($provinsis as $k)
                            <option value="{{$k->id}}">{{$k->nama_provinsi}}</option>
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
