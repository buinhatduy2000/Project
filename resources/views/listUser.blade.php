@extends('master')
@section('css')
    <style>
        .admin-content-right {
            width: 100%;
        }

        .userList-btn button {
            width: 100%;
            height: 40px;
            padding: 0 30px;
        }

    </style>
@endsection
@section('content')
    <div class="admin-content-right">
        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="userList-container">
            <div class="userList-btn">
                <h2>User List:</h2>
                <a href="{{route('adminCreateUser')}}">
                    <button class="btn-newUser">New User</button>
                </a>
            </div>
            <div class="gr-table">
                <table class="table table-striped btnUser">
                    <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th class="table-hidden">Date of Birth</th>
                            <th class="table-hidden">Department</th>
                            <th class="table-hidden">Phone</th>
                            <th class="table-hidden">Email</th>
                            <th class="table-hidden">Address</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->personal_info->first_name}}</td>
                            <td>{{$user->personal_info->last_name}}</td>
                            <td class="table-hidden">{{$user->personal_info->dob}}</td>
                            <td class="table-hidden">{{ ucfirst(trans($user->role)) }}</td>
                            <td class="table-hidden">{{$user->personal_info->phone_number}}</td>
                            <td class="table-hidden">{{$user->personal_info->email}}</td>
                            <td class="table-hidden">{{$user->personal_info->address}}</td>
                            <td>
                                <a href="{{route('adminEditUser', ['id' => $user->id])}}"><button>Edit</button></a>
                                <a href="{{route('adminDeleteUser', ['id' => $user->id])}}" onclick="return confirm('Are you really want to delete this account')"><button>Delete</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
    {{-- <div class="admin-content-right">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
        <div class="userList-container">
            <div class="userList-btn">
                <h2>User List:</h2>
                <a href="{{route('adminCreateUser')}}"><button>New User</button></a>
            </div>
            <table class="table table-striped btnUser">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Date of Birth</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->personal_info->first_name}}</td>
                    <td>{{$user->personal_info->last_name}}</td>
                    <td>{{$user->personal_info->dob}}</td>
                    <td>{{ ucfirst(trans($user->role)) }}</td>
                    <td>{{$user->personal_info->phone_number}}</td>
                    <td>{{$user->personal_info->email}}</td>
                    <td>{{$user->personal_info->address}}</td>
                    <td>{{$user->personal_info->department}}</td>
                    <td>
                        <a href="{{route('adminEditUser', ['id' => $user->id])}}"><button>Edit</button></a>
                        <a href="{{route('adminDeleteUser', ['id' => $user->id])}}" onclick="return confirm('Are you really want to delete this account')"><button>Delete</button></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.custom') }}
        </div>

    </div> --}}
@endsection
