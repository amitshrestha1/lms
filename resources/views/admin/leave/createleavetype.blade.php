@extends('admin.layout.main')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Leave Type</h4>
        
        <form class="forms-sample" action="{{route('leavetype.store')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="exampleInputUsername1">Name</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label for="exampleInputUsername1"> No of Days</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name="days" placeholder="Days" value="{{old('days')}}">
          </div>
          <button type="submit" class="btn btn-primary me-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection