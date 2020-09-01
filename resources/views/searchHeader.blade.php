<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>recherche article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
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
                        <a class="nav-link" href="../../search/unique/entree">Les bases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../search/unique/entree">Entrées</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../search/unique/plats">Plats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../search/unique/desserts">Desserts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<section id="about">
    <div class="bg"></div>
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
