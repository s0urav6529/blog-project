@extends('backend.layouts.master')

@section('page_title', 'User')

@section('page_sub_title', 'List')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">User List</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover post-table">
                        <thead>
                            <tr>
                                <th>
                                    <center>SL</center>
                                </th>
                                <th>
                                    <center>Name</center>
                                </th>
                                <th>
                                    <center>Email</center>
                                </th>
                                <th>
                                    <center>
                                        <p>Division</p>
                                        <hr>
                                        <p>District</p>
                                        <hr>
                                        <p>Thana</p>
                                    </center>
                                </th>
                                <th>
                                    <center>Phone</center>
                                </th>
                                <th>
                                    <center>Gender</center>
                                </th>
                                <th>
                                    <center>Photo</center>
                                </th>
                                <th>
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="alert alert-warning mb-0" role="alert">
                                            <strong>No user Found !</strong>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <p>{{ $user->user_profile?->division->name ?? 'N/A' }}</p>
                                            <hr>
                                            <p>{{ $user->user_profile?->district->name ?? 'N/A' }}</p>
                                            <hr>
                                            <p>{{ $user->user_profile?->thana->name ?? 'N/A' }}</p>
                                        </td>
                                        <td>{{ $user->user_profile?->phone ?? 'N/A' }}</td>
                                        <td>{{ $user->user_profile?->gender ?? 'N/A' }}</td>
                                        <td><img class="img-thumbnail post-image"
                                                data-src="{{ $user->user_profile->photo == null ? asset('images/user/default_dp.jpg') : asset('images/user/' . $user->user_profile->photo) }}"
                                                src="{{ $user->user_profile->photo == null ? asset('images/user/default_dp.jpg') : asset('images/user/' . $user->user_profile->photo) }}">
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('user-profile.show', $user->user_profile->id) }}"><button
                                                        class="btn btn-info btn-sm"><i
                                                            class="fa-solid fa-eye"></i></button></a>

                                                <a href=""><button class="btn btn-warning btn-sm mx-1"><i
                                                            class="fa-solid fa-edit"></i></button></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{-- pagination open --}}
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $users->links() }}
                    </div>
                    {{-- pagination end --}}

                </div>
            </div>
        </div>
        {{-- @image modal open --}}
        <button id="img_show_btn" type="button" class="btn btn-primary d-none" data-bs-toggle="modal"
            data-bs-target="#image_show"></button>
        <div class="modal fade" id="image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="img-thumbnail" alt="Display image" id="display_image" />
                    </div>
                </div>
            </div>
        </div>
        {{-- @image model end --}}
    </div>


    @push('js')
        <script>
            /* @image modal open */
            $('.post-image').on('click', function() {

                let image = $(this).attr('data-src');
                $('#display_image').attr('src', image);
                $('#img_show_btn').trigger('click');

            })
        </script>
    @endpush

@endsection
