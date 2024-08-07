{{-- @extends('staff.layout.main')
@section('content')
<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Recent Application</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>User</th>
                            <th>Leave Type</th>
                            <th>Reason</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leave as $i=> $list)    
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$list.user->name}}</td>
                            <td>{{$list->type}}</td>
                            <td>{{$list->reason}}</td>
                            <td>{{$list->from}}</td>
                            <td>{{$list->to}}</td>
                            <td>{{$list->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection --}}