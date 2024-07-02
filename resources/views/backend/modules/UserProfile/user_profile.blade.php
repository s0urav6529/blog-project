@extends('backend.layouts.master')

@section('page_title', 'Profile')

@section('page_sub_title', '')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Profile</h4>
                        <a href="{{ route('back.index') }}"> <button class="btn btn-success btn-sm"><i
                                    class="fa-solid fa-left-long mx-1"></i>Back
                            </button></a>
                    </div>
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

                    {!! Form::model($profile, ['method' => 'post', 'route' => 'user-profile.store']) !!}

                    @include('backend.modules.UserProfile.form')

                    <div class="d-grid">
                        {!! Form::button('Update Profile', ['type' => 'submit', 'class' => 'btn btn-success btn-sm mt-3']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <center>Profile Photo</center>
                    </h4>
                </div>
                <div class="card-body">
                    <input type="file">
                </div>
            </div>
        </div>
    </div>

@endsection
