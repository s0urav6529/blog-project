@extends('backend.auth.layouts.master')

@section('page_title', 'Login')

@section('contents')
{!! Form::open(['method' => 'post', 'route' => 'login']) !!}

{!! Form::label('email', 'Email') !!}
{!! Form::email('email', null, ['class' => $errors->has('email') ? 'is-invalid form-control form-control- mt-1' :
'form-control form-control-sm mt-1']) !!}
@error('email')
<p class="text-danger">{{ $message }}</p>
@enderror

{!! Form::label('password', 'Password', ['class' => 'mt-2']) !!}
{!! Form::password('password', ['class' => $errors->has('password') ? 'is-invalid form-control form-control- mt-1' :
'form-control form-control-sm mt-1']) !!}
@error('email')
<p class="text-danger">{{ $message }}</p>
@enderror

<div class="d-grid">
    {!! Form::button('Login', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-3']) !!}
</div>

{!! Form::close() !!}

<p class="mt-2">Forget password? <a href="{{ route('password.request') }}">Reset here</a></p>
<p class="mt-2">Not registered? <a href="{{ route('register') }}">Register here</a></p>

@endsection