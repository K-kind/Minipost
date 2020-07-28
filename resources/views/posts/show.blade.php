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
                <div class="col-md-3">
                  <a href="{{ url('/users', $post->user) }}">{{ $post->user->name }}</a>
                </div>
                <a class="col-md-9" href="{{ url('/posts', $post) }}">{!! nl2br(e($post->body)) !!}</a>
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
