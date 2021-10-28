<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FrontEndController;



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

Route::get('/', [FrontEndController::class, 'index'])->name('index');
//single blogpost
Route::get('/post/{slug}', [FrontEndController::class, 'singlePost'])->name('post.single');
Route::get('/category/{id}', [FrontEndController::class, 'category'])->name('category.single');
Route::get('/tag/{id}', [FrontEndController::class, 'tag'])->name('tag.single');
Route::get('/results', [FrontEndController::class, 'searchForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'],function () {
    
    Route::get('/posts/create', [PostsController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('post.store');
    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::get('/posts/edit{id}', [PostsController::class, 'edit'])->name('post.edit');
    Route::get('/posts/delete{id}', [PostsController::class, 'destroy'])->name('post.delete');
    Route::post('/posts/update{id}', [PostsController::class, 'update'])->name('post.update');
    Route::get('/posts/trashed', [PostsController::class, 'trashed'])->name('posts.trashed');
    Route::get('/posts/kill/{id}', [PostsController::class, 'kill'])->name('post.kill');
    Route::get('/posts/restore/{id}', [PostsController::class, 'restore'])->name('post.restore');

    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('category.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('category.store');
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('/categories/edit{id}', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::get('/categories/delete{id}', [CategoriesController::class, 'destroy'])->name('category.delete');
    Route::post('/categories/update{id}', [CategoriesController::class, 'update'])->name('category.update');


    Route::get('/tags/create', [TagsController::class, 'create'])->name('tag.create');
    Route::post('/tags/store', [TagsController::class, 'store'])->name('tag.store');
    Route::get('/tags', [TagsController::class, 'index'])->name('tags');
    Route::get('/tags/edit{id}', [TagsController::class, 'edit'])->name('tag.edit');
    Route::get('/tags/delete{id}', [TagsController::class, 'destroy'])->name('tag.delete');
    Route::post('/tags/update{id}', [TagsController::class, 'update'])->name('tag.update');

    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/users/create', [UsersController::class, 'create'])->name('user.create');
    Route::post('/users/store', [UsersController::class, 'store'])->name('user.store');
    Route::get('user/admin{id}', [UsersController::class, 'admin'])->name('user.admin');
    Route::get('user/notAdmin{id}', [UsersController::class, 'notAdmin'])->name('user.not.admin');
    Route::get('/users/delete{id}', [UsersController::class, 'destroy'])->name('user.delete');

    Route::get('/user/profile', [ProfilesController::class, 'index'])->name('user.profile');
    Route::post('/user/profile/update', [ProfilesController::class, 'update'])->name('user.profile.update');


    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});
 