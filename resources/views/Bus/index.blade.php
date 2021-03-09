@extends('layouts.master')
@section('content')
<title>BUS</title>


<div class="card" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <h3>DATA JENIS BUS</h3>
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
                    <th>Jenis Bus</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;?>
                @foreach($buses as $bus)
                <?php $no++ ;?>
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$bus->nama_kategori}}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{route('bus.edit', $bus->id)}}" class="btn btn-info mt-1 mb-1 mr-1 ml-1"><i class="fas fa-edit"></i></a>

                            <a href="{{ route('bus.delete', $bus->id) }}" class="btn btn-danger mt-1 mb-1 mr-1 ml-1" data-placement="bottom" title="Delete" data-container="body" data-toggle="tooltip"><i class="fas fa-trash-alt"></i>
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
                <h4 class="modal-title">Tambah Data Jenis Bus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('bus.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Bus</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                            placeholder="Masukkan Nama Kategori" required>
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
