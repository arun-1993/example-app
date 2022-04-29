<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

$posts = [
    1 => [
        'title' => 'Introduction to PHP',
        'content' => 'This is a short introduction to PHP',
        'is_new' => true,
        'has_comments' => true,
    ],
    2 => [
        'title' => 'Introduction to Laravel',
        'content' => 'This is a short introduction to Laravel',
        'is_new' => false,
    ],
];

Route::get('/', [HomeController::class, 'home'])->name('home.index');

Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

Route::get('/single', AboutController::class);

Route::resource('post', PostController::class)->only(['index', 'show']);

// Route::get('/post/{id}', function ($id) use ($posts) {
//     abort_if(!isset($posts[$id]), 404);

//     return view('post.show', [
//         'post' => $posts[$id],
//     ]);
// })->name('post.single');

// Route::get('/post', function () use ($posts) {
//     // dd(request()->all());
//     dd((int)request()->query('page', 1));
//     return view('post.index', [
//         'posts' => $posts,
//     ]);
// })->name('post.index');

// Route::get('/recent-posts/{days_ago?}', function ($daysago = 20) {
//     return "<h1>Posts from $daysago days ago</h1>";
// })->name('post.recent');

Route::prefix('/fun')->name('fun.')->group(function () use ($posts) {
    Route::get('/response', function () use ($posts) {
        return response($posts, 201)
            ->header('Content-type', 'application/json')
            ->cookie('MY_COOKIE', 'Arun Ravindran', 3600)
        ;
    })->name('response');
    
    Route::get('/redirect', function () {
        return redirect('/contact');
    })->name('redirect');
    
    Route::get('/back', function () {
        return back();
    })->name('back');
    
    Route::get('/named-route', function () {
        return redirect()->route('post.single', ['id' => 1]);
    })->name('named-route');
    
    Route::get('/away', function () {
        return redirect()->away('https://www.google.com');
    })->name('away');
    
    Route::get('/json', function () use ($posts) {
        return response()->json($posts);
    })->name('json');
    
    Route::get('/download', function () use ($posts) {
        return response()->download(public_path('/fritz-cola.jpg'), 'drink.jpg');
    })->name('download');
});