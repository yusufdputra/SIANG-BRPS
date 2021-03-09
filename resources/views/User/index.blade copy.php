@extends('layouts.master')
@section('content')
<title>Data User</title>

<div class="container" style="padding: 30px;">
    <div class="row mb-5">
        <h1>DATA USER</h1>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama </th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)

            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ print_r($user->getRoleNames()[0], 1) }}</td>
                <td>
                    <a href="{{route('user.edit', $user->id)}}" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
