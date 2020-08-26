<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ArticlesController@ArticlesInHomepage');

Route::get('/article/{id}', 'ArticlesController@articleById');

Route::post('/article/{id}', 'ArticlesController@createCommentaire');

Route::get('/bo', 'ArticlesController@backOffice');

Route::delete('/bo/delete/{id}', 'articlesController@deleteArticle');

Route::get('/bo/edit/{id}', 'ArticlesController@edit');

Route::get('bo/new', 'ArticlesController@formNewArticle');

Route::post('/bo', 'ArticlesController@createArticle');

Route::post('/update/{id}', 'ArticlesController@updateArticle');

Route::post('search', 'ArticlesController@search');

Route::get('search', 'ArticlesController@getSearch');

Route::get('search/dataSearch/{data}', 'ArticlesController@searchByDataSearch');

Route::get('search/categorie/{data}', 'ArticlesController@searchByCategorie');

Route::get('search/pays/{data}', 'ArticlesController@searchByPays');

Route::get('search/dataSearchCategorie/{data}/{cat}', 'ArticlesController@searchByDataSearchCategorie');

Route::get('search/categoriePays/{cat}/{pays}', 'ArticlesController@searchByCategoriePays');

Route::get('search/paysDataSearch/{data}/{pays}', 'ArticlesController@searchByDataSearchPays');

Route::get('threeQueries/{data}/{cat}/{pays}', 'ArticlesController@searchByThreeQueries');

Route::get('search/unique/entree', 'ArticlesController@getArticlesEntree');

Route::get('search/unique/plats', 'ArticlesController@getArticlesPlats');

Route::get('search/unique/desserts', 'ArticlesController@getArticlesDesserts');

