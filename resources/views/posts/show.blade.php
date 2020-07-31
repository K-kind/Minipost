@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">投稿詳細</div>

        <div class="card-body">
          <div class="card mb-2">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 text-center">
                  <a href="{{ url('/users', $post->user) }}">
                    {{ $post->user->name }}
                    <br>
                    <img src="@if ($post->user->image_filename) {{ url('storage/profile_images/' . $post->user->image_filename) }} @else {{ url('/images/no_image.png') }} @endif" class="mt-2" width="24px" height="24px">
                  </a>
                </div>
                <div class="col-md-9">
                  <a class="" href="{{ url('/posts', $post) }}">{!! nl2br(e($post->body)) !!}</a>
                  <!-- <a class="col-md-9" href="{{ url('/posts', $post) }}">{!! nl2br(e($post->body)) !!}</a> -->
                  @if ($post->image_filename)
                      <div class="mt-2 text-center">
                          <img src="{{ url('storage/post_images/' . $post->image_filename) }}" width="240px">
                      </div>
                  @endif
                </div>
                <div class="col-md-12 text-right mt-2">
                    <span>{{ $post->created_at->format('Y/m/d H:i') }}</span>
                    <form method="post" action="{{ url('/posts/'.$post->id.'/likes') }}">
                        @csrf
                        @if ($post->likes->where('user_id', Auth::id())->first())
                            {{ method_field('delete') }}
                            <input type="submit" value="いいね済み {{ $post->likes->count() }}">
                        @else
                            <input type="submit" value="いいね {{ $post->likes->count() }}">
                        @endif
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <a href="{{ action('PostsController@edit', $post) }}" class="btn btn-success">編集</a>
          <a href="#" class="del btn btn-danger" data-id="{{ $post->id }}">削除</a>
          <form method="post" action="{{ action('PostsController@destroy', $post) }}" id="form-{{ $post->id }}">
            @csrf
            {{ method_field('delete') }}
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
