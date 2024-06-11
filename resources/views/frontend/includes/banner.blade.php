<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">

            @foreach ($slider_post as $post)
                <div class="item">
                    <img src="{{ $post->photo }}" alt="">
                    <div class="item-content">
                        <div class="main-content">
                            <div class="meta-category">
                                <span>{{ $post->category?->name }} | </span>
                                <span>{{ $post->sub_category?->name }}</span>
                            </div>
                            <a href="{{ route('front.single', $post->slug) }}">
                                <h4>{{ Str::substr($post->title, 0, 30) . '...' }}</h4>
                            </a>
                            <ul class="post-info">
                                <li><a href="#">{{ $post->user?->name }}</a></li>
                                <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                                <li><a href="#">12 Comments</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
