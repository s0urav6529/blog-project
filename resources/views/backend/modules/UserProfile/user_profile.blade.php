@extends('backend.layouts.master')

@section('page_title', 'Profile')

@section('page_sub_title', '')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <center>Profile Photo</center>
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
                    <div class="mb-3">
                        <form>
                            <input type="file" class="form-control" id="choose_file">
                            <button class="d-none" type="reset" id="reset"></button>
                        </form>
                    </div>
                    <div class="mb-2">
                        <img class="img-thumbnail d-none" style="width: 400px; height: 250px;" id="img_preview" />
                    </div>
                    <div class="mb-2">
                        <p class="text-danger" id="img_error_message"> </p>
                    </div>
                    <button class="btn btn-success btn-sm" id="img_upload_btn" style="width : 100px">Upload</button>
                </div>
            </div>
        </div>
    </div>

    {{-- for profile image upload --}}

    @push('js')
        {{-- axios cdn --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
            integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            /* photo preview before upload */
            let photo;
            $('#choose_file').on('change', function(e) {

                $('#img_error_message').text('');

                let file = e.target.files[0];
                let reader = new FileReader();

                reader.onloadend = () => {
                    photo = reader.result;
                    $('#img_preview').attr('src', photo).removeClass('d-none');
                }
                reader.readAsDataURL(file);
            });

            /* upload photo in folder & database */
            let isLoading = false;

            const HandleLoading = () => { //loading spinner

                if (isLoading) {
                    $('#img_upload_btn').html(`<div class="spinner-border spinner-border-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>`);
                } else {
                    $('#img_upload_btn').html('Upload');
                }
            }

            $('#img_upload_btn').on('click', function() {

                if (photo != undefined) {

                    isLoading = true;
                    HandleLoading();
                    axios.post(`${window.location.origin}/dashboard/upload-photo`, {
                        photo: photo
                    }).then(res => {

                        isLoading = false;
                        HandleLoading();

                        let response = res.data;
                        $('#reset').trigger('click');
                        $('#img_display').attr('src', response.photo);
                        $('#img_preview').attr('src', '').addClass('d-none');

                        Swal.fire({
                            position: "top-end",
                            icon: response.notification_color,
                            toast: true,
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    });
                } else {
                    isLoading = false;
                    HandleLoading();
                    $('#img_error_message').text('Please select a profile photo !');
                }
            });
        </script>
    @endpush
@endsection
