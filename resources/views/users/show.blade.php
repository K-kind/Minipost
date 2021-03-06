@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">ユーザー情報</div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-3 text-center">
              <img src="@if ($user->image_filename) {{ url('storage/profile_images/' . $user->image_filename) }} @else {{ url('/images/no_image.png') }} @endif" width="80px" height="80px">
            </div>
            <div class="col-md-9">
              <h2>{{ $user->name }}</h2>
              <div>
                @if ($user->introduction)
                  <p>{!! nl2br(e($user->introduction)) !!}</p>
                @else
                  <p>自己紹介文は未登録です。</p>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div>
          @if ($is_followed && !$is_myself)
            <form method="post" action="{{ action('FollowController@destroy', $user) }}">
              @csrf
              {{ method_field('delete') }}
              <input type="submit" value="フォローを外す">
            </form>
          @elseif (!$is_myself)
            <form method="post" action="{{ action('FollowController@store', $user) }}">
              @csrf
              <input type="submit" value="フォローする">
            </form>
          @endif
          <a href="{{ action('FollowController@index', [$user, 'followings']) }}">{{ $following_count }}<span>フォロー中</span></a>
          <a href="{{ action('FollowController@index', [$user, 'followers']) }}">{{ $follower_count }}<span>フォロワー</span></a>
        </div>

        @if ($user->id === Auth::id())
          <div>
            <a href="{{ action('UsersController@edit', $user) }}" class="btn btn-success">編集</a>
            <a href="#" class="del btn btn-danger" data-id="{{ $user->id }}">退会</a>
            <form method="post" action="{{ action('UsersController@destroy', $user) }}" id="form-{{ $user->id }}">
              @csrf
              {{ method_field('delete') }}
            </form>
          </div>
        @endif
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-4">
    @include('posts._posts')
  </div>
</div>
@endsection
