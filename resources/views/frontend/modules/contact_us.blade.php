@extends('frontend.layouts.master')

@section('page_title', $title)

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h2>{{ $sub_title }}</h2>
                            <h4>{{ $title }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('contents')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Contact Us</h4>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['method' => 'post']) !!}
                {!! Form::text('name', null, ['class' => ' form-control mt-3', 'placeholder' => 'Enter your name']) !!}
                {!! Form::email('email', null, ['class' => ' form-control mt-3', 'placeholder' => 'Enter your email address']) !!}
                {!! Form::text('phone', null, ['class' => ' form-control mt-3', 'placeholder' => 'Enter your phone number']) !!}
                {!! Form::text('subject', null, ['class' => ' form-control mt-3', 'placeholder' => 'Enter subject']) !!}
                {!! Form::textarea('message', null, [
                    'class' => ' form-control mt-3',
                    'placeholder' => 'write message...',
                    'rows' => 5,
                ]) !!}
                {!! Form::button('Send Message', ['class' => 'btn btn-success mt-3', 'type' => 'submit']) !!}
                {!! Form::close() !!}
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
