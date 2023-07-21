<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Media Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
        .logout:hover {
            background-color: rgb(183, 47, 47);
            opacity: 0.8;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">

                <span class="brand-text font-weight-light">Blog Posts System </span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="fas fa-user-circle"></i>
                                <p>
                                    My Profile
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin#list') }}" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    Admin List
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin#category') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin#post') }}" class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>
                                    Post
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin#contact') }}" class="nav-link">
                                <i class="fa-solid fa-bell"></i>
                                <p>
                                    Messages
                                </p>
                            </a>
                        </li>

                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <li class="nav-item">
                                <button class="btn btn-secondary w-100 logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>
                                        Logout
                                    </span>
                                </button>
                            </li>
                        </form>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

</body>

@yield('script')
</html>
