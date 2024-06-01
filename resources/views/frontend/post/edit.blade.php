@extends('frontend.layout.master')
@section('content')
    <div class="main-wrapper pt-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 order-9">
                    <aside class="widget-area">
                        <!-- widget single item start -->
                        <div class="card widget-item">
                            <h4 class="widget-title">Edit post</h4>
                            <label for="">your post</label>
                            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <textarea name='body' class="form-control mb-5">{{ $post->body }}</textarea>
                                @if (isset($post->image->name))
                                    <div><label for="" class="mb-2">post photo</label></div>
                                    <img src="{{ asset('uploads/' . $post->image->name) }}" width="70%" class="m-4">
                                    <a href="{{ route('delete.image', $post->image->id) }}"
                                        class="btn btn-danger mx-2">delete image</a>
                                @endif
                                <input type="file" name='post_image' class="form-control my-3">
                                <button type="submit" class="btn btn-primary mx-2">Save</button>
                                <a href="{{ url('/') }}" class="btn btn-danger mx-2">Cancel</a>
                            </form>
                        </div>
                        <!-- widget single item end -->
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
