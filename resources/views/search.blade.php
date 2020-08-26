@extends('searchheader')

@section('content')
    <section id="search-form">
        <div class="container">
            <div class="form">
                <form method="post" action="{{ url('search') }}">
                    @csrf
                    <div class="form-group col-10 col-md-8" id="btn-search-article">
                        <input class="form-control" type="text" id="data-search" name="data-search" placeholder="Que recherchez-vous ?">
                    </div>
                    <div class="row">
                        <div class="col-10 col-md-4 btn-search">
                            <select id="categories" name="categories" class="form-control">
                                <option value="all" selected>Toutes les catégories</option>
                                @foreach($allCategories as $all)
                                    <option value="{{ $all->nom }}">{{ $all->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-10 col-md-4 btn-search">
                            <select id="pays" name="pays" class="form-control">
                                <option value="all" selected>Touts les pays</option>

                                @foreach($allPays as $p)

                                    <option value="{{ $p->pays }}">{{ $p->pays }}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="col-10 col-md-3 btn-search">
                            <input type="submit" class="btn btn-outline-primary" name="rechercher" id="rechercher" value="rechercher">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="results">
        <div class="container-fluid">
            <p>

                @if(count($article) === 0)

                Il n'y a pas d'article correspondant à vos critères de recherche. Essayez de les modifier.


                @elseif(count($article) === 1)

                 1 article correspond à votre recherche.

                @else

                {{ count($article) }} articles correspondent à votre recherche</p>

                @endif
        </div>
        <div class="row">
            @php
                {{$i = 1;}}
            @endphp
            @foreach ($article as $a)
                @if((($i % 2 != 0) || $i == 1) )
                    <div class="col-xl-6 maybe-right bottom">
                        <div class="article-bloc">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="article-bloc-description article-bloc-img">
                                        <img src="../../../../{{ $a->image }}">
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
                                            <a href="../../../article/{{ $a->id }}" type="button" class="btn btn-outline-success">Aller voir l'article</a>
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
                                        <img src="../../../{{ $a->image }}">
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

    </section>


@endsection