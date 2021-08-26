<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dayliz</title>

    <!-- CSS only -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<body>

    <div id="wrapper">
        <ul class="nav nav-tabs mb-2 bg-dark pt-2">
            <li class="nav-item {{ Request::segment(1) === 'users' ? 'active' : '' }}">
              <a class="nav-link {{ Request::segment(1) === 'users' ? 'active' : '' }}" aria-current="page" href="{{ route('users.index') }}">Utilisateurs</a>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'roles' ? 'active' : '' }}">
                <a class="nav-link  {{ Request::segment(1) === 'roles' ? 'active' : '' }}" aria-current="page" href="{{ route('roles.index') }}">Rôles</a>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'promotions' ? 'active' : '' }}">
                <a class="nav-link  {{ Request::segment(1) === 'promotions' ? 'active' : '' }}" aria-current="page" href="{{ route('promotions.index') }}">Promotions</a>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'examens' ? 'active' : '' }}">
                <a class="nav-link  {{ Request::segment(1) === 'examens' ? 'active' : '' }}" aria-current="page" href="{{ route('examens.index') }}">Examens</a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ Request::segment(1) === 'examens' ? 'active' : '' }}" aria-current="page" href="{{ route('examens.index') }}">Examens</a>
            </li>

            
                <li class="navbar-nav nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->lastName }} <i class="now-ui-icons sport_user-run"></i>
                  </a>
  
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Déconnexion') }}
                      </a>
  
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
              </li>
             
              
            

        </ul>
     

        <!-- Page Content -->
        <div>

            <div class="container-fluid ">
                @yield('content')
            </div>

        </div>
        <!-- /#page-content-wrapper -->



    </div>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    @stack('scripts')


</body>


</html>
