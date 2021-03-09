@extends('layouts.master')
@section('content')
<title>Edit : {{$provinsi->nama_provinsi}}</title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit : {{$provinsi->nama_provinsi}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('provinsi.index')}}">PROVINSI</a></li>
                    <li class="breadcrumb-item active">{{$provinsi->nama_provinsi}}</li>
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
                    <form method="POST"  action="{{route('provinsi.update', $provinsi->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            {{-- kode barang --}}
                            <div class="form-group">
                                <label for="nama_provinsi">Nama Provinsi</label>
                                <input type="text" name="nama_provinsi" class="form-control" id="nama_provinsi"
                                    value="{{$provinsi->nama_provinsi}}">
                                @error('nama_provinsi')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
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
