@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">投稿編集</div>

        <div class="card-body">
          <form method="post" action="{{ url('/posts', $post->id) }}">
            @csrf
            {{ method_field('patch') }}

            <div class="form-group row">
              <label for="body" class="col-md-3 col-form-label text-md-right">内容</label>

              <div class="col-md-9">
                <textarea id="" class="form-control @error('body') is-invalid @enderror" name="body">{{ old('body', $post->body) }}</textarea>

                @error('body')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  更新する
                </button>
              </div>
            </div>
          </form>
        </div>

        <div>
          <a href="{{ url('/posts', $post->id) }}">戻る</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
