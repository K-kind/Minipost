<div class="col-md-8">
    <div class="card">
        <div class="card-header">投稿一覧</div>
            <div class="card-body">
                <ul>
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
                                    <div class="col-md-12 text-right">
                                        <span>{{ $post->created_at->format('Y/m/d H:i') }}</span>
                                        @if ($post->likes->where('user_id', Auth::id())->first())
                                            <a href="#" class="like" data-id="{{ $post->id }}">
                                                いいね済み
                                                <span>{{ $post->likes->count() }}</span>
                                            </a>
                                            <form method="post" action="{{ action('LikesController@destroy', $post) }}" id="form-{{ $post->id }}">
                                                @csrf
                                                {{ method_field('delete') }}
                                            </form>
                                        @else
                                            <a href="#" class="like" data-id="{{ $post->id }}">
                                                いいね
                                                <span>{{ $post->likes->count() }}</span>
                                            </a>
                                            <form method="post" action="{{ action('LikesController@store', $post) }}" id="form-{{ $post->id }}">
                                                @csrf
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
