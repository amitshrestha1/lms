@extends('admin.layout.main')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Staff</h4>
                <form class="forms-sample" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail3" name="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}" id="myInput">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="checkbox" class="form-check-input" id="toggleCheckbox" onclick="mytogglePassFunc()">
                                    <label class="form-check-label" for="toggleCheckbox">Show Password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Confirm Password</label>
                        <input type="password" class="form-control" id="myInput1" name="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                    </div>
                    <div class="form-group">
                        <label>Profile Picture</label>
                        <div class="input-group col-xs-12">
                            <input class="form-control file-upload-info" placeholder="Upload Image" name="image" type="file" id="image" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Department</label>
                        <select class="form-control" id="exampleSelectGender" name="department_id">
                            <option selected disabled>Select Department</option>
                            @foreach ($department as $name)
                                <option value="{{ $name->id }}">{{ $name->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function mytogglePassFunc() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var checkbox = document.getElementById("toggleCheckbox");
            var mouseDown = false;

            checkbox.addEventListener('mousedown', function () {
                mouseDown = true;
            });

            document.addEventListener('mouseup', function () {
                if (mouseDown) {
                    checkbox.checked = !checkbox.checked;
                }
                mouseDown = false;
            });
        });
    </script>
@endsection
