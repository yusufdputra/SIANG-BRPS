@extends('layouts.master')
@section('content')
<title>Edit : {{$terminal->nama_terminal}}</title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit : {{$terminal->nama_terminal}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('provinsi.index')}}">TERMINAL</a></li>
                    <li class="breadcrumb-item active">{{$terminal->nama_terminal}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="container" style="margin-top: 20px;">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST"  action="{{route('terminal.update', $terminal->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            {{-- kode barang --}}
                            <div class="form-group">
                                <label for="nama_terminal">Nama Terminal</label>
                                <input type="text" name="nama_terminal" class="form-control" id="nama_terminal"
                                    value="{{$terminal->nama_terminal}}">
                                @error('nama_terminal')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="provinsi_id">Jenis Aset</label>
                                <select name="provinsi_id" id="" class="form-control" required>
                                    @foreach ($provinsi as $k)
                                    @if ($terminal2->provinsi_id==$k->id)
                                    <option value="{{$k->id}}" selected>{{$k->nama_provinsi}}</option>
                                    @else
                                    <option value="{{$k->id}}">{{$k->nama_provinsi}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>






                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
