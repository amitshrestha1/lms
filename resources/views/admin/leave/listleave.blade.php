@extends('admin.layout.main')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Leave Application</h4>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                @if (Auth()->user()->usertype == 'Admin')
                                    <th>User</th>
                                @endif
                                <th>Leave Type</th>
                                <th>Reason</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                @if (Auth()->user()->usertype == 'Admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leave as $i => $list)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    @if (Auth()->user()->usertype == 'Admin')
                                        <td>
                                            @if (isset($list->user))
                                                {{ $list->user->name }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if (isset($list->type))
                                            {{ $list->type->name }}
                                        @endif
                                    </td>
                                    <td>{{ $list->reason }}</td>
                                    <td>{{ $list->from }}</td>
                                    <td>{{ $list->to }}</td>
                                    @if ($list->status == 'Pending')
                                        <td><label class="badge badge-warning">{{ $list->status }}</label></td>
                                    @elseif($list->status == 'Approved')
                                        <td><label class="badge badge-success">{{ $list->status }}</label></td>
                                    @else
                                        <td><label class="badge badge-danger">{{ $list->status }}</label></td>
                                    @endif
                                    @if (Auth()->user()->usertype == 'Admin')
                                        <td>
                                            <div class="container flex" style="display: flex;">

                                                <form action="{{ route('leave.approve', $list->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-success" type="submit" id="approve_{{$i}}">
                                                        Approve</button>
                                                </form>

                                                
                                                    <button class="btn btn-danger" type="submit" id="reject_{{$i}}" onclick="showModal({{$list->id}})">
                                                        Reject</button>
                                                
                                                <form action="{{ route('leave.delete', $list->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-info" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    @foreach ($leave as $i => $list)
        // Use single quotes for strings inside JavaScript
        var status = '{{$list->status}}';

        if (status === 'Approved' || status === 'Rejected') {
            $("#reject_{{$i}}").hide();
            $("#approve_{{$i}}").hide();
        }
    @endforeach
});
</script>
<script>

   function showModal(id){
    $("#myModal").modal('show');
    $('#reject_modal_id').val(id);
  }
</script>
@endsection
