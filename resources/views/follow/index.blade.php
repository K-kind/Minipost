@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>
        <a href="{{ url('/users', $user) }}">{{ $user->name }}</a>
      </h2>
      <div>
        <a href="{{ action('FollowController@index', [$user, 'followings']) }}">
          {{ $following_count }}
          <span>フォロー中</span>
        </a>
        <a href="{{ action('FollowController@index', [$user, 'followers']) }}">
          {{ $follower_count }}
          <span>フォロワー</span>
        </a>
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-4">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          @if ($user->id === Auth::id())
            あなた
          @else
            {{ $user->name }}
          @endif
          @if ($type === 'followings')
            がフォロー中のユーザー
          @else
            のフォロワー
          @endif
        </div>
        <div class="card-body mx-4">
          <ul class="px-0">
            @foreach ($users as $user)
              <div class="card mb-2">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 text-center">
                      <a href="{{ url('/users', $user) }}">
                        <img src="@if ($user->image_filename) {{ url('storage/profile_images/' . $user->image_filename) }} @else {{ url('/images/no_image.png') }} @endif" width="42px" height="42px">
                      </a>
                    </div>
                    <div class="col-md-9 ">
                      <div>
                        <a href="{{ url('/users', $user) }}">{{ $user->name }}</a>
                        @if ($user->id !== Auth::id())
                          <form method="post" action="{{ action('FollowController@destroy', $user) }}" class="d-inline-block float-right">
                            @csrf
                            @if ($user->isFollowed(Auth::id()))
                              {{ method_field('delete') }}
                              <input type="submit" value="フォローを外す">
                            @else
                              <input type="submit" value="フォローする">
                            @endif
                          </form>
                        @endif
                      </div>
                      <div>
                        @if ($user->introduction)
                          <p>{{ $user->introduction }}</p>
                        @else
                          <p>自己紹介文は未登録です。</p>
                        @endif
                      </div>
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
        {{ $users->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
