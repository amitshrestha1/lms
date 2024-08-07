@extends('admin.layout.main')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">user List</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    S.N
                                </th>
                                <th>
                                    Full Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Profile Picture
                                </th>
                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($user as $i => $list)
                                <tr>
                                    <td>
                                        {{ $i + 1 }}
                                    </td>
                                    <td>
                                        {{ $list->name }}
                                    </td>
                                    <td>
                                        {{ $list->email }}
                                    </td>
                                    <td>
                                        @if (@isset($list->department_id))
                                            {{ $list->department->name }}
                                        @endif

                                    </td>
                                    <td>
                                        <img class="img-md img-fluid rounded-circle" src="{{asset('/images/profile_picture/'. $list->image)}}" alt="Profile image">
                                    </td>
                                    <td>
                                        <form action="{{ route('user.delete', $list->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('user.edit', $list->id) }}" class="btn btn-info">Edit</a>
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
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
