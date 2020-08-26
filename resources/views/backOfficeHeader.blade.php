<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/backOffice.css') }}">

        <title>Blog cuisine</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>

        <header id="bo_header">
            <div class="container">
                <div class="row">
                    <div id="bo_header_link_1" class="col-md-6">
                        <a href="/bo">Liste des articles</a>
                    </div>
                    <div id="bo_header_link_2" class="col-md-6">
                        <a href="/bo/new">Créer nouvel article</a>
                    </div>
                </div>
            </div>
        </header>
        <main>
            @yield('content')
        </main>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/backOffice.js') }}"></script>
    </body>
</html>