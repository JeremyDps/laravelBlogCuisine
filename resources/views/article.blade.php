@extends('articleHeader')

@section('content')

    <section id="article">
        <div class="container">
            <h1 class="article-title">{{ $article->nom }}</h1>
            <div class="col-10 col-md-8 img-article">
                <p><img src="../{{ $article->image }}"></p>
            </div>

            <hr>

            <div class="row article-header">
                <div class="col-md-8">
                    <div class="article-description">
                        <p>{{ $article->description }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats">
                        <div class="one-stat">
                            <div class="row">
                                <div class="one-stat-title col-7">
                                    <p>Difficulté</p>
                                </div>
                                <div class="one-stat-result col-5">
                                    <p>{{ $article->difficulte }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="one-stat-title col-7">
                                    <p>Temps de préparation</p>
                                </div>
                                <div class="one-stat-result col-5">
                                    <p>{{ $article->temps_prepa }} min</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="one-stat-title col-7">
                                    <p>Temps de cuisson</p>
                                </div>
                                <div class="one-stat-result col-5">
                                    <p>{{ $article->temps_cuisson }} min</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="one-stat-title col-7">
                                    <p>Portion</p>
                                </div>
                                <div class="one-stat-result col-5">
                                    <p>{{ $article->portion }} personnes</p>
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="one-stat-title col-7">
                                    <p><span id="nbr-likes">{{ $article->likes }}</span> likes</p>
                                </div>
                                <div class="one-stat-result col-5">
                                    <form method="post" action="like/{{ $article->id }}">
                                        <p><button type="submit" class="btn btn-primary" id="btn-like">J'aime</button></p>
                                    </form>

                                </div>
                            </div>-->

                        </div>
                    </div>
                </div>
            </div>

            <div class="row steps">
                <div class="col-md-6">
                    <div class="article-ingredients">
                        <h2>Les ingrédients</h2>
                        <ul>

                            @foreach($ingredients as $i)


                            <li>{{ $i->nom }}</li>

                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="article-etapes">
                        <h2>Les étapes</h2>
                        <ul>

                            @foreach($etapes as $e)

                            <li>{{ $e->nom }}</li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            @if($article['video'] != null)


            <div class="col-10 col-md-8 video">
                <h2>La recette en vidéo</h2>
                <video controls width="100%">
                    <source src="../{{ $article->video }}"
                            type="video/webm">
                </video>
            </div>

            @endif

            <div class="col-10 suggestions">
                <h2>Ces articles pourraient également vous intéresser</h2>
                <div class="row">

                    @foreach($suggestions as $s)

                    <div class="col-md-4 other-article">
                        <div>
                            <p>
                                <a href="{{ $s->id }}"><img src="../{{ $s->image }}"></a>
                            </p>
                            <p>{{ $s->nom }}</p>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>

    </section>

    <section id="comment">
        <div class="container">
            <h2 style="text-align: center;">Ajouter un commentaire</h2>
            <form class="col-md-8" method="post" action="{{ url('article/' . $article->id) }}">
                @csrf

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="lastname">Votre nom : </label>
                        <input class="form-control" type="text" name="lastname" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="firstname">Votre prénom : </label>
                        <input class="form-control" type="text" name="firstname" required>
                    </div>
                </div>
                <textarea class="form-control" id="commentaire" name="commentaire"
                          rows="5" cols="33" required>
                    </textarea><br>
                <div id="send-message">
                    <input class="btn btn-outline-success" type="submit" name="submit-comment" value="Commenter">
                </div>

            </form>
        </div>
    </section>

    <section id="message">
        <div class="container">

            @foreach($commentaires as $co)

            <div>
                <p>{{ $co->prenom }} {{ $co->nom }}  a commenté le {{ $co->date }}</p>
                <p>{{ $co->commentaire }}</p>
            </div>

            @endforeach
        </div>
    </section>

@endsection