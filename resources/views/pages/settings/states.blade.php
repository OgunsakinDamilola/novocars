@extends('layouts.app')
@section('page-title')  Destination States  @endsection

@section('title')  Destination States  @endsection

@section('activeSettings') active-sub active @endsection
@section('activeStates') active @endsection

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Settings</a></li>
        <li class="active">Destination States</li>
    </ol>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Available Destination States</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>State</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($states as $serial => $state)
                                <tr>
                                    <td>{{$serial + 1}}</td>
                                    <td>{{$state->state}}</td>
                                    <td id="status_{{$state->id}}">
                                        @if($state->status == 1)
                                            <label class="label label-success"><i class="fa fa-check"></i> Active</label>
                                        @elseif($state->status == 0)
                                            <label class="label label-danger"><i class="fa fa-times"></i> Not Active</label>
                                        @endif
                                    </td>
                                    <td>
                                        <button data-toggle="tooltip" data-original-title="Activate State" value="{{$state->id}}" class="btn btn-primary btn-sm activate"><i class="fa fa-check"></i></button>
                                        <button data-toggle="tooltip" data-original-title="deactivate State" value="{{$state->id}}" class="btn btn-danger btn-sm deactivate"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-info">
                <strong>Notice !!!</strong>
                <p>Only states activated here will be available for customer to select a destination states.</p>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{asset('js/pages/settings/states.js')}}"></script>
@endsection