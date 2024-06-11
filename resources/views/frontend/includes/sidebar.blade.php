<div class="col-lg-4">
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="#">
                        <input type="text" name="q" class="searchText" placeholder="type to search..."
                            autocomplete="on">
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                        <h2>Recent Posts</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <li><a href="post-details.html">
                                    <h5>Vestibulum id turpis porttitor sapien facilisis scelerisque</h5>
                                    <span>May 31, 2020</span>
                                </a></li>
                            <li><a href="post-details.html">
                                    <h5>Suspendisse et metus nec libero ultrices varius eget in risus</h5>
                                    <span>May 28, 2020</span>
                                </a></li>
                            <li><a href="post-details.html">
                                    <h5>Swag hella echo park leggings, shaman cornhole ethical coloring</h5>
                                    <span>May 14, 2020</span>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                        <h2>Categories</h2>
                    </div>
                    <div class="content">
                        <ul>

                            @if ($category_data->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    <p>Categories you are looking for is currently not available. Please check again
                                        later.</p>
                                </div>
                            @else
                                @foreach ($category_data as $category)
                                    <li><a href="{{ route('front.category', $category->slug) }}">-
                                            {{ $category->name }}</a>
                                        <ul class="sidebar-subcategory">
                                            @foreach ($category->sub_category as $sub_category)
                                                <li><a
                                                        href="{{ route('front.sub_category', [$category->slug, $sub_category->slug]) }}">-
                                                        {{ $sub_category->name }}</a>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                        <h2>Tag Clouds</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @if ($tag_data->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    <p>Tag you are looking for is currently not available. Please check again
                                        later.</p>
                                </div>
                            @else
                                @foreach ($tag_data as $tag)
                                    <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
