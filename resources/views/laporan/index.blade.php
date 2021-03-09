@extends('layouts.master')
@section('content')
<title>LAPORAN  {{strtoupper($jenis)}}</title>


<div class="card" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3>LAPORAN DATA {{strtoupper($jenis)}} {{$nama_kategori->nama_kategori}}
                    @if ($tanggal != null)
                        {{ date('F-Y', strtotime($tanggal))}}
                    @endif
                </h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                @role('Admin|Pelaksana')
                <form action="{{route($jenis.'.cari')}}" method="post">
                    @csrf
                   <input type="hidden" value="{{$jenis}}" name="jenis">
                    <div class="input-group mb-3">
                        <select name="bus_id" id="" class="form-control" required>
                            @foreach ($buses as $k)
                            <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                           
                            @endforeach
                        </select>
                        <input type="month" name="tanggal"  required class="form-control" aria-describedby="button-addon2">
                        <button type="submit" class="btn btn-primary" type="button" id="button-addon2">Cari</button>
                    </div>
                </form>
                @endrole
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div id="table2" style="overflow-x:auto;" class="card-body ">
        <table id="example2"  class="table table-bordered table-striped">
            <thead class="text-center">
              
                <tr >
                    <th rowspan="2">No.</th>
                    <th rowspan="2">PLAT NOMOR</th>
                    <th rowspan="2">NAMA PERUSAHAAN</th>
                    <th colspan="{{$banyak_hari}}">{{ date('F-Y', strtotime($tanggal))}}</th>
                    <th rowspan="2">Total</th>
                </tr>
                <tr >
                    @for ($i = 1; $i <= $banyak_hari; $i++)
                        <th>{{$i}}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>

                <?php $no = 0;?>
                @foreach($kendaraans as $kendaraan)
                <?php $no++ ;?>
                <tr>
                    <td >{{$no}}</td>
                    <td>{{$kendaraan->plat_nomor}}</td>
                    <td>{{$kendaraan->nama_po}}</td>


                    @php
                        $total = 0;
                    @endphp
                    {{-- looping jumlah hari --}}
                    @for ($i = 1; $i <= $banyak_hari; $i++)  
                    <td>
                        {{-- cek apakah data keberangkatan ada atau tidak --}}
                        @if (count($laporans) != 0)
                            {{-- kalau ada --}}
                            {{-- looping data laporan dari data operasional --}}
                            @foreach ($laporans as $laporan)
                                {{-- cek apakah id kendaraan sama atau tidak --}}
                                @if ($kendaraan->id == $laporan->id_kendaraan)
                                    {{-- get tanggal dari data laporan --}}
                                    @php
                                        $get_tgl = date("d",strtotime($laporan->tanggal));
                                    @endphp
                                    {{-- cek apakah tanggal sama atau tidak --}}
                                    @if ( ($i == $get_tgl))
                                        YES
                                        @php
                                            // tambah 1 untuk total
                                            $total += 1;
                                            // break looping
                                            break;
                                        @endphp
                                
                                    @endif
                                
                                @endif 
                            
                            @endforeach
                       
                        @endif

                    </td>   
                    @endfor

                    <td>{{$total}}</td>
                    
                    </tr>
                
                    
                
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- /.card-body -->
</div>





@endsection
