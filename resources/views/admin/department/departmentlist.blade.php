@extends('admin.layout.main')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Department List</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    S.N
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($department as $i => $list)
                                <tr>
                                    <td>
                                        {{ $i + 1 }}
                                    </td>
                                    <td>
                                        {{ $list->name }}
                                    </td>
                                    <td>
                                        <div class="row">
                                            <form action="{{ route('department.delete', $list->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('department.edit', $list->id) }}" class="btn btn-info">Edit</a>
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
