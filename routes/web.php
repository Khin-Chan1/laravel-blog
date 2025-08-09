<?php

use Illuminate\Support\Facades\Route;
use App\Models\Blog;
use App\Models\Category;

Route::get('/', function () {
    return view('blogs', [
        'blogs' => Blog::with('category')->get()
    ]);
});

Route::get('/blogs/{blog:slug}', function (Blog $blog) {
    return view('blog', [
        'blog' => $blog
    ]);
})->where('blog', '[A-z\d\-_]+');

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('blogs', [
        'blogs' => $category->blogs
    ]);
});
