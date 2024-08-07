@extends('admin.layout.main')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Holiday</h4>
        
        <form class="forms-sample" action="{{route('update.holiday')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value={{$holiday->id}}>
          <div class="form-group">
            <label for="exampleInputUsername1">Holiday Name</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name" value="{{$holiday->name}}">
          </div>
          <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" value="{{$holiday->date}}">
        </div>
          <button type="submit" class="btn btn-primary me-2">Save Changes</button>
          <a href="{{route('list.holiday')}}" class="btn btn-danger me-2">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection