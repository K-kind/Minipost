<div class="col-md-8">
    <div class="card">
        <div class="card-header">投稿一覧</div>
            <div class="card-body px-5">
                <ul class="px-0">
                    @foreach ($posts as $post)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <a href="{{ url('/users', $post->user) }}">
                                            {{ $post->user->name }}
                                            <div class="text-center mt-1">
                                                <img src="@if ($post->user->image_filename) {{ url('storage/profile_images/' . $post->user->image_filename) }} @else {{ url('/images/no_image.png') }} @endif" width="24px" height="24px">
                                            </div>
                                        </a>
                                    </div>
                                    <a class="col-md-9" href="{{ url('/posts', $post) }}">
                                        {!! nl2br(e($post->body)) !!}
                                    </a>
                                    @if ($post->image_filename)
                                        <div class="col-md-12 text-center">
                                            <img src="{{ url('storage/post_images/' . $post->image_filename) }}" width="240px">
                                        </div>
                                    @endif
                                    <div class="col-md-12 text-right">
                                        <p>{{ $post->created_at->format('Y/m/d H:i') }}</p>
                                        <form method="post" action="{{ url('/posts/'.$post->id.'/likes') }}" class="d-inline-block mr-2">
                                            @csrf
                                            @if ($post->likes->where('user_id', Auth::id())->first())
                                                {{ method_field('delete') }}
                                                <input type="submit" value="いいね済み {{ $post->likes->count() }}">
                                            @else
                                                <input type="submit" value="いいね {{ $post->likes->count() }}">
                                            @endif
                                        </form>
                                        <span>コメント {{ $post->comments->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8 mt-4">
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
