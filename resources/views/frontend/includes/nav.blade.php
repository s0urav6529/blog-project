<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front.index') }}">
                <h2>SM Blog<em>.</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('front.index') }}">{{ __('Home') }}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">{{ __('About Us') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.all_post') }}">{{ __('All Post') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="switch-language me-5">
            <form action="" id="switch_language_form" method="get">
                <select class="form-select form-select-sm" id="switch_language" name="lang">
                    <option value="en">Eng</option>
                    <option value="bn">Ban</option>
                </select>
            </form>
        </div>
    </nav>
</header>

@push('js')
    <script>
        if (localStorage.lang == 'bn') {
            $('#switch_language').val('bn');
        } else {
            $('#switch_language').val('en');
        }

        $('#switch_language').on('change', function(e) {

            e.preventDefault();

            localStorage.lang = $(this).val();

            $('#switch_language_form').submit();
        });
    </script>
@endpush
