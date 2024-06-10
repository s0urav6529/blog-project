@extends('backend.layouts.master')

@section('page_title', 'Post')

@section('page_sub_title', 'List')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Post List</h4>
                        <a href="{{ route('post.create') }}"> <button class="btn btn-success btn-sm"><i
                                    class="fa-solid fa-plus mx-1"></i>Add post
                            </button></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover post-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>
                                    <p>Category</p>
                                    <hr>
                                    <p>Sub-category</p>
                                </th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Tag</th>
                                <th>
                                    <p>Status</p>
                                    <hr>
                                    <p>Is Aprroved</p>
                                    <hr>
                                    <p>Created By</p>
                                </th>
                                <th>
                                    <p>Created At</p>
                                    <hr>
                                    <p>Updated At</p>
                                </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($post_data->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <div class="alert alert-warning mb-0" role="alert">
                                            <strong>No Post Found !</strong>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($post_data as $index => $post)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            <p><a href="{{ route('category.show', $post->category_id) }}"
                                                    class="text-decoration-none text-success">{{ $post->category?->name }}</a>

                                            </p>
                                            <hr>
                                            <p><a href="{{ route('sub-category.show', $post->sub_category_id) }}"
                                                    class="text-decoration-none ">{{ $post->sub_category?->name }}</a>
                                            </p>
                                        </td>
                                        <td>{{ substr(strip_tags($post->description), 0, 70) }}...</td>

                                        <td>
                                            <img class="img-thumbnail post-image" data-src="{{ $post->photo }}"
                                                src="{{ $post->photo }}" alt="">
                                        </td>
                                        <td>
                                            @php
                                                $colors = [
                                                    'btn-primary',
                                                    'btn-secondary',
                                                    'btn-success',
                                                    'btn-danger',
                                                    'btn-warning',
                                                    'btn-info',
                                                    'btn-dark',
                                                ];
                                            @endphp
                                            @foreach ($post->tag as $tag)
                                                <a href="{{ route('tag.show', $tag->id) }}"><button
                                                        class="btn {{ $colors[random_int(0, 6)] }} btn-sm mb-1">{{ $tag->name }}</button></a>
                                            @endforeach
                                        </td>
                                        <td>
                                            <p class="{{ $post->status == 1 ? 'text-success' : 'text-danger' }}">
                                                {{ $post->status == 1 ? 'Published' : 'Not Published' }}</p>
                                            <hr>
                                            <p class="{{ $post->is_approved == 1 ? 'text-success' : 'text-danger' }}">
                                                {{ $post->is_approved == 1 ? 'Aprroved' : 'Not Aprroved' }}</p>
                                            <hr>
                                            <p>{{ $post->user?->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $post->created_at->toDateTimeString() }}</p>
                                            <hr>
                                            <p>{{ $post->created_at != $post->updated_at ? $post->updated_at->toDateTimeString() : 'Not updated' }}
                                            </p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('post.show', $post->id) }}"><button
                                                        class="btn btn-info btn-sm"><i
                                                            class="fa-solid fa-eye"></i></button></a>

                                                <a href="{{ route('post.edit', $post->id) }}"><button
                                                        class="btn btn-warning btn-sm mx-1"><i
                                                            class="fa-solid fa-edit"></i></button></a>

                                                {!! Form::open([
                                                    'method' => 'delete',
                                                    'id' => 'form_' . $post->id,
                                                    'route' => ['post.destroy', $post->id],
                                                ]) !!}

                                                {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                                    'type' => 'button',
                                                    'data-id' => $post->id,
                                                    'class' => 'delete btn btn-danger btn-sm',
                                                ]) !!}

                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{-- pagination open --}}
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $post_data->links() }}
                    </div>
                    {{-- pagination end --}}

                </div>
            </div>
        </div>

        {{-- @image modal open --}}
        <button id="img_show_btn" type="button" class="btn btn-primary d-none" data-bs-toggle="modal"
            data-bs-target="#image_show"></button>
        <div class="modal fade" id="image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Blog Image</h5>
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

    @push('js')
        <script>
            /* @sweetalart during delete */
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

            /* @image modal open */
            $('.post-image').on('click', function() {

                let image = $(this).attr('data-src');
                $('#display_image').attr('src', image);
                $('#img_show_btn').trigger('click');

            })
        </script>
    @endpush
@endsection
