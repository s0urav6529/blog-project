@extends('backend.auth.layouts.master')

@section('page_title', 'Forgot Password')

@section('contents')
    {!! Form::open(['method' => 'post', 'route' => 'password.email']) !!}

    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, [
        'class' => $errors->has('email')
            ? 'is-invalid form-control form-control- mt-1'
            : 'form-control form-control-sm mt-1',
    ]) !!}
    @error('email')
        <p class="text-danger">{{ $message }}</p>
    @enderror

    <div class="d-grid">
        {!! Form::button('Reset Password', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-3']) !!}
    </div>

    {!! Form::close() !!}

    <p class="mt-2">Already registered? <a href="{{ route('login') }}">Login here</a></p>
    <p class="mt-2">Not registered? <a href="{{ route('register') }}">Register here</a></p>

@endsection
