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

    @php
        $commentCount = $post->comment->count();
    @endphp

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
                    <li><a href="">{{ $post->user?->name }}</a></li>
                    <li><a href="">{{ $post->created_at->format('M d, Y') }}</a></li>
                    <li><a href="">{{ $commentCount }} {{ $commentCount > 1 ? 'comments' : 'comment' }}</a></li>
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
                                        <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a>
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

                                @if (Auth::id())
                                    {!! Form::open(['method' => 'post', 'route' => 'comment.store']) !!}

                                    {!! Form::hidden('post_id', $post->id) !!}
                                    {!! Form::hidden('comment_id', $comment->id) !!}
                                    {!! Form::text('comment', null, [
                                        'class' => 'form-control form-control-sm mt-3',
                                        'placeholder' => 'Replay as ' . (Auth::user()->name ?? 'Anonymous'),
                                    ]) !!}
                                    {!! Form::button('<i class="fa-solid fa-reply"></i> Replay', [
                                        'class' => 'btn btn-light btn-sm mt-2',
                                        'type' => 'submit',
                                    ]) !!}

                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </li>
                        <div class="reply-count">
                            @php
                                $replyCount = $comment->reply->count();
                            @endphp
                            <p>{{ $replyCount }} {{ $replyCount > 1 ? 'replies' : 'reply' }} </p>
                        </div>
                        @foreach ($comment->reply as $reply)
                            <li class="replied">
                                <div class="author-thumb">
                                    <img src="{{ asset('frontend/assets/images/comment-author-02.jpg') }}" alt="">
                                </div>
                                <div class="right-content">
                                    <h4>{{ $reply->user?->name }}<span>{{ $reply->created_at->format('M d, Y') }}</span>
                                    </h4>
                                    <p>{{ $reply->comment }}</p>
                                </div>
                            </li>
                        @endforeach
                        <br>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar-item submit-comment">
            @if (Auth::id())
                <div class="sidebar-heading">
                    <h2>Write a comment</h2>
                </div>
                <div class="content">

                    <form id="comment" action="{{ route('comment.store') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $post->id }}" name="post_id">

                        <textarea name="comment" rows="6" placeholder="Comment as {{ Auth::user()->name ?? 'Anonymous' }}"></textarea>

                        <button type="submit" id="form-submit" class="main-button"><i class="fa-solid fa-comment">
                            </i> Comment</button>
                    </form>
                </div>
            @else
                <div class="d-flex align-items-center">
                    <a href="{{ route('login') }}" class="mr-2">
                        <h3>Login </h3>
                    </a>
                    <h3 class="mb-0 ms-2">to write a comment</h3>
                </div>
            @endif
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

    {{-- post count increase --}}
    @push('js')
        {{-- axios cdn --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
            integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            const callPostCounter = () => {
                axios.get(window.location.origin + '/post-count/' + {{ $post->id }});
            }

            setTimeout(() => {
                callPostCounter();
            }, 10000);
        </script>
    @endpush

@endsection
