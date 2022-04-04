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
            <form action="{{route('adminUpdateUser', ['id' => $account->id])}}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="box-content-bottom">
                    <div class="box-content-left">
                        <input type="hidden" name="id" value="{{$account->personal_info->id}}">
                        <div class="content-user">
                            <span>First name</span>
                            <input type="text" name="first_name" value="{{ old('first_name') ?? $account->personal_info->first_name }}">
                        </div>
                        @error('first_name')
                            <p>{{$message}}</p>
                        @enderror
                        <div class="content-user">
                            <span>Last name</span>
                            <input type="text" name="last_name" value="{{old('last_name') ?? $account->personal_info->last_name }}">
                        </div>
                        @error('last_name')
                        <p>{{$message}}</p>
                        @enderror
                        <div class="box-title">
                            <div class="title-user">
                                <div class="title-left">
                                    <span>Date of birth</span>
                                    <input type="date" name="dob" value="{{old('dob') ?? $account->personal_info->dob}}">
                                </div>
                                @error('dob')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>
                            <div class="title-user">
                                <div class="title-right">
                                    <span>Department</span>
                                    <input type="text" name="department" value="{{old('department') ?? $account->personal_info->department}}">
                                </div>
                                @error('department')
                                <p>{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="box-title">
                            <div class="title-user">
                                <div class="title-left">
                                    <span>Phone</span>
                                    <input type="number" name="phone_number" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" value="{{old('phone_number') ?? $account->personal_info->phone_number}}"/>
                                </div>
                                @error('phone_number')
                                <p>{{$message}}</p>
                                @enderror
                            </div>
                            <div class="title-user">
                                <div class="title-right">
                                    <span>Email</span>
                                    <input type="text" name="email" value="{{old('email') ?? $account->personal_info->email}}">
                                </div>
                                @error('email')
                                <p>{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="content-user">
                            <span>Adress</span>
                            <input type="text" name="address" value="{{old('address') ?? $account->personal_info->address}}">
                        </div>
                        @error('address')
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
