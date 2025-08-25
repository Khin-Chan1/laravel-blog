<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Blog;

class CommentController extends Controller
{
    public function store(Blog $blog) {
        request()->validate([
            'body' => 'required',
        ]);

        $blog->comments()->create(
            [
                'body' => request('body'),
                'user_id' => Auth::id(),
            ]
        );

        return back();
    }
}
