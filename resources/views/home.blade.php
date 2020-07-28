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

                    <div class="form-group row">
                        <!-- <label for="introduction" class="col-md-4 col-form-label text-md-right">投稿する</label> -->

                        <!-- <div class="col-md-6"> -->
                        <div class="col-md-8">
                            <textarea id="" class="form-control @error('introduction') is-invalid @enderror" name="introduction" placeholder="投稿内容">
                                {{ old('introduction') }}
                            </textarea>

                            @error('introduction')
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
</div>
@endsection
