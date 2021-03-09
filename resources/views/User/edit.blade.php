@extends('layouts.master')
@section('content')
<title>Edit</title>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="{{route('user.edit', $user->id)}}" method="POST">
            @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" readonly class="form-control-plaintext" id="staticEmail"
                            value="{{ $user->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" readonly class="form-control-plaintext" id="staticEmail"
                            value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select id="inputState" class="form-control" name="role">
                            <option selected disabled>Choose..</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{ $role->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Permission</label>
                    <div class="col-sm-10">
                        <select id="inputState" multiple class="form-control" name="permission[]">
                            <option selected disabled>Choose..</option>
                            @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary w-100" value="submit">
            </form>
        </div>
    </div>
</div>

@endsection
