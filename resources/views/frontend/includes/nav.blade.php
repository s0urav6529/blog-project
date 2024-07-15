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
                        <a class="nav-link" href="{{ route('front.all_post') }}">{{ __('All Post') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.about_us') }}">{{ __('About Us') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="switch-language">
            <form action="" id="switch_language_form" method="get">
                <select class="form-select form-select-sm" id="switch_language" name="lang">
                    <option value="en">Eng</option>
                    <option value="bn">Ban</option>
                </select>
            </form>
        </div>
        <div class="d-flex gap-2 me-2">
            @if (Auth::user() && Auth::user()?->role == \App\Models\User::USER)
                {{-- <button class="btn btn-danger"><a href="" class="text-white">Logout</a></button> --}}
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" id="notification-modal">Notifications</a></li>
                            <li><a class="dropdown-item" href="{{ route('post.create') }}">Create Post</a></li>
                            <li><a class="dropdown-item" href="{{ route('user-profile.create') }}">My Profile</a></li>
                            <li><a class="dropdown-item" href="">Activity Log</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li class="text-center">
                                {!! Form::open(['method' => 'post', 'route' => 'logout']) !!}
                                {!! Form::button('Logout', [
                                    'class' => 'btn btn-danger btn-sm',
                                    'onclick' => 'return confirm("Are you sure to logout?")',
                                    'type' => 'submit',
                                ]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </li>
                </ul>
            @else
                <button class="btn btn-warning"><a href="{{ route('register') }}"
                        class="text-white">Register</a></button>
                <button class="btn btn-primary"><a href="{{ route('login') }}" class="text-white">Login</a></button>
            @endif
        </div>
    </nav>

    {{--  notification modal start --}}
    <button id="notification-modal" type="button" class="btn btn-primary d-none" data-bs-toggle="modal"
        data-bs-target="#notification-show"></button>
    <div class="modal fade" id="notification-show" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="notifications-container">
                    {{-- content --}}
                </div>
            </div>
        </div>
    </div>
    {{--  notification modal end --}}

</header>

@push('js')
    {{-- axios cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
        integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const notifications = () => {

            axios.get(window.location.origin + '/my-notifications').then(res => {

                let data = res.data;

                let notificationsContainer = document.getElementById('notifications-container');
                notificationsContainer.innerHTML = '';

                let notificationElement = document.createElement('p');

                if (data.length === 0) {
                    notificationElement.textContent = 'No notification yet.';
                    notificationsContainer.appendChild(notificationElement);
                } else {
                    data.forEach(notification => {

                        notificationElement = document.createElement('p');

                        let anchorElement = document.createElement('a');
                        anchorElement.href = '/single-post/' + notification.post.slug + '#comments';

                        anchorElement.textContent = notification.post.title;

                        notificationElement.textContent = `${notification.user.name} commented on `;
                        notificationElement.appendChild(anchorElement);

                        notificationsContainer.appendChild(notificationElement);
                    });
                }
            });
        }

        /* For localization */
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

        /* For notifications */
        $('#notification-modal').on('click', function() {
            notifications();
            $('#notification-show').modal('show');
        })
    </script>
@endpush
