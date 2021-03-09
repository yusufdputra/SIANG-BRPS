@extends('layouts.master')
@section('content')
<title>Edit : {{$bus->nama_kategori}}</title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit : {{$bus->nama_kategori}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('bus.index')}}">BUS</a></li>
                    <li class="breadcrumb-item active">{{$bus->nama_kategori}}</li>
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
                    <form method="POST"  action="{{route('bus.update', $bus->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            {{-- kode barang --}}
                            <div class="form-group">
                                <label for="nama_kategori">Jenis Bus</label>
                                <input type="text" name="nama_kategori" class="form-control" id="nama_kategori"
                                    value="{{$bus->nama_kategori}}">
                                @error('nama_kategori')
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
