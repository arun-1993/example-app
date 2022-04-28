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

Route::view('/', 'home.index')->name('home.index');

Route::view('/contact', 'home.contact')->name('home.contact');

Route::get('/post/{id}', function ($id) use ($posts) {
    abort_if(!isset($posts[$id]), 404);

    return view('post.show', [
        'post' => $posts[$id],
    ]);
})->name('post.single');

Route::get('/post', function () use ($posts) {
    return view('post.index', [
        'posts' => $posts,
    ]);
})->name('post.index');

Route::get('/recent-posts/{days_ago?}', function ($daysago = 20) {
    return "<h1>Posts from $daysago days ago</h1>";
})->name('post.recent');