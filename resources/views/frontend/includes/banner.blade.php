<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">

            @foreach ($slider_post as $post)
                <div class="item">
                    <img src="{{ strpos($post->photo, 'https') === 0 ? $post->photo : asset('images/post/original/' . $post->photo) }}"
                        alt="">
                    <div class="item-content">
                        <div class="main-content">
                            <a href="{{ route('front.single', $post->slug) }}">
                                <h4>{{ Str::substr($post->title, 0, 30) . '...' }}</h4>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
