@extends('backOfficeHeader')

@section('content')

    <div class="container">
        <section style="background: whitesmoke;">
            <h1>Créer un nouvel article</h1>
            <form method="post" action="{{ url('bo') }}" id="form_article">
                @csrf

                <h2>Généralités de l'article</h2>

                <div class="form-group">
                    <label for="name">Nom de l'article* : </label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="difficulte">Difficulté* : </label>
                    <select name="difficulte" id="difficulte" class="form-control" required>
                        <option value="facile">Facile</option>
                        <option value="moyen">Moyen</option>
                        <option value="difficile">Difficile</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="temps_prepa">Temps moyen de préparation* : </label>
                    <input type="number" name="temps_prepa" id="temps_prepa" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="temps_cuisson">Temps moyen de cuisson* : </label>
                    <input type="number" name="temps_cuisson" id="temps_cuisson" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="portion">Portion* : </label>
                    <input type="number" name="portion" id="portion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description* : </label>
                    <textarea class="form-control" id="description" name="description"
                              rows="5" cols="33" classs="form-control" required>
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image* : </label>
                    <p class="col-12"><input type="file" name="image" id="image" accept="image/png, image/jpeg, image/gif" required></p>
                </div>

                <div class="form-group">
                    <label for="video">Video : </label>
                    <input type="file" name="video" id="video" accept="video/*">
                </div>

                <div class="form-group">
                    <label for="pays">Pays : </label>
                    <input type="text" name="pays" id="pays" class="form-control">
                </div>

                <h2>Ingrédients</h2>

                @php
                    $i = 1;
                @endphp
                <div id="ingredients">
                    <div class="form-group single_ingredient">
                        <label for="ingredient-{{ $i }}">Ingrédient n°{{ $i }}</label>
                        <input type="text" name="ingredient[]" id="ingredient-{{ $i }}" class="form-control">
                    </div>
                </div>

                <div class="button">
                    <button class="btn btn-primary" id="add_ingredient">Ajouter nouvel ingrédient</button>
                </div>

                <h2>Catégories</h2>

                @php
                    $j = 1;
                @endphp
                <div id="categories">
                    <div class="form-group">
                        <label for="categorie-{{ $j }}">Catégorie n°{{ $j }}</label>

                        <div class="row single_category div_{{ $j }}">
                            <select name="categorie[]" id="categorie-{{ $j }}" class="form-control col-md-8" required>
                                @foreach($categories as $c)
                                    <option value="{{ $c->nom }}">{{ $c->nom }}</option>
                                @endforeach
                            </select>
                            <div>
                                <button onclick="changeInput({{ $j }})" class="btn btn-warning new_categorie" id="n{{ $j }}">Nouvelle catégorie</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="button">
                    <button onclick="a({{ $categories }})" class="btn btn-primary" id="add_categorie">Ajouter nouvelle catégorie</button>
                </div>

                <h2>Etapes</h2>

                @php
                    $k = 1;
                @endphp
                <div id="etapes">
                    <div class="form-group single_etape">
                        <label for="etape-{{ $k }}">Etape n°{{ $k }}</label>
                        <textarea class="form-control" id="etape-{{ $k }}" name="etape[]"
                                  rows="5" cols="33">
                    </textarea>
                    </div>
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