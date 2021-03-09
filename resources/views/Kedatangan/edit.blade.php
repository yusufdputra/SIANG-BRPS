@extends('layouts.master')
@section('content')
<title>Edit : </title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit : </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('kedatangan.index')}}">KEDATANGAN</a></li>
                    <li class="breadcrumb-item active"></li>
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
                    <form method="POST"  action="{{route('kedatangan.update', $kedatangans2->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="plat_nomor">Plat Nomor</label>
                                <select name="plat_nomor" id="" class="form-control select2" required>
                                    @foreach ($kendaraans as $k)
                                    @if ($kedatangans2->id_kendaraan == $k->id)
                                    <option value="{{$k->id}}" selected>{{$k->plat_nomor}} - {{$k->po->nama_po}}</option>
                                    @else
                                    <option value="{{$k->id}}">{{$k->plat_nomor}} - {{$k->po->nama_po}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jam">Jam</label>
                                <input type="time" name="jam" class="form-control" id="jam"
                                    value="{{$kedatangans2->jam}}">
                                @error('jam')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal"
                                    value="{{$kedatangans2->tanggal}}">
                                @error('tanggal')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                           
                            <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <input type="text" name="tujuan" class="form-control" id="tujuan"
                                    value="{{$kedatangans2->tujuan}}">
                                @error('tujuan')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="penumpang">Jumlah Penumpang</label>
                                <input type="number" name="penumpang" class="form-control" id="penumpang"
                                    value="{{$kedatangans2->penumpang}}">
                                @error('penumpang')
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
