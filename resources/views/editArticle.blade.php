@extends('backOfficeHeader')

@section('content')

    <div class="container">
        <section style="background: whitesmoke;">
            <h1>
                Modifier un article
            </h1>
            <div class="row">
                <div class="col-6">
                    <p>Titre : {{ $article->nom }}</p>
                </div>
                <div class="col-6">
                    <p>Crée le : {{ $article->date }}</p>
                </div>
            </div>

            <form method="post" action="{{ url('update/' . $article->id) }}" id="form_article">
                @csrf

                <h2>Généralités de l'article</h2>

                <div class="form-group">
                    <label for="name">Nom de l'article* : </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $article->nom }}" required>
                </div>

                <div class="form-group">
                    <label for="difficulte">Difficulté* : </label>
                    <select name="difficulte" id="difficulte" class="form-control" required>
                        <option value="facile"
                            @if ($article->difficulte === 'facile' )
                                selected
                            @endif
                        >Facile</option>
                        <option value="moyen"
                            @if ($article->difficulte === 'moyen' )
                            selected
                            @endif
                        >Moyen</option>
                        <option value="difficile"
                            @if ($article->difficulte === 'difficile' )
                            selected
                            @endif
                        >Difficile</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="temps_prepa">Temps moyen de préparation* : </label>
                    <input type="number" name="temps_prepa" id="temps_prepa" class="form-control" value="{{ $article->temps_prepa }}" required>
                </div>

                <div class="form-group">
                    <label for="temps_cuisson">Temps moyen de cuisson* : </label>
                    <input type="number" name="temps_cuisson" id="temps_cuisson" class="form-control" value="{{ $article->temps_cuisson }}" required>
                </div>

                <div class="form-group">
                    <label for="portion">Portion* : </label>
                    <input type="number" name="portion" id="portion" class="form-control" value="{{ $article->portion }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description* : </label>
                    <textarea class="form-control" id="description" name="description"
                              rows="5" cols="33" class="form-control" required>{{ $article->description }}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image* : </label>
                    <p><img src="../../{{ $article->image }}"> </p>
                </div>

                @if($article->video)
                    <div class="form-group">
                        <label for="video">Video : </label>
                    </div>
                    <video controls width="100%">
                        <source src="../../{{ $article->video }}"
                                type="video/webm">
                    </video>
                @else
                    <label for="video">Video : </label>
                    <input type="file" name="video" id="video" accept="video/*" value="{{ $article->video }}">

                @endif

                <div class="form-group">
                    <label for="pays">Pays : </label>
                    <input type="text" name="pays" id="pays" class="form-control" value="{{ $article->pays }}">
                </div>

                <h2>Ingrédients</h2>

                @php
                    $i = 1;
                @endphp

                <div id="ingredients">

                    @foreach($ingredients as $ing)
                        <div class="form-group single_ingredient">
                            <label for="ingredient-{{ $i }}">Ingrédient n°{{ $i }}</label>
                            <input type="text" name="ingredient[]" id="ingredient-{{ $i }}" class="form-control" value="{{ $ing->nom }}">
                        </div>
                    @php
                        {{ $i++; }}
                    @endphp

                    @endforeach

                </div>

                <div class="button">
                    <button class="btn btn-primary" id="add_ingredient">Ajouter nouvel ingrédient</button>
                </div>

                <h2>Catégories</h2>

                @php
                    $j = 1;
                @endphp
                <div id="categories">

                    @foreach($categories as $c)

                        <div class="form-group">
                            <label for="categorie-{{ $j }}">Catégories n°{{ $j }}</label>

                            <div class="row single_category div_{{ $j }}">
                                <select name="categorie[]" id="categorie-{{ $j }}" class="form-control col-md-8" required>
                                    @foreach($list_categories as $list)
                                        <option value="{{ $list->nom }}"
                                            @if($list->nom === $c->nom)
                                                selected
                                            @endif
                                        >{{ $list->nom }}</option>
                                    @endforeach
                                </select>
                                <div>
                                    <button onclick="changeInput({{ $j }})" class="btn btn-warning new_categorie" id="n{{ $j }}">Nouvelle catégorie</button>
                                </div>
                            </div>

                        </div>
                        @php
                            $j++;
                        @endphp
                    @endforeach

                </div>

                <div class="button">
                    <button onclick="a({{ $list_categories }})" class="btn btn-primary" id="add_categorie">Ajouter nouvelle catégorie</button>
                </div>

                <h2>Etapes</h2>

                @php
                    $k = 1;
                @endphp
                <div id="etapes">

                    @foreach($etapes as $e)
                        <div class="form-group single_etape">
                            <label for="etape-{{ $k }}">Etape n°{{ $k }}</label>
                            <textarea class="form-control" id="etape-{{ $k }}" name="etape[]"
                                      rows="5" cols="33" classs="form-control">{{ $e->nom }}
                            </textarea>
                        </div>
                        @php
                            $k++;
                        @endphp
                    @endforeach

                </div>

                <div class="button">
                    <button class="btn btn-primary" id="add_etape">Ajouter nouvelle étape</button>
                </div>

                <br>

                <div class="button">
                    <input type="submit" class="btn btn-success" value="Créer l'article" name="create_article" id="create_article">
                </div>

            </form>
        </section>

    </div>

@endsection