@extends('layouts.master')
@section('content')
@php
   
@endphp
<title>Edit : {{$kendaraans->plat_nomor}}</title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit : {{$kendaraans->plat_nomor}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('kendaraan.index')}}">BUS</a></li>
                    <li class="breadcrumb-item active">{{$kendaraans->plat_nomor}}</li>
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
                    <form method="POST"  action="{{route('kendaraan.update', $kendaraans->id)}}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_kategori">Plat Nomor</label>
                                <input type="text" name="plat_nomor" required class="form-control" id="plat_nomor"
                                    value="{{$kendaraans->plat_nomor}}">
                                @error('nama_kategori')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="bus_id">Jenis Bus</label>
                                <select name="bus_id" id="" class="form-control" required>
                                    @foreach ($buses as $k)
                                    @if ($kendaraans->bus_id==$k->id)
                                    <option value="{{$k->id}}" selected>{{$k->nama_kategori}}</option>
                                    @else
                                    <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
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
