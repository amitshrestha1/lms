@extends('admin.layout.main')
@section('content')
    @if (Auth()->user()->usertype == 'Staff')
        <div class="row">
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Apply for Leave</h4>
                        <form class="forms-sample" action="{{ route('leave.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ Auth()->user()->id }}" name="user_id">
                            <div class="form-group">
                                <label for="exampleSelectGender">Leave Type</label>
                                <select class="form-control" name="type_id" id="leaveType" v-model="newLeave">
                                    <option selected disabled>Select Type</option>
                                    @foreach ($leavetype as $item)
                                        <option value={{ $item->id }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Write your reason" name="reason"
                                    value="{{ old('reason') }}" v-model="newReason" id="reason"></textarea>
                                <label for="floatingTextarea">Reason</label>
                            </div>
                            <div class="form-group">
                                <label for="date">From</label>
                                <input type="date" class="form-control" name="from" value="{{ old('from') }}">
                            </div>
                            <div class="form-group">
                                <label for="date">To</label>
                                <input type="date" class="form-control" name="to" value="{{ old('to') }}">
                            </div>
                            <button @click="addPost(newLeave, newReason)" 
                            :class="{disabled: (!newLeave || !newReason)}"
                            class="btn btn-block btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Remaining Leave Days of user</h4>
                        <table class="table table-hover" id="leaveTable">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Remaining Days</th>
                                </tr>
                            </thead>
                            <tbody id="leaveTableBody">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Apply for Leave</h4>
                        <form class="forms-sample" action="{{ route('leave.admin.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleSelectGender">On Behalf Of</label>
                                <select class="form-control " name="user_id" id="selectuser">
                                    <option selected disabled>Select Staff</option>
                                    @foreach ($user as $user)
                                        <option value={{ $user->id }}
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Leave Type</label>
                                <select class="form-control" name="type_id">
                                    <option selected disabled>Select Type</option>
                                    @foreach ($leavetype as $item)
                                        <option value={{ $item->id }}
                                            {{ old('type_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control " placeholder="Write your reason" id="floatingTextarea" name="reason">{{ old('reason') }}</textarea>
                                <label for="floatingTextarea">Reason</label>
                            </div>
                            <div class="form-group">
                                <label for="date">From</label>
                                <input type="date" class="form-control" name="from" value="{{ old('from') }}">
                            </div>
                            <div class="form-group">
                                <label for="date">To</label>
                                <input type="date" class="form-control" name="to" value="{{ old('reason') }}">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Remaining Leave Days of user</h4>
                        <table class="table table-hover" id="leaveTable">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Remaining Days</th>
                                </tr>
                            </thead>
                            <tbody id="leaveTableBody1">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Add change event listener to the select element
            $('#selectuser').on('change', function() {
                // Get the selected user_id
                var selectedUserId = $(this).val();
                console.log(selectedUserId);
                // Make an AJAX request
                $.ajax({

                    url: '/ajax-handler/' + selectedUserId, // Replace with your actual endpoint
                    type: 'GET', // or 'GET' depending on your server setup
                    success: function(response) {
                        // Handle the response from the server if needed
                        console.log(response);
                        $('#leaveTableBody1').empty();

                        // Loop through leave types and update the table
                        $.each(response.leavetypes, function(index, leavetype) {
                            var remainingDays = response.remainingDays[leavetype.id];
                            $('#leaveTableBody1').append('<tr><td>' + leavetype.name +
                                '</td><td>' +
                                remainingDays + '</td></tr>');
                        });
                    },
                    error: function(error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Make an AJAX request to get user leave data
            $.ajax({
                url: "{{ route('leave.create') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Clear existing rows in the table
                    $('#leaveTableBody').empty();

                    // Loop through leave types and update the table
                    $.each(data.leavetypes, function(index, leavetype) {
                        var remainingDays = data.remainingDays[leavetype.id];
                        $('#leaveTableBody').append('<tr><td>' + leavetype.name + '</td><td>' +
                            remainingDays + '</td></tr>');
                    });
                },
                error: function(error) {
                    console.error('Error fetching user leave data: ', error);
                }
            });
        });
    </script>
    <script>
        export default {
            data() {
                return {
                    newLeave: "",
                    newReason: ""
                }
            },
            created() {
                this.listenForChanges();
            },
            methods: {
                addPost(leaveName, leaveReason) {
                    // check if entries are not empty
                    if (!leaveName || !leaveReason)
                        return;

                    // make API to save post
                    axios.post('/api/post', {
                        title: leaveName,
                        description: leaveReason
                    }).then(response => {
                        if (response.data) {
                            this.newLeave = this.newReason = "";
                        }
                    }) s
                },
                listenForChanges() {
                    Echo.channel('posts')
                        .listen('PostPublished', post => {
                                if (!('Notification' in window)) {
                                    alert('Web Notification is not supported');
                                    return;
                                }

                                Notification.requestPermission(permission => {
                                            let notification = new Notification('New post alert!', {
                                                body: post.title, // content for the alert
                                                icon: "https://pusher.com/static_logos/320x320.png" // optional image url
                                            });
    </script>
@endsection
