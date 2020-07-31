@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新規投稿</div>

                <div class="card-body">
                <form method="post" action="{{ url('/posts') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <textarea id="" class="form-control @error('body') is-invalid @enderror" name="body" rows="3" placeholder="投稿内容">{{ old('body') }}</textarea>

                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">画像</label>

                                <div class="col-md-6">
                                    <input type="file" name="photo" class="is-invalid">

                                    @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group text-center">
                        <div class="">
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
        @include('posts._posts')
    </div>
</div>
@endsection
