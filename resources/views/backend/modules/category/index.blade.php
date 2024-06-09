@extends('backend.layouts.master')

@section('page_title', 'Category')

@section('page_sub_title', 'List')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Category List</h4>
                        <a href="{{ route('category.create') }}"> <button class="btn btn-success btn-sm"><i
                                    class="fa-solid fa-plus mx-1"></i>Add Category
                            </button></a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- @if (session('msg'))
                        <div class="alert alert-{{ session('notification_color') }}" id="alert-msg">
                            {{ session('msg') }}
                        </div>
                    @endif --}}
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Category Slug</th>
                                <th>Order By</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category_data as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->order_by }}</td>
                                    <td class="{{ $category->status == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $category->status == 1 ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td>{{ $category->created_at->toDateTimeString() }}</td>
                                    <td>{{ $category->created_at != $category->updated_at ? $category->updated_at->toDateTimeString() : 'Not updated' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('category.show', $category->id) }}"><button
                                                    class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>

                                            <a href="{{ route('category.edit', $category->id) }}"><button
                                                    class="btn btn-warning btn-sm mx-1"><i
                                                        class="fa-solid fa-edit"></i></button></a>

                                            {!! Form::open([
                                                'method' => 'delete',
                                                'id' => 'form_' . $category->id,
                                                'route' => ['category.destroy', $category->id],
                                            ]) !!}

                                            {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                                'type' => 'button',
                                                'data-id' => $category->id,
                                                'class' => 'delete btn btn-danger btn-sm',
                                            ]) !!}

                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- pagination open --}}
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $category_data->links() }}
                    </div>
                    {{-- pagination end --}}

                </div>
            </div>
        </div>
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

            /* notification message timeout during add & edit */
            /* document.addEventListener('DOMContentLoaded', function() {
                const alertMsg = documCategoryent.getElementById('alert-msg');
                if (alertMsg) {
                    setTimeout(() => {
                        alertMsg.style.display = 'none';
                    }, 5000);
                }
            }); */
        </script>
    @endpush
@endsection
