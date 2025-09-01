<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberMail;
use Illuminate\Support\Facades\Auth;

use App\Models\Blog;
use Illuminate\Support\Facades\Mail;

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

        //mail
        $subscribers = $blog->subscribers->filter(fn ($subscriber)=> $subscriber->id != Auth::id());

        $subscribers->each(function ($subscriber) use ($blog) {
            Mail::to($subscriber->email)->queue(new SubscriberMail($blog));
        });

        return redirect('/blogs/' . $blog->slug);
    }
}
