<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/article.css') }}">

        <title>Blog cuisine</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
    <header>
        <nav id="nav-header" class="navbar navbar-expand-md navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#" id="website-name">Recettes cuisine</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/search/unique/entree">Les bases</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/search/unique/entree">Entrées</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/search/unique/plats">Plats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/search/unique/desserts">Desserts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="about">
        <div class="bg"></div>
        <div class="about-description">
            <div class="container about-description-container">
                <h1>Recettes cuisine</h1>
                <p><small>Le blog moderne de toutes les recettes</small></p>
                <form class="col-md-10" method="post" action="{{ url('search') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-8 col-lg-10">
                            <input class="form-control" type="text" id="data-search" name="data-search" placeholder="Que recherchez-vous ?">
                        </div>
                        <div class="form-group data-search-btn col-5 col-xs-4 col-md-4 col-lg-2">
                            <input class="form-control btn btn-outline-primary" type="submit" id="data-search-btn" name="data-search-btn" value="Rechercher">
                        </div>
                    </div>
                </form>
                <p>Sur recettes cuisine, vous trouverez toutes les recettes pour tous les évènements de l'année,
                    mais aussi les recettes de base, les grands classiques ou encore les recettes diététiques pour les athlètes.
                </p>
            </div>
        </div>

    </section>

    <main>
        @yield('content')
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        let isVerified = false;
        setInterval(function() {
            let elements = document.querySelectorAll('.maybe-right');
            if((document.body.clientWidth + 17 >= 1200) && (isVerified == false)) {
                for(let i = 0; i < elements.length; i++) {
                    elements[i].className += ' right';
                }
                isVerified = true;
            }

            if(document.body.clientWidth + 17 < 1200) {
                for(let i = 0; i < elements.length; i++) {
                    elements[i].className = 'col-xl-6 maybe-right bottom';
                }
                isVerified = false;
            }
        }, 150);
    </script>
    </body>
</html>
