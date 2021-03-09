@extends('layouts.master')
@section('content')
<title>Kategori</title>


<div class="card" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3>DATA USER</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                @role('Admin')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Tambah Data
                </button>
                @endrole
            </div>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;?>
                @foreach($users as $user)
                <?php $no++ ;?>
                <tr>
                    <td>{{$no}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ print_r($user->getRoleNames()[0], 1) }}</td>
                    {{-- <td class="text-center"> --}}
                        {{-- <a href="{{route('user.edit', $user->id)}}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                        </a> --}}
                        {{-- <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger mt-1 mb-1 mr-1 ml-1"
                            data-placement="bottom" title="Delete" data-container="body" data-toggle="tooltip"><i
                                class="fas fa-trash-alt"></i>
                        </a> --}}
                    {{-- </td> --}}
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
                <h4 class="modal-title">Tambah Akun PO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Sebagai</label>
                            <select id="inputState" class="form-control" name="permission">
                                <option selected disabled>Choose..</option>
                            
                                <option value="po">Perusahaan</option>
                                <option value="pl">Pelaksana</option>
                            
    
                            </select>
                      
                    </div>

                    <div class="form-group">
                        <label for="">Nama</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>



                    <div class="form-group">
                        <label for="">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"> {{ __('Register') }}</button>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>