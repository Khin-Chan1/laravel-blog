<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <img src="https://creativecoder.s3.ap-southeast-1.amazonaws.com/blogs/GOLwpsybfhxH0DW8O6tRvpm4jCR6MZvDtGOFgjq0.jpg"
                    class="card-img-top" alt="..." />
                <h3 class="my-3">{{ $blog->title }}</h3>
                <div>
                    <div>
                        Author - <a href="/users/{{ $blog->author->username }}">{{ $blog->author->name }}</a>
                    </div>
                    <div>
                        <a href="/categories/{{ $blog->category->slug }}">
                            <span class="badge bg-primary">{{ $blog->category->name }}</span>
                        </a>
                    </div>
                    <div class="text-secondary">{{ $blog->created_at->diffForHumans() }}</div>
                </div>
                <p class="lh-md mt-3">
                    {{ $blog->body }}
                </p>
            </div>
        </div>
    </div>

    @auth
        <x-comment-form :blog='$blog' />
        @if ($blog->comments->count())
            <x-comments :comments="$blog->comments" />
        @endif
    @endauth

    @guest
        <p class="text-center">Please <a href="/login">login</a> to participate in this discussion.</p>
    @endguest

    <x-subscribe />
    <x-blog-you-may-like :randomBlogs="$randomBlogs" />
</x-layout>
