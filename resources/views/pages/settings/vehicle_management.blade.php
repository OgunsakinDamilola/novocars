@extends('layouts.app')
@section('page-title')  Vehicle Management  @endsection

@section('title')  Vehicle Management  @endsection

@section('activeSettings') active-sub active @endsection

@section('activeVehicles') active  @endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Settings</a></li>
        <li class="active">Vehicle Management</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"> Vehicle Categories </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">
                      <div class="panel panel-bordered-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"> Vehicle Category
                                  <i data-toggle="tooltip" data-original-title="Refresh table" class="fa fa-refresh btn btn-sm btn-default"></i>
                              </h3>
                          </div>
                          <div class="panel-body">
                              <div class="row">
                                  <form method="post" action="{{route('save-vehicle-category')}}">
                                      @csrf
                                      <div class="col-md-8">
                                          <input type="hidden" id="vehicle_category_id" value="" name="vehicle_category_id"/>
                                          <div class="form-group">
                                              <label>Category</label>
                                              <input type="text" class="form-control" name="vehicle_category" required id="vehicle_category"/>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label>&nbsp; <br/></label>
                                              <button class="btn btn-block btn-primary" id="save_category"> Save</button>
                                              </div>
                                          </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                         <table class="table table-bordered">
                          <thead>
                          <tr>
                              <th>#</th>
                              <th>Category</th>
                              <th>Action</th>
                          </tr>
                          </thead>
                             <tbody>
                             @foreach($vehicle_categories as $serial => $vehicle_category)
                                 <tr>
                                     <td>{{$serial + 1}}</td>
                                     <td id="name_{{$vehicle_category->id}}">{{$vehicle_category->name}}</td>
                                     <td>
                                         <button data-toggle="tooltip" value="{{$vehicle_category->id}}" data-original-title="Edit category information" class="btn btn-primary btn-sm edit_category"><i class="fa fa-edit"></i></button>
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"> Vehicle Types </h3>
            </div>
            <div class="panel-body">
              <div class="row">
                  <div class="col-md-5">
                      <div class="panel panel-bordered-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">Add Vehicle</h3>
                          </div>
                          <form method="post" action="{{route('add-new-vehicle-type')}}" enctype="multipart/form-data">
                              @csrf
                              <div class="panel-body">
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label>Select Category</label>
                                             <select class="form-control" name="vehicle_category_id" required>
                                                 <option value="">[SELECT]</option>
                                                 @foreach($vehicle_categories as $i => $vehicle_category)
                                                 <option value="{{$vehicle_category->id}}">{{$vehicle_category->name}}</option>
                                                 @endforeach
                                             </select>
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label>Vehicle Name</label>
                                             <input type="text" class="form-control" required name="vehicle_name" />
                                         </div>
                                     </div>
                                     <div class="col-md-8">
                                         <div class="form-group">
                                             <label>Vehicle Image</label>
                                             <input type="file" name="vehicle_image" class="form-control" required/>
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <label>&nbsp;</label>
                                             <button class="btn btn-primary pull-right btn-block"> Save</button>
                                         </div>
                                     </div>
                                 </div>
                              </div>
                          </form>
                      </div>
                  </div>
                  <div class="col-md-7">
                  <table class="table table-bordered">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th>Vehicle Category</th>
                          <th>Vehicle Name</th>
                          <th>Image Preview</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($vehicle_types as $serial => $vehicle_type)
                          <tr>
                              <td>{{$serial+1}}</td>
                              <td>{{\App\VehicleCategory::find($vehicle_type->category_id)->name}}</td>
                              <td>{{$vehicle_type->name}}</td>
                              <td>
                                  <img src="{{asset($vehicle_type->image_path)}}" style="width: 80px; height: 50px;"/>
                              </td>
                              <td id="type_status_{{$vehicle_type->id}}">
                                  @if($vehicle_type->status == 1)
                                      <label class="label label-success"><i class="fa fa-check"></i> Active</label>
                                  @elseif($vehicle_type->status == 0)
                                      <label class="label label-danger"> <i class="fa fa-times"></i> Not active</label>
                                  @endif
                              </td>
                              <td>
                                  <button data-toggle="tooltip" data-original-title="Activate vehicle for booking" value="{{$vehicle_type->id}}" class="btn btn-success btn-sm activate"><i class="fa fa-check"></i></button>
                                  <button data-toggle="tooltip" data-original-title="Deactivate vehicle for booking" value="{{$vehicle_type->id}}" class="btn btn-danger btn-sm deactivate"><i class="fa fa-times"></i></button>

                                  <button data-toggle="modal" data-target="#vehicle_image_preview_{{$vehicle_type->id}}"  class="btn btn-info btn-sm"><i data-toggle="tooltip" data-original-title="Preview vehicle image" class="fa fa-eye"></i></button>
                                  <div class="modal" tabindex="-1" role="dialog" id="vehicle_image_preview_{{$vehicle_type->id}}">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title"> Vehicle Image preview</h5>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="row">
                                                      <div class="col-md-12">
                                                          <img src="{{asset($vehicle_type->image_path)}}" class="img-responsive" style="width: 500px; height: 350px;"/>
                                                      </div>
                                                      <form method="post" enctype="multipart/form-data" action="{{route('edit-vehicle-image')}}">
                                                          @csrf
                                                          <input type="hidden" name="vehicle_id" value="{{$vehicle_type->id}}"/>
                                                          <div class="col-md-8">
                                                              <div class="form-group">
                                                                  <label>Change Vehicle Image</label>
                                                                  <input type="file" name="new_vehicle_image" class="form-control" />
                                                              </div>
                                                          </div>
                                                          <div class="col-md-4">
                                                              <div class="form-group">
                                                                  <label>&nbsp;</label>
                                                                  <button class="btn btn-primary btn-block"> Edit</button>
                                                              </div>
                                                          </div>
                                                      </form>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <button data-toggle="modal" data-target="#vehicle_info_edit_{{$vehicle_type->id}}"  class="btn btn-primary btn-sm"><i data-toggle="tooltip" data-original-title="Edit Vehicle Information" class="fa fa-edit"></i></button>
                                  <div class="modal" tabindex="-1" role="dialog" id="vehicle_info_edit_{{$vehicle_type->id}}">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title"> Edit Vehicle Information</h5>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="row">
                                                      <form method="post" enctype="multipart/form-data" action="{{route('edit-vehicle-information')}}">
                                                          @csrf
                                                          <input type="hidden" name="vehicle_id" value="{{$vehicle_type->id}}"/>
                                                          <div class="col-md-5">
                                                              <div class="form-group">
                                                                  <label>Vehicle Category</label>
                                                                  <select name="edit_vehicle_category" class="form-control" required>
                                                                      <option value="{{$vehicle_type->category}}">{{\App\VehicleCategory::find($vehicle_type->category_id)->name}}</option>
                                                                      @foreach($vehicle_categories as $i => $vehicle_category)
                                                                          <option value="{{$vehicle_category->id}}">{{$vehicle_category->name}}</option>
                                                                      @endforeach
                                                                  </select>

                                                              </div>
                                                          </div>
                                                          <div class="col-md-5">
                                                              <div class="form-group">
                                                                  <label>Change Vehicle Name</label>
                                                                  <input type="text" name="new_vehicle_name" required value="{{$vehicle_type->name}}" class="form-control" />
                                                              </div>
                                                          </div>
                                                          <div class="col-md-2">
                                                              <div class="form-group">
                                                                  <label>&nbsp;</label>
                                                                  <button class="btn btn-primary btn-block"> Save</button>
                                                              </div>
                                                          </div>
                                                      </form>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

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
</div>


@endsection

@section('javascript')
    <script src="{{asset('js/pages/settings/vehicle_management.js')}}"></script>
@endsection