@extends('layouts.app')

@section('content')
<h1>
  <!-- <a href="{{ url('/') }}" class="header-menu">Back</a> -->
  <!-- {{ $post->title }} -->
  ユーザー詳細
</h1>
<p>{{ $user->name }}</p>
<p>{!! nl2br(e($user->introduction)) !!}</p>

@endsection
