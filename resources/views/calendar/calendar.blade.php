@extends('admin.layout.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">Calendar</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">
                    <div id="calendar">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script type="text/javascript">
        var leave = {!! json_encode($events) !!};
        var holiday = {!! json_encode($holidayEvents) !!};
        var user = {!! json_encode($user1) !!};
        console.log(user);
        if (user[0].usertype == "Staff") {
            var event1 = leave
                .filter(function(leave) {
                    // Display leave events for the current user only
                    return leave.user_id === user[0].id;
                })
                .map(function(leave) {
                    var color;
                    var tcolor;
                    if (leave.status == "Approved") {
                        color = 'green';
                        tcolor = 'white';
                    } else if (leave.status == "Rejected") {
                        color = 'red';
                        tcolor = 'white';
                    } else {
                        color = 'yellow';
                        tcolor = 'black';
                    }

                    return {
                        title: leave.name + ' - ' + leave.leave_type + ' - ' + leave.reason + '-' + leave.status,
                        start: leave.from,
                        end: leave.to + 'T23:59:59',
                        color: color,
                        textColor: tcolor,
                    };
                });
        } else {

            var event1 = leave.map(function(leave) {

                var color;
                var tcolor;
                if (leave.status == "Approved") {
                    color = 'green';
                    tcolor = 'white';
                } else if (leave.status == "Rejected") {
                    color = 'red';
                    tcolor = 'white';
                } else {
                    color = 'yellow';
                    tcolor = 'black';

                }
                return {
                    title: leave.name + ' - ' + leave.leave_type + ' - ' + leave.reason + '-' + leave
                        .status, // Event title
                    start: leave.from,
                    end: leave.to + 'T23:59:59',
                    color: color,
                    textColor: tcolor,
                };

            });
        }

        var event2 = holiday.map(function(holiday) {
            var tcolor1;
            var color1;
            color1 = 'white';
            tcolor1 = 'white';
            return {
                title: holiday
                .name, // Event title leave.name + ' - ' + leave.leave_type + ' - ' + leave.reason + '-' + leave   .status+ '-' +
                start: holiday.date,
                display: 'background',
                backgroundColor: 'red',
                // color: color1,
                textColor: 'black',
            };
        });
        var calendarID = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarID, {
            themeSystem: 'bootstrap5',
            timeZone: 'local',
            allDaySlot: false,

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth, timeGridWeek, timeGridDay, listMonth'
            },
            initialDate: '<?= date('Y-m-d') ?>',
            navLinks: true,
            editable: false,
            displayEventTime: false,
            events: event1.concat(event2),
            eventClick: function(info) {
                alert('Event: ' + info.event.title);


                // change the border color just for fun
                info.el.style.borderColor = 'red';
            }
        });
        $('table.calendar > tbody > tr > td:nth-child(-n+2)').addClass('fc-weekend');
        calendar.render();
    </script>
@endsection
