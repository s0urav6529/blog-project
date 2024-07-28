@extends('backend.layouts.master')

@section('page_title', 'Post')

@section('page_sub_title', 'Details')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-truncate card-header-title">
                            <h4 class="mb-0 text-truncate">{{ $post->title }}</h4>
                        </div>
                        <a href="{{ route('post.index') }}" class="btn btn-success btn-sm ml-2">
                            <i class="fa-solid fa-left-long mx-1"></i>Back
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th class="wider-th-post">ID</th>
                                <td>{{ $post->id }}</td>
                            </tr>

                            <tr>
                                <th>Post Title</th>
                                <td>{{ $post->title }}</td>
                            </tr>

                            <tr>
                                <th>Post Slug</th>
                                <td>{{ $post->slug }}</td>
                            </tr>

                            <tr>
                                <th>Category</th>
                                <td>{{ $post->category?->name }}</td>
                            </tr>

                            <tr>
                                <th>Sub-category</th>
                                <td>{{ $post->sub_category?->name }}</td>
                            </tr>

                            <tr>
                                <th>Description</th>
                                <td class="post-table-description">{!! $post->description !!}</td>
                            </tr>

                            <tr>
                                <th>Created By</th>
                                <td>{{ $post->user?->name }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td class="{{ $post->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $post->status == 1 ? 'Published' : 'Not Published' }}
                            </tr>

                            <tr>
                                <th>Is Approved</th>
                                <td class="{{ $post->is_approved == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $post->is_approved == 1 ? 'Approved' : 'Not Approved' }}
                            </tr>

                            <tr>
                                <th>Admin Comment</th>
                                <td>{{ $post->admin_comment == null ? 'N/A' : $post->admin_comment }}</td>
                            </tr>

                            <tr>
                                <th>Created At</th>
                                <td>{{ $post->created_at->toDateTimeString() }}</td>
                            </tr>

                            <tr>
                                <th>Updated At</th>
                                <td>{{ $post->created_at != $post->updated_at ? $post->updated_at->toDateTimeString() : 'Not updated' }}
                            </tr>

                            <tr>
                                <th>Deleted At</th>
                                <td>{{ $post->deleted_at == null ? 'Not Deleted' : $post->deleted_at->toDateTimeString() }}
                                </td>
                            </tr>

                            <tr>
                                <th>Photo</th>
                                <td><img class="img-thumbnail"
                                        src="{{ strpos($post->photo, 'https') === 0 ? $post->photo : asset('images/post/original/' . $post->photo) }}"
                                        alt="{{ $post->title }}" alt=""></td>
                            </tr>

                            <tr>
                                <th>Tag</th>
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
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-secondary btn-sm mx-2"><i
                                class="fa-solid fa-pen-to-square mx-1"></i>Edit</a>

                        {!! Form::open([
                            'method' => 'delete',
                            'id' => 'form_' . $post->id,
                            'route' => ['post.destroy', $post->id],
                        ]) !!}

                        {!! Form::button('<i class="fa-solid fa-trash"></i> Delete', [
                            'type' => 'button',
                            'data-id' => $post->id,
                            'class' => 'delete btn btn-danger btn-sm',
                        ]) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt">
                <div class="card-header">
                    <h4>Category Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <tbody>
                            <tr>
                                <th class="wider-th-category">ID</th>
                                <td>{{ $post->category?->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $post->category?->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $post->category?->slug }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td class="{{ $post->category?->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $post->category?->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        @if (Auth::user()->role == \App\Models\User::ADMIN)
                            <a href="{{ route('category.show', $post->category?->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa-solid fa-eye mx-1"></i></i>Know More</a>
                        @endif

                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <h4>Sub-category Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <tbody>
                            <tr>
                                <th class="wider-th-category">ID</th>
                                <td>{{ $post->sub_category?->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $post->sub_category?->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $post->sub_category?->slug }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td class="{{ $post->sub_category?->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $post->sub_category?->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        @if (Auth::user()->role == \App\Models\User::ADMIN)
                            <a href="{{ route('sub-category.show', $post->sub_category?->id) }}"
                                class="btn btn-info btn-sm"><i class="fa-solid fa-eye mx-1"></i></i>Know More</a>
                        @endif
                    </div>
                </div>
            </div>

            @if (Auth::user()->role == \App\Models\User::ADMIN)
                <div class="card mt-2">
                    <div class="card-header">
                        <h4>Creator Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover table-sm">
                            <tbody>
                                <tr>
                                    <th class="wider-th-category">ID</th>
                                    <td>{{ $post->user?->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $post->user?->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="" class="btn btn-info btn-sm"><i class="fa-solid fa-eye mx-1"></i></i>Know
                                More</a>
                        </div>
                    </div>
                </div>
            @endif
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
