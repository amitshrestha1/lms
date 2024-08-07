@extends('admin.layout.main')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Department</h4>
        
        <form class="forms-sample" action="{{route('department.create')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="exampleInputUsername1">Department Name</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name" value="{{ old('name') }}">
          </div>
          <button type="submit" class="btn btn-primary me-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection