@extends('admin.layout.main')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Department</h4>
        
        <form class="forms-sample" action="{{route('department.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value={{$department->id}}>
          <div class="form-group">
            <label for="exampleInputUsername1">Department Name</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name" value="{{$department->name}}">
          </div>
          <button type="submit" class="btn btn-primary me-2">Save Changes</button>
          <a href="{{route('department.list')}}" class="btn btn-danger me-2">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection