@extends('backend.layouts.master')

@section('page_title', 'User Profile')

@section('page_sub_title', 'Details')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Details</h4>
                        <a href="{{ route('user-profile.index') }}" class="btn btn-success btn-sm mr-2"><i
                                class="fa-solid fa-left-long mx-1"></i>Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $userProfile->user?->name }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>{{ $userProfile->user?->email }}</td>
                            </tr>

                            <tr>
                                <th>Phone</th>
                                <td>{{ $userProfile->phone }}</td>
                            </tr>

                            <tr>
                                <th>Division</th>
                                <td>{{ $userProfile->division?->name }}</td>
                            </tr>

                            <tr>
                                <th>District</th>
                                <td>{{ $userProfile->district?->name }}</td>
                            </tr>

                            <tr>
                                <th>Thana</th>
                                <td>{{ $userProfile->thana?->name }}</td>
                            </tr>

                            <tr>
                                <th>Gender</th>
                                <td>{{ $userProfile->gender }}</td>
                            </tr>

                            <tr>
                                <th>Photo</th>
                                <td>
                                    <img
                                        src="{{ $userProfile->photo == null ? asset('images/user/default_dp.jpg') : asset('images/user/' . $userProfile->photo) }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            //@sweetalart during delete
            $('.delete').on('click', function() {
                let id = $(this).attr('data-id');
                Swal.fire({
                    title: "Are you sure to delete?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#form_${id}`).submit()
                    }
                });
            });
        </script>
    @endpush
@endsection
