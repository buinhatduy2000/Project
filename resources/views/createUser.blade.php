@extends('master')
@section('css')
    <style>
        .title-right,.title-left {
            padding: 10px 0 0px 10px;
        }
        .title-right,.title-left, .box-content-right .content-user, .box-content-bottom .box-content-left .content-user {
            margin-bottom: 1rem;
        }
    </style>
@endsection
@section('content')
    <div class="createUser-content-right">
        <div class="box">
            <div class="box-content-top">
                <span>Create New User</span>
            </div>
            <form action="{{route('adminStoreUser')}}" method="post" autocomplete="off">
                @csrf
                <div class="box-content-bottom">
                    <div class="box-content-left">
                        <div class="content-user">
                            <span>First name</span>
                            <input type="text" name="first_name" value="{{old('first_name')}}">
                        </div>
                        @error('first_name')
                            <p>{{$message}}</p>
                        @enderror
                        <div class="content-user">
                            <span>Last name</span>
                            <input type="text" name="last_name" value="{{old('last_name')}}">
                        </div>
                        @error('last_name')
                            <p>{{$message}}</p>
                        @enderror
                        <div class="box-title">
                            <div class="title-user">
                                <div class="title-left">
                                    <span>Date of birth</span>
                                    <input type="date" name="dob" value="{{old('dob')}}" max="{{date('Y-m-d')}}">
                                </div>
                                @error('dob')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>
                            <div class="title-user">
                                <div class="title-right">
                                <span>Address</span>
                                <input type="text" name="address" value="{{old('address')}}">
                                </div>
                                @error('address')
                                <p>{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="box-title">
                            <div class="title-user">
                                <div class="title-left">
                                    <span>Phone</span>
                                    <input type="number" name="phone_number" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" value="{{old('phone_number')}}"/>
                                </div>
                                @error('phone_number')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>
                            <div class="title-user">
                                <div class="title-right">
                                    <span>Email</span>
                                    <input type="text" name="email" value="{{old('email')}}">
                                </div>
                                @error('email')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="content-user" style="height: 85px; padding-right: 10px">
                            <span>Department</span>
                            <select class="form-select" name="department" id="">
                                <option value="">---Choose Department---</option>
                                <option value="IT" {{old('department') == 'IT' ? 'selected' : ''}}>IT</option>
                                <option value="Marketing" {{old('department') == 'Marketing' ? 'selected' : ''}}>Marketing</option>
                                <option value="Management" {{old('department') == 'Management' ? 'selected' : ''}}>Management</option>
                                <option value="Education" {{old('department') == 'Education' ? 'selected' : ''}}>Education</option>
                            </select>
                        </div>
                        @error('department')
                        <p>{{$message}}</p>
                        @enderror

                    </div>
                    <div class="box-content-right">
                        <div class="content-user">
                            <span>User name</span>
                            <input type="text" name="user_name" autocomplete="off" value="{{old('user_name')}}">
                        </div>
                        @error('user_name')
                            <p>{{$message}}</p>
                        @enderror
                        <div class="content-user">
                            <span>Password</span>
                            <input type="password" name="password" autocomplete="off">
                        </div>
                        @error('password')
                            <p>{{$message}}</p>
                        @enderror
                        <div class="content-user">
                            <span>Confirm Password</span>
                            <input type="password" name="password_confirmation">
                        </div>
                        @error('password_confirmation')
                            <p>{{$message}}</p>
                        @enderror
                        <div class="content-user" style="height: 85px; padding-right: 10px">
                            <span>Role</span>
                            <select class="form-select" name="role" id="">
                                <option value="">---Choose Role---</option>
                                <option value="staff" {{old('role') == 'staff' ? 'selected' : ''}}>Staff</option>
                                <option value="QAC" {{old('role') == 'QAC' ? 'selected' : ''}}>QAC</option>
                                <option value="QAM" {{old('role') == 'QAM' ? 'selected' : ''}}>QAM</option>
                            </select>
                        </div>
                        @error('role')
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="btn">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
