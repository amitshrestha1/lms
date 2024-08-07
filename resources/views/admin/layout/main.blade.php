@php
    $user = \App\Models\User::find(Auth::id())->first();
@endphp
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <style>
        .radio-ml {
            margin-left: 0%;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->

    <link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="/home">
                        <img src="images/logo.svg" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="/home">
                        <img src="images/logo-mini.svg" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Greetings, <span
                                class="text-black fw-bold">{{ Auth()->user()->name }}</span></h1>
                        @if (Auth()->user()->usertype == 'Admin')
                            <h3 class="welcome-sub-text">Hello Admin</h3>
                        @else
                            <h3 class="welcome-sub-text">Hello Staff</h3>
                        @endif
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="countDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle"
                                src="{{ asset('/images/profile_picture/' . Auth()->user()->image) }}"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md img-fluid rounded-circle"
                                    src="{{ asset('/images/profile_picture/' . Auth()->user()->image) }}"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ Auth()->user()->name }}</p>
                                <p class="fw-light text-muted mb-0">{{ Auth()->user()->email }}</p>
                            </div>
                            <form id= "GFG" action="{{ route('logout') }}" method="POST">

                                @csrf
                                <a class="dropdown-item">
                                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i><button
                                        class="menu-title border-0 bg-transparent" type="submit">Logout</button></a>
                            </form>

                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                            <iconify-icon icon="ri:dashboard-fill" width="32" height="32"></iconify-icon>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if (Auth()->user()->usertype == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-department"
                                aria-expanded="false" aria-controls="ui-basic">
                                <iconify-icon icon="fluent-emoji-high-contrast:department-store" width="32"
                                    height="32"></iconify-icon>
                                <span class="menu-title">Department</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-department">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('department.create') }}">Create Department</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('department.list') }}">View Department</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-leavetype" aria-expanded="false"
                                aria-controls="ui-basic">
                                <iconify-icon icon="lucide:book-type" width="32" height="32"></iconify-icon>
                                <span class="menu-title">Leave Type</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-leavetype">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('leavetype.create') }}">Create Leavetype</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('leavetype.list') }}">View Leavetype</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-user" aria-expanded="false"
                                aria-controls="ui-basic">
                                <iconify-icon icon="mdi:user" width="32" height="32"></iconify-icon>
                                <span class="menu-title">Users</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-user">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('user.create') }}">Create User</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.list') }}">View
                                            User</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if (Auth()->user()->usertype == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-leave" aria-expanded="false"
                                aria-controls="ui-basic">
                                <iconify-icon icon="pepicons-pop:letter" width="32"
                                    height="32"></iconify-icon>
                                <span class="menu-title">Leave Application</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-leave">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('leave.create') }}">Apply for Leave</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('leave.list') }}">View
                                            Applications</a></li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-leave" aria-expanded="false"
                                aria-controls="ui-basic">
                                <iconify-icon icon="pepicons-pop:letter" width="32"
                                    height="32"></iconify-icon>
                                <span class="menu-title">Leave Application</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-leave">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('leave.create') }}">Apply for Leave</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('leave.list') }}">View
                                            Applications</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if (Auth()->user()->usertype == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-holiday" aria-expanded="false"
                                aria-controls="basic">
                                <iconify-icon icon="fluent-emoji-high-contrast:department-store" width="32"
                                    height="32"></iconify-icon>
                                <span class="menu-title">Holiday</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-holiday">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{route('create.holiday')}}">Create Holiday</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('list.holiday') }}">View Holiday</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif

                        @if (Auth()->user()->usertype == 'Admin')

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#mode" aria-expanded="false"
                                aria-controls="ui-basic">
                                <iconify-icon icon="fluent-emoji-high-contrast:department-store" width="32"
                                    height="32"></iconify-icon>
                                <span class="menu-title">Holiday Mode</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="mode">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('create.mode') }}">Create Holiday Mode</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('select.mode') }}">Select Holiday</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif





                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('calendar') }}">
                            <iconify-icon icon="uil:calender" width="32" height="32"></iconify-icon>
                            <span class="menu-title">Calender</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id= "GFG" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a class="nav-link">
                                <iconify-icon icon="material-symbols:logout" width="32"
                                    height="32"></iconify-icon>
                                <button class="menu-title border-0 bg-transparent" type="submit">Logout</button>
                            </a>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">

                                @yield('content')
                                @include('admin.layout.modal')

                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a>
                            from BootstrapDash.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All
                            rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script> --}}

    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('/css/fullcalendar/index.global.js') }}"></script>


    @yield('script')
    <script>
        function myFunction() {
            document.getElementById("GFG").submit();
        }
    </script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                iziToast.success({
                    title: '',
                    position: 'topRight',
                    color: 'red',
                    message: '{{ $error }}'
                });
            @endforeach
        @endif

        @if (session()->get('success'))
            iziToast.success({
                title: '',
                position: 'topRight',
                color: 'green',
                message: '{{ session()->get('success') }}'
            });
        @endif
        @if (session()->get('error'))
            iziToast.error({
                title: '',
                position: 'topRight',
                color: 'red',
                message: '{{ session()->get('error') }}'
            });
        @endif
    </script>
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
   
    <!-- End custom js for this page-->
</body>

</html>
