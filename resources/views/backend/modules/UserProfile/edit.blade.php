@extends('backend.layouts.master')

@section('page_title', 'Profile')

@section('page_sub_title', '')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">User Profile</h4>
                        <a href="{{ route('user-profile.index') }}"> <button class="btn btn-success btn-sm"><i
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

                    {!! Form::model($userProfile, ['method' => 'put', 'route' => ['user-profile.update', $userProfile->id]]) !!}

                    @include('backend.modules.UserProfile.form')

                    <div class="d-grid">
                        {!! Form::button('Change Role', ['type' => 'submit', 'class' => 'btn btn-success btn-sm mt-3']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <center>Photo</center>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        @php
                            $profilePhoto = $profile?->photo
                                ? asset('images/user/' . $profile->photo)
                                : asset('images/user/default_dp.jpg');
                        @endphp
                        <img class="img-thumbnail" src="{{ $profilePhoto }}" style="width: 400px; height: 250px;"
                            id="img_display">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    {{--  notification message toast --}}
    @if (session('msg'))
        @push('js')
            @include('backend.modules.common-script.toast')
        @endpush
    @endif
@endsection
