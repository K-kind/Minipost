@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">ユーザー詳細</div>

        <div class="card-body">
          <div>
            <h2>ユーザー名</h2>
            <p>{{ $user->name }}</p>
          </div>
          <div>
            <h2>自己紹介</h2>
            @if ($user->introduction)
              <p>{!! nl2br(e($user->introduction)) !!}</p>
            @else
              <p>自己紹介文は未登録です。</p>
            @endif
          </div>
        </div>

        <div>
          <a href="{{ action('UsersController@edit', $user) }}">編集</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
