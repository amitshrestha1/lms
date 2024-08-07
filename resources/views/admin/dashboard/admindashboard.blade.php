@extends('admin.layout.main')
@section('content')
    @if (Auth()->user()->usertype == 'Admin')
        <div class="row">
            <div class="col-sm-12">
                <div class="statistics-details d-flex align-items-center justify-content-between">
                    <div>
                        <p class="statistics-title">Staffs</p>
                        <h3 class="rate-percentage">{{ $staff }}</h3>

                    </div>
                    <div>
                        <p class="statistics-title">Departments</p>
                        <h3 class="rate-percentage">{{ $department_count }}</h3>

                    </div>
                    <div>
                        <p class="statistics-title">Total Leave Application</p>
                        <h3 class="rate-percentage">{{ $leave_count }}</h3>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Leave Application</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>User</th>
                                    <th>Department</th>
                                    <th>Leave Type</th>
                                    <th>Leave Reason</th>
                                    <th>Leave Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @foreach ($user->leave as $i => $leave)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                @if (@isset($user->department_id))
                                                    {{ $user->department->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (@isset($leave->type))
                                                    {{ $leave->type->name }}
                                                @endif
                                            </td>
                                            <td> {{ $leave->reason }}</td>
                                            <td>
                                                @if ($leave->status == 'Pending')
                                                    <label class="badge badge-warning">{{ $leave->status }}</label>
                                                @elseif($leave->status == 'Approved')
                                                    <label class="badge badge-success">{{ $leave->status }}</label>
                                                @else
                                                    <label class="badge badge-danger">{{ $leave->status }}</label>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-12">
                <div class="statistics-details d-flex align-items-center justify-content-between">
                    <div>
                        <p class="statistics-title">Leaves Applied</p>
                        <h3 class="rate-percentage">{{ $leave_count }}</h3>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Application</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Leave Type</th>
                                    <th>Reason</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leave as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            @if (@isset($item->type_id))
                                                {{ $item->type->name }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->reason }}
                                        </td>
                                        <td>
                                            {{ $item->from }}
                                        </td>
                                        <td>
                                            {{ $item->to }}
                                        </td>
                                        <td>
                                            @if ($item->status == 'Pending')
                                                <label class="badge badge-warning">{{ $item->status }}</label>
                                            @elseif($item->status == 'Approved')
                                                <label class="badge badge-success">{{ $item->status }}</label>
                                            @else
                                                <label class="badge badge-danger">{{ $item->status }}</label>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
