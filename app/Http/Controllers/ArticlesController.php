<?php


namespace App\Http\Controllers;

use App\Article_categorie;
use App\Categorie;
use App\Commentaire;
use App\Etape;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Article;

class ArticlesController extends Controller
{
    public function ArticlesInHomepage() {

        $tops_articles = Article::orderBy('likes', 'DESC')
            ->limit(4)
            ->get();

        $plats = Article::join('article_categorie', 'articles.id', '=', 'article_categorie.article_id')
            ->join('categories', 'categories.id', '=', 'article_categorie.categorie_id')
            ->select('articles.*')
            ->where('categories.nom', '=', 'Plats')
            ->get();

        return view('accueil', [
            "articles" => $tops_articles,
            "plats" => $plats
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ArticleById($id) {

        $article = Article::find($id);

        $ingredients = Ingredient::where('article_id', '=', $id)->get();

        $etapes = Etape::where('article_id', '=', $id)
            ->orderBy('id', 'ASC')
            ->get();

        $categorie = Categorie::join('article_categorie', 'article_categorie.categorie_id', '=', 'categories.id')
            ->join('articles', 'articles.id', '=', 'article_categorie.article_id')
            ->select('categories.nom')
            ->where('article_categorie.article_id', '=', $id)
            ->limit(1)
            ->get();

        foreach($categorie as $cat):
            $res = $cat->nom;
        endforeach;

        $suggestions = Article::join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'categories.id', '=', 'article_categorie.categorie_id')
            ->select('articles.*')
            ->where('articles.id', '<>', $id)
            ->where('categories.nom', '=', $res)
            ->get();

        /*$suggestions = Article::join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'categories.id', '=', 'article_categorie.categorie_id')
            ->select('articles.*')
            ->where('articles.id', '<>', $id)
            ->where(function($query)
            {
                $query->select('categories.nom')
                    ->from('categories')
                    ->join('article_categorie', 'article_categorie.categorie_id', '=', 'categories.id')
                    ->where('article_categorie.article_id', '=', '2')
                    ->limit(1);
            })
            ->get();*/

        $commentaires = Commentaire::where('article_id', '=', $id)->get();

        return view('article', [
            "article" => $article,
            "ingredients" => $ingredients,
            "etapes" => $etapes,
            "suggestions" => $suggestions,
            "commentaires" => $commentaires
        ]);
    }

    public function createCommentaire(Request $request, $id) {
        $commentaire = new Commentaire();

        $commentaire->nom = $request->input('lastname');
        $commentaire->prenom = $request->input('firstname');
        $commentaire->date = date('Y-m-d H:i:s');
        $commentaire->commentaire = $request->input('commentaire');
        $commentaire->article_id = $id;

        $commentaire->save();

        return redirect('article/' . $id);
    }

    public function backOffice() {
        $articles = Article::all();

        return view('backOffice', ["articles" => $articles]);
    }

    public function deleteArticle($id)
    {
        $del = Article::find($id)->delete();
        $del2 = Article_categorie::where('article_id', '=', $id)->delete();
        $del3 = Etape::where('article_id', '=', $id)->delete();
        $del4 = Ingredient::where('article_id', '=', $id)->delete();

        return redirect('bo');
    }

    public function edit($id) {
        $article = Article::find($id);
        $etapes = Etape::where('article_id', '=', $id)->orderBy('id')->get();
        $ingredients = Ingredient::where('article_id', '=', $id)->orderBy('id')->get();
        $categories = Categorie::join('article_categorie', 'article_categorie.categorie_id', '=', 'categories.id')
        ->where('article_categorie.article_id', '=', $id)
        ->orderBy('article_categorie.id')
        ->get();

        $list_categories = Categorie::all();
        return view('editArticle', [
            "article" => $article,
            "etapes" => $etapes,
            "ingredients" => $ingredients,
            "categories" => $categories,
            'list_categories' => $list_categories
        ]);
    }

    public function createArticle(Request $request) {
        $article = new Article();
        $ingredients = $request->ingredient;
        $etapes = $request->etape;
        $categories = $request->categorie;

        $article->nom = $request->input('name');
        $article->date = date('Y-m-d H:i:s');
        $article->difficulte = $request->input('difficulte');
        $article->temps_prepa = $request->input('temps_prepa');
        $article->temps_cuisson = $request->input('temps_cuisson');
        $article->portion = $request->input('portion');
        $article->description = $request->input('description');
        $article->image = 'images/' . $request->input('image');
        $article->video = 'video/' . $request->input('video');
        $article->pays = $request->input('pays');
        $article->likes = 0;

        $article->save();

        $idArticle = Article::max('id');

        foreach($ingredients as $i) :
            $ingredient = new Ingredient();
            $ingredient->nom = $i;
            $ingredient->article_id = $idArticle;
            $ingredient->save();
        endforeach;

        foreach($etapes as $e) :
            $etape = new Etape();
            $etape->nom = $e;
            $etape->article_id = $idArticle;
            $etape->save();
        endforeach;

        foreach($categories as $c) :
            $exist = Categorie::where('nom', '=', $c)->pluck('id')->first();
            if($exist != null) {

                $article_categorie = new Article_categorie();
                $article_categorie->article_id = $idArticle;
                $article_categorie->categorie_id = $exist;
                $article_categorie->save();
            } else {
                $cat = new Categorie();
                $cat->nom = $c;
                $cat->save();

                $maxIdCat = Categorie::max('id');
                $article_categorie = new Article_categorie();
                $article_categorie->article_id = $idArticle;
                $article_categorie->categorie_id = $maxIdCat;
                $article_categorie->save();
            }


        endforeach;

        return redirect('bo');
    }

    public function formNewArticle() {
        $categories = Categorie::all();

        return view('newArticle', ["categories" => $categories]);
    }

    public function updateArticle($id, Request $request) {
        $article = Article::find($id);
        $ingredients = $request->ingredient;
        $etapes = $request->etape;
        $categories = $request->categorie;

        $article->nom = $request->input('name');
        $article->difficulte = $request->input('difficulte');
        $article->temps_prepa = $request->input('temps_prepa');
        $article->temps_cuisson = $request->input('temps_cuisson');
        $article->portion = $request->input('portion');
        $article->description = $request->input('description');
        $article->pays = $request->input('pays');

        if($request->input('video') != null) {
            $article->video = 'video/' . $request->input('video');
        }

        $delIngredients = Ingredient::where('article_id', '=', $id)->delete();
        $delEtapes = Etape::where('article_id', '=', $id)->delete();
        $delCat = Article_categorie::where('article_id', '=', $id)->delete();

        foreach($ingredients as $ing):
            $ingredient = new Ingredient();
            $ingredient->nom = $ing;
            $ingredient->article_id = $id;
            $ingredient->save();
        endforeach;

        foreach($etapes as $et):
            $etape = new Etape();
            $etape->nom = $et;
            $etape->article_id = $id;
            $etape->save();
        endforeach;


        foreach($categories as $c) :
            $exist = Categorie::where('nom', '=', $c)->pluck('id')->first();
            if($exist != null) {

                $article_categorie = new Article_categorie();
                $article_categorie->article_id = $id;
                $article_categorie->categorie_id = $exist;
                $article_categorie->save();
            } else {
                $cat = new Categorie();
                $cat->nom = $c;
                $cat->save();

                $maxIdCat = Categorie::max('id');
                $article_categorie = new Article_categorie();
                $article_categorie->article_id = $id;
                $article_categorie->categorie_id = $maxIdCat;
                $article_categorie->save();
            }


        endforeach;

        $article->save();

        return redirect('bo');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request) {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $data_search = $request->input('data-search');
        $categories = $request->input('categories');
        $pays = $request->input('pays');

        //global $allArticles;
        if($data_search != null && $categories === 'all' && $pays === 'all' || $data_search != null && $categories === null && $pays === null) {

            return redirect('search/dataSearch/' . $data_search);

        } else if($categories != 'all' && $pays === 'all' && $data_search === null) {

            return redirect('search/categorie/' . $categories);

        } else if($categories === 'all' && $pays != 'all' && $data_search === null) {

            return redirect('search/pays/' . $pays);

        } else if($categories != 'all' && $pays === 'all' && $data_search != null) {

            return redirect('search/dataSearchCategorie/' . $data_search . '/' . $categories);

        } else if($categories != 'all' && $pays != 'all' && $data_search === null) {

            return redirect('search/categoriePays/' . $categories . '/' . $pays);

        } else if($categories === 'all' && $pays != 'all' && $data_search != null) {

            return redirect('search/paysDataSearch/' . $data_search . '/' . $pays);

        } else if($categories != 'all' && $pays != 'all' && $data_search != null) {

            return redirect('threeQueries/' . $data_search . '/' . $categories . '/' . $pays);

        } else {
            return redirect('search');
        }

        /*return view('search', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);*/

    }

    public function searchByDataSearch($data) {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::where('nom', 'like', "%$data%")
            ->orWhere('description', 'like', "%$data%")
            ->orWhere('pays', 'like', "%$data%")
            ->distinct()
            ->get();

        return view('search', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function searchByCategorie($data) {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = $allArticles = Article::join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'categories.id', '=', 'article_categorie.categorie_id')
            ->select('articles.*')
            ->where('categories.nom', '=', "$data")
            ->get();

        return view('search', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function searchByPays($data) {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = $allArticles = Article::where('pays', '=', $data)
            ->get();

        return view('search', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function searchByDataSearchCategorie($data, $cat) {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::select('articles.*')
            ->join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'article_categorie.categorie_id', '=', 'categories.id')
            ->where('categories.nom', '=', $cat)
            ->where('articles.nom', 'like', "%$data%")
            ->orWhere('articles.description', '=', "%$data%")
            ->get();

        return view('search', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function searchByCategoriePays($cat, $pays) {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::select('articles.*')
            ->join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'article_categorie.categorie_id', '=', 'categories.id')
            ->where('categories.nom', '=', $cat)
            ->where('articles.pays', '=', $pays)
            ->get();

        return view('search', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function searchByDataSearchPays($data, $pays) {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::select('articles.*')
            ->where('articles.pays', '=', $pays)
            ->where('articles.nom', 'like', "%$data%")
            ->orWhere('articles.description', 'like', "%$data%")
            ->get();

        return view('search', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function searchByThreeQueries($data, $cat, $pays) {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::distinct()->select('articles.*')
            ->join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'article_categorie.categorie_id', '=', 'categories.id')
            ->where('articles.pays', '=', $pays)
            ->where('categories.nom', '=', $cat)
            ->where('articles.nom', 'like', "%$data%")
            ->orWhere('articles.description', 'like', "%$data%")
            ->get();

        return view('search', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function getSearch() {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::all();

        return view('getSearch', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function getArticlesEntree() {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::select('articles.*')
            ->join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'article_categorie.categorie_id', '=', 'categories.id')
            ->where('categories.nom', '=', 'Entrées')
            ->get();

        return view('getSearch', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);

    }

    public function getArticlesPlats() {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::select('articles.*')
            ->join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'article_categorie.categorie_id', '=', 'categories.id')
            ->where('categories.nom', '=', 'Plâts')
            ->get();

        return view('getSearch', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

    public function getArticlesDesserts() {
        $allCategories = Categorie::all();

        $allPays = Article::distinct()->get(['pays']);

        $allArticles = Article::select('articles.*')
            ->join('article_categorie', 'article_categorie.article_id', '=', 'articles.id')
            ->join('categories', 'article_categorie.categorie_id', '=', 'categories.id')
            ->where('categories.nom', '=', 'Desserts')
            ->get();

        return view('getSearch', [
            "allCategories" => $allCategories,
            "allPays" => $allPays,
            "article" => $allArticles
        ]);
    }

}
/*
 *
 *
 */
