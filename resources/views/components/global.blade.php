<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="{{asset('sass/app.css')}} " rel="stylesheet">
        <script defer type="text/javascript" src="{{asset(("js/app.js"))}}"></script>
        <title>HardBUD</title>
    </head>

    <body class="d-flex flex-column min-vh-100">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route("index")}}">HardBUD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route("index")}}">Strona Główna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route("offers.index")}}">Wyszukiwarka sprzętu</a>
                        </li>
                        @can('is-offer-taker')
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route("reservations.index")}}">Wynajęty sprzęt</a>
                            </li>
                        @endcan

                        @can('is-admin')
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route("reservations.index")}}">Lista sprzętu</a>
                            </li>
                        @endcan

                        @can('is-admin')
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route("auth.index")}}">Użytkownicy</a>
                            </li>
                        @endcan
                        @can('is-offer-maker')
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('offers.my')}}">Mój sprzęt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route("offers.create")}}">Dodaj sprzęt</a>
                            </li>
                        @endcan
                        @auth()
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('logout')}}">Wyloguj się</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('login')}}">Logowanie</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('register')}}">Rejestracja</a>
                            </li>
                        @endauth
                    </ul>

                    @auth()
                        <span class="navbar-text me-2">
                          Witaj {{Auth::user()->name}}!
                        </span>
                    @endauth
                </div>
            </div>
        </nav>

        <div class="mt-5 pt-3">{{ $slot }}</div>

        <footer class="card-footer py-3 mt-4 border-top mt-auto">
            <div class="container">
                <div class="row align-items-center">
                    <p class="col-12 text-right m-0" style="text-align: right">Marcin Steciuk</p>
                </div>
            </div>
        </footer>
    </body>
</html>
