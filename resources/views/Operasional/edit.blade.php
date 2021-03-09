@extends('layouts.master')
@section('content')
@php
   
@endphp
<title>Edit : {{$operasionals->kendaraans->plat_nomor}}</title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit : {{$operasionals->kendaraans->plat_nomor}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('operasional.keberangkatan')}}">Operasional</a></li>
                    <li class="breadcrumb-item active">{{$operasionals->kendaraans->plat_nomor}}</li>
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
                    <form method="POST"  action="{{route('operasional.update', $operasionals->id)}}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_kategori">Tanggal</label>
                                <input type="date" name="tanggal" required class="form-control" id="plat_nomor"
                                    value="{{$operasionals->tanggal}}">
                                @error('nama_kategori')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="id_kendaraan">Jenis Bus</label>
                                <select name="id_kendaraan" id="" class="form-control select2" required>
                                    @foreach ($kendaraans as $k)
                                   
                                    <option value="{{$k->id}}">{{$k->plat_nomor}} - {{ Auth::user()->name }}</option>
                                   
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
