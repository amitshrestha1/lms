@extends('staff.layout.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="statistics-details d-flex align-items-center justify-content-between">
                <div>
                    <p class="statistics-title">Leaves Applied</p>
                    <h3 class="rate-percentage"></h3>

                </div>
                <div>
                    <p class="statistics-title">Leave Left</p>
                    <h3 class="rate-percentage">5</h3>

                </div>


            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
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
                            <tr>
                                <td>1</td>
                                <td>Sick Leave</td>
                                <td>Fever</td>
                                <td>2023/10/05</td>
                                <td>2023/10/10</td>
                                <td>Pending</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
