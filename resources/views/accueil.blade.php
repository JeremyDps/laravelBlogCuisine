@extends('welcome')

@section('content')
    <section id="tops">
        <div class="container-fluid">
            <h2>Les tops</h2>
            <div class="row">
                @php
                    {{$i = 1;}}
                @endphp
                @foreach ($articles as $a)
                    @if((($i % 2 != 0) || $i == 1) )
                        <div class="col-xl-6 maybe-right bottom">
                            <div class="article-bloc">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="article-bloc-description article-bloc-img">
                                            <img src="{{ $a->image }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="article-bloc-description">
                                            <h3>{{ $a->nom }}</h3>
                                            <p>{{ create_explode($a->description) }}...</p>
                                            <p>Catégories :
                                                @foreach($a->categories as $c)
                                                    @if($loop->last)
                                                        {{ $c->nom }}
                                                    @else
                                                        {{ $c->nom }},
                                                    @endif
                                                @endforeach
                                            </p>
                                            <div class="article-bloc-description-button">
                                                <a href="article/{{ $a->id }}" type="button" class="btn btn-outline-success">Aller voir l'article</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-6 bottom">
                            <div class="article-bloc">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="article-bloc-description article-bloc-img">
                                            <img src="{{ $a->image }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="article-bloc-description">
                                            <h3>{{ $a->nom }}</h3>
                                            <p>{{ create_explode($a->description) }}...</p>
                                            <p>Catégories :
                                                @foreach($a->categories as $c)
                                                    @if($loop->last)
                                                        {{ $c->nom }}
                                                    @else
                                                        {{ $c->nom }},
                                                    @endif
                                                @endforeach
                                            </p>
                                            <div class="article-bloc-description-button">
                                                <a href="article/{{ $a->id }}" type="button" class="btn btn-outline-success">Aller voir l'article</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        {{ $i++; }}
                    @endphp
                @endforeach
            </div>
            <div class="container" id="btn-other-articles">
                <a href="search" type="button" class="btn btn-outline-info">Voir d'autres articles</a>
            </div>
        </div>
    </section>

    <section id="tops">
        <div class="container-fluid">
            <h2>Les plats</h2>
            <div class="row">
                @php
                    {{$i = 1;}}
                @endphp
                @foreach ($plats as $p)
                    @if((($i % 2 != 0) || $i == 1) )
                        <div class="col-xl-6 maybe-right bottom">
                            <div class="article-bloc">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="article-bloc-description article-bloc-img">
                                            <img src="{{ $p->image }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="article-bloc-description">
                                            <h3>{{ $p->nom }}</h3>
                                            <p>{{ create_explode($p->description) }}...</p>
                                            <p>Catégories :
                                                @foreach($p->categories as $c)
                                                    @if($loop->last)
                                                        {{ $c->nom }}
                                                    @else
                                                        {{ $c->nom }},
                                                    @endif
                                                @endforeach
                                            </p>
                                            <div class="article-bloc-description-button">
                                                <a href="article/{{ $p->id }}" type="button" class="btn btn-outline-success">Aller voir l'article</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-6 bottom">
                            <div class="article-bloc">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="article-bloc-description article-bloc-img">
                                            <img src="{{ $p->image }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="article-bloc-description">
                                            <h3>{{ $p->nom }}</h3>
                                            <p>{{ create_explode($p->description) }}...</p>
                                            <p>Catégories :
                                                @foreach($p->categories as $c)
                                                    @if($loop->last)
                                                        {{ $c->nom }}
                                                    @else
                                                        {{ $c->nom }},
                                                    @endif
                                                @endforeach
                                            </p>
                                            <div class="article-bloc-description-button">
                                                <a href="article/{{ $p->id }}" type="button" class="btn btn-outline-success">Aller voir l'article</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        {{ $i++; }}
                    @endphp
                @endforeach
            </div>
            <div class="container" id="btn-other-articles">
                <a href="search/unique/plats" type="button" class="btn btn-outline-info">Voir d'autres articles</a>
            </div>
        </div>
    </section>

    <div class="container" id="btn-all-articles">
        <a href="search" type="button" class="btn btn-outline-info">Voir tous les articles</a>
    </div>
@endsection