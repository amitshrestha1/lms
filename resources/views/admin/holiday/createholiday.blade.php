@extends('admin.layout.main')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Holiday</h4>
        
        <form class="forms-sample" action="{{route('store.holiday')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="exampleInputUsername1">Name</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date">
        </div>
          <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection