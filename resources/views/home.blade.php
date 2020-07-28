@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新規投稿</div>

                <div class="card-body">
                <form method="post" action="{{ url('/posts') }}">
                    @csrf

                    <div class="form-group row justify-content-center">
                        <!-- <label for="body" class="col-md-4 col-form-label text-md-right">投稿する</label> -->

                        <!-- <div class="col-md-6"> -->
                        <div class="col-md-8">
                            <textarea id="" class="form-control @error('body') is-invalid @enderror" name="body" placeholder="投稿内容">{{ old('body') }}</textarea>

                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                投稿する
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">投稿一覧</div>
                    <div class="card-body">
                        <ul>
                            @foreach ($posts as $post)
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
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
