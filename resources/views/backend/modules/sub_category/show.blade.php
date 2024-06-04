@extends('backend.layouts.master')

@section('page_title', 'Category')

@section('page_sub_title', 'Details')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ $category->name }} Details</h4>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $category->id }}</td>
                            </tr>

                            <tr>
                                <th>Category Name</th>
                                <td>{{ $category->name }}</td>
                            </tr>

                            <tr>
                                <th>Category Slug</th>
                                <td>{{ $category->slug }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>

                            <tr>
                                <th>Order By</th>
                                <td>{{ $category->order_by }}</td>
                            </tr>

                            <tr>
                                <th>Created At</th>
                                <td>{{ $category->created_at->toDateTimeString() }}</td>
                            </tr>

                            <tr>
                                <th>Updated At</th>
                                <td>{{ $category->created_at != $category->updated_at ? $category->updated_at->toDateTimeString() : 'Not updated' }}
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('category.index') }}" class="btn btn-success btn-sm mr-2"><i
                                class="fa-solid fa-left-long mx-1"></i>Back</a>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary btn-sm mx-2"><i
                                class="fa-solid fa-pen-to-square mx-1"></i>Edit</a>

                        {!! Form::open([
                            'method' => 'delete',
                            'id' => 'form_' . $category->id,
                            'route' => ['category.destroy', $category->id],
                        ]) !!}

                        {!! Form::button('<i class="fa-solid fa-trash"></i> Delete', [
                            'type' => 'button',
                            'data-id' => $category->id,
                            'class' => 'delete btn btn-danger btn-sm',
                        ]) !!}

                        {!! Form::close() !!}
                    </div>

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
