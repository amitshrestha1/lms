@extends('admin.layout.main')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Staff</h4>
        <form class="forms-sample" action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value={{$user->id}}>
          <div class="form-group">
            <label for="exampleInputName1">Name</label>
            <input type="text" class="form-control"  name="name" placeholder="Name" value='{{trim($user->name)}}'>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail3" name="email" placeholder="Email"value={{$user->email}}>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword4" name="password" placeholder=""value={{$user->password}}>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword4" name="password_confirmation" placeholder="Password">
          </div>
          <div class="form-group">
            <label>Profile Picture</label>
            <div class="input-group col-xs-12">
                <input class="form-control file-upload-info" placeholder="Upload Image" name="image"
                    type="file" id="image" accept="image/*">
            </div>
        </div>
          {{-- <div class="form-group">
            <label for="exampleSelectGender">Gender</label>
              <select class="form-control" id="exampleSelectGender">
                <option>Male</option>
                <option>Female</option>
              </select>
            </div> --}}
          {{-- <div class="form-group">
            <label>Profile Picture</label>
            <input type="file" name="img[]" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
          </div> --}}
          <div class="form-group">
            <label for="exampleSelectGender">Department</label>
              <select class="form-control" id="exampleSelectGender" name='department_id'>
                @foreach ( $department as $name )
                <option value={{$name->id}}>{{$name->name}}</option>
                @endforeach
               
              </select>
            </div>
          <button type="submit" class="btn btn-primary me-2">Save Changes</button>
          <a href="{{route('user.list')}}" class="btn btn-danger me-2">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection