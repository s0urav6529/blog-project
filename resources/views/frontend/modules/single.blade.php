@extends('frontend.layouts.master')

@section('page_title', $title)

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>{{ $title }}</h4>
                            <h2>{{ $sub_title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('contents')
    <div class="col-lg-12">
        <div class="blog-post">
            <div class="blog-thumb">
                <img src="{{ $post->photo }}" alt="">
            </div>
            <div class="down-content">
                <span class="text-success">{{ $post->category?->name }} <sub
                        class="text-warning">{{ $post->sub_category?->name }}</sub> </span>
                <a href="post-details.html">
                    <h4>{{ $post->title }}</h4>
                </a>
                <ul class="post-info">
                    <li><a href="#">{{ $post->user?->name }}</a></li>
                    <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                    <li><a href="#">10 Comments</a></li>
                </ul>
                <div class="post-decription">
                    <p>{!! $post->description !!}</p>
                </div>
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
    <div class="col-lg-12">
        <div class="sidebar-item comments">
            <div class="sidebar-heading">
                @php
                    $commentCount = $post->comment->count();
                @endphp
                <h2>{{ $commentCount }} {{ $commentCount > 1 ? 'comments' : 'comment' }} </h2>
            </div>
            <div class="content">
                <ul>
                    @foreach ($post->comment as $comment)
                        <li>
                            <div class="author-thumb">
                                <img src="{{ asset('frontend/assets/images/comment-author-01.jpg') }}" alt="">
                            </div>
                            <div class="right-content">
                                <h4>{{ $comment->user?->name }}<span>{{ $comment->created_at->format('M d, Y') }}</span>
                                </h4>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </li>
                        <li class="replied">
                            <div class="author-thumb">
                                <img src="{{ asset('frontend/assets/images/comment-author-02.jpg') }}" alt="">
                            </div>
                            <div class="right-content">
                                <h4>Thirteen Man<span>May 20, 2020</span></h4>
                                <p>In porta urna sed venenatis sollicitudin. Praesent urna sem, pulvinar vel mattis eget.
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar-item submit-comment">
            <div class="sidebar-heading">
                <h2>Your comment</h2>
            </div>
            <div class="content">
                <form id="comment" action="{{ route('comment.store') }}" method="post">
                    <div class="row">

                        <div class="col-lg-12">

                            <form action="" method="post">
                                @csrf

                                <input type="hidden" value="{{ $post->id }}" name="post_id">

                                <textarea name="comment" rows="6" placeholder="Type your comment"></textarea>

                                <button type="submit" id="form-submit" class="main-button">Submit</button>

                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--  notification message toast --}}
    @if (session('msg'))
        @push('js')
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: '{{ session('notification_color') }}',
                    toast: true,
                    title: '{{ session('msg') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>
        @endpush
    @endif

@endsection
