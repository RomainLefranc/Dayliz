<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dayliz</title>


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">



</head>

<body>

    <div id="wrapper">
        <ul class="nav nav-tabs mb-2">
            <li class="nav-item">
              <a class="nav-link {{ Request::segment(1) === 'users' ? 'active' : '' }}" aria-current="page" href="{{ route('users.index') }}">Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) === 'activities' ? 'active' : '' }} " aria-current="page" href="{{ route('activities.index') }}">Activité</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ Request::segment(1) === 'roles' ? 'active' : '' }}" aria-current="page" href="{{ route('roles.index') }}">Role</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ Request::segment(1) === 'promotions' ? 'active' : '' }}" aria-current="page" href="{{ route('promotions.index') }}">Promotions</a>
            </li>
        </ul>
     

        <!-- Page Content -->
        <div >

            <div class="container-fluid ">
                @yield('content')
            </div>

        </div>
        <!-- /#page-content-wrapper -->



    </div>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    @stack('scripts')


</body>


</html>