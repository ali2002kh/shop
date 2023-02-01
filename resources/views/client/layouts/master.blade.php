<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><i class="fa fa-shopping-cart" style="font-size:25px"></i></a>
                    </li>
                    @if (auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownAccount">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('signup_page') }}" class="nav-link">login/signup</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="" class="nav-link">products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategory" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownCategory">
                            @foreach ($categories as $c)
                            <li><a class="dropdown-item" href="#">{{ $c->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <div class="input-group">
                    <div id="navbar-search-autocomplete" class="form-outline">
                        <input type="search" id="form1" class="form-control" placeholder="Search"/>
                    </div>
                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>
        </div>
    </nav>

    @yield('content')

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
              <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
              </a>
              <span class="mb-3 mb-md-0 text-muted">&copy; 2022 Company, Inc</span>
            </div>
        
            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
              <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-instagram" style="font-size:25px"></i></a></li>
              <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-telegram" style="font-size:25px"></i></a></li>
              <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-whatsapp" style="font-size:25px"></i></a></li>
            </ul>
          </footer>
    </div>
</body>
@yield('javascript')
</html>
@yield('style')