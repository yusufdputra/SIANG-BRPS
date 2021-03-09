@extends('layouts.master')
@section('content')
<title>Edit : {{$po->nama_po}}</title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit : {{$po->nama_po}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('po.index')}}">PO</a></li>
                    <li class="breadcrumb-item active">{{$po->nama_po}}</li>
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
                    <form method="POST"  action="{{route('po.update', $po->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            {{-- kode barang --}}
                            <div class="form-group">
                                <label for="nama_po">Nama Po</label>
                                <input type="text" name="nama_po" class="form-control" id="nama_po"
                                    value="{{$po->nama_po}}">
                                @error('nama_po')
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
