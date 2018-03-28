@extends('layouts.app')
@section('page-title')  Profile @endsection

@section('title')   Profile  @endsection

@section('activeProfile') active-sub active @endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Profile</a></li>
        <li class="active">User Profile Management</li>
    </ol>
@endsection
@section('content')
        <div id="page-content">
            <div class="panel">
                <div class="panel-body">
                    <div class="fixed-fluid">
                        <div class="fixed-md-200 pull-sm-left fixed-right-border">

                            <!-- Simple profile -->
                            <div class="text-center">
                                <div class="pad-ver">
                                    @if(!empty($userInfo->profile_photo) && !is_null($userInfo->profile_photo))
                                        <img src="{{asset($userInfo->profile_photo)}}" id="user_image" class="img-lg img-circle" alt="Profile Picture">
                                    @else
                                        <img src="{{asset('img/male.png')}}" id="user_image" class="img-lg img-circle" alt="Profile Picture">
                                    @endif
                                </div>
                                <h4 class="text-lg text-overflow mar-no customer_full_name">{{$userInfo->first_name}} {{$userInfo->middle_name}} {{$userInfo->last_name}}</h4>
                                <p class="text-sm text-muted">{{$userInfo->email}}</p>
                                <p class="text-sm">
                                    @foreach(auth()->user()->roles as $i => $role)
                                        {{$role->display_name}}
                                    @endforeach
                                </p>
                            </div>
                            <hr/>
                        </div>
                        <div class="fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3><strong> Manage Your Information</strong></h3>
                                </div>
                                <div class="col-md-12">
                                    <form method="post" action="{{route('update-profile')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="customer_first_name" required class="form-control" value="{{$userInfo->first_name}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" name="customer_middle_name" required class="form-control" value="{{$userInfo->middle_name}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="customer_last_name" required class="form-control" value="{{$userInfo->last_name}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" name="customer_phone_number" required class="form-control" value="{{$userInfo->phone}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="customer_email" required disabled class="form-control" value="{{$userInfo->email}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control" name="customer_address" required placeholder="Enter your address to help use serve you better">{{$userInfo->address}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary pull-left" type="button" id="update_customer_information">Update Customer Information</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3><strong> Edit Your Profile Image</strong></h3>
                                </div>
                                <div class="col-md-12">
                                    <form method="post" id="profile_image_form" enctype="multipart/form-data" action="{{route('update-profile-image')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Enter New Image</label>
                                                    <input class="form-control" type="file" id="customer_profile_photo" name="customer_profile_photo" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button class="btn btn-primary btn-block" name="profile_upload" id="update_image" type="button">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3><strong> Change Password</strong></h3>
                                </div>
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Enter New Password</label>
                                                    <input class="form-control" type="password" name="customer_new_password" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Confirm New Password</label>
                                                    <input class="form-control" type="password" name="customer_new_password_confirm" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button class="btn btn-primary btn-block" type="button" id="update_password">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection

@section('javascript')
<script src="{{asset('js/pages/profile.js')}}"></script>
@endsection
