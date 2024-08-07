@extends('admin.layout.main')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Holiday Mode</h4>
        
        <form class="forms-sample" action="{{route('create.mode')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="exampleInputUsername1">Mode</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name="mode" placeholder="Create Mode">
          </div>
          <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection