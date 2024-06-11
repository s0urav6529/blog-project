@extends('frontend.layouts.master')

@section('page_title', 'Home')

@section('banner')
    @include('frontend.includes.banner')
@endsection

@section('contents')

    @if ($post_data->isEmpty())
        <div class="alert alert-danger" role="alert">
            <p>Post not available</p>
        </div>
    @else
        @foreach ($post_data as $post)
            <div class="col-lg-12">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="{{ $post->photo }}" alt="">
                    </div>
                    <div class="down-content">
                        <span>{{ $post->category?->name }} | </span>
                        <span>{{ $post->sub_category?->name }}</span>
                        <a href="{{ route('front.single', $post->slug) }}">
                            <h4>{{ $post->title }}</h4>
                        </a>
                        <ul class="post-info">
                            <li><a href="#">{{ $post->user?->name }}</a></li>
                            <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                            <li><a href="#">12 Comments</a></li>
                        </ul>
                        <p>{{ strip_tags(Str::substr($post->description, 0, 400)) . '..' }}
                            <a href="{{ route('front.single', $post->slug) }}"><button class="read-more-button">Read
                                    more</button></a>
                        </p>
                        <div class="post-options">
                            <div class="row">
                                <div class="col-6">
                                    <ul class="post-tags">
                                        <li><i class="fa fa-tags"></i></li>
                                        @if ($post->tag->isEmpty())
                                            <div class="alert alert-danger" role="alert">
                                                <p>No tag found.</p>
                                            </div>
                                        @else
                                            @foreach ($post->tag as $tag)
                                                <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a>,
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="post-share">
                                        <li><i class="fa fa-share-alt"></i></li>
                                        <li><a href="#">Facebook</a>,</li>
                                        <li><a href="#"> Twitter</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


    <div class="col-lg-12">
        <div class="main-button">
            <a href="blog.html">View All Posts</a>
        </div>
    </div>
@endsection
