@extends('backOfficeHeader')

@section('content')

    <section id="list_articles" style="background: beige; border-radius: 25px; border: 1px solid black;">
        <div class="container">
            <h1>
                Liste des articles
            </h1>
            <div id="articles">
                <hr>
                @foreach($articles as $a)

                    <div class="single_article">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <p>{{ $a->nom }}</p>
                            </div>
                            <div class="options col-md-4 col-12">
                                <div class="row">
                                    <p class="col-6"><a href="bo/edit/{{ $a->id }}" class="btn btn-success">Modifier</a> </p>
                                    <form method="post" action="/bo/delete/{{ $a->id }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-warning btn_supprimer">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                @endforeach
            </div>
        </div>
    </section>

@endsection