@extends('backend.auth.layouts.master')

@section('page_title', 'Reset Password')

@section('contents')
{!! Form::open(['method' => 'post', 'route' => 'password.store']) !!}


{!! Form::hidden('token', $request->route('token')) !!}

{!! Form::label('email', 'Email', ['class' => 'mt-2']) !!}
{!! Form::email('email', $request->email, ['class' => $errors->has('email') ? 'is-invalid form-control form-control-
mt-1' :
'form-control form-control-sm mt-1', 'placeholder' => 'Enter your email']) !!}
@error('email')
<p class="text-danger">{{ $message }}</p>
@enderror

{!! Form::label('password', 'Password', ['class' => 'mt-2']) !!}
{!! Form::password('password', ['class' => $errors->has('password') ? 'is-invalid form-control form-control- mt-1' :
'form-control form-control-sm mt-1', 'placeholder' => 'Enter new password'])
!!}
@error('password')
<p class="text-danger">{{ $message }}</p>
@enderror

{!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'mt-2']) !!}
{!! Form::password('password_confirmation', ['class' => $errors->has('password_confirmation') ? 'is-invalid form-control
form-control- mt-1' :
'form-control form-control-sm mt-1', 'placeholder' => 'Enter confirm password']) !!}
@error('password_confirmation')
<p class="text-danger">{{ $message }}</p>
@enderror

<div class="d-grid">
    {!! Form::button('Reset Password', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-3']) !!}
</div>

{!! Form::close() !!}

<p class="mt-2">Already registered? <a href="{{ route('login') }}">Login here</a></p>

@endsection