@extends('backend.layouts.master')

@section('page_title', 'Sub category')

@section('page_sub_title', 'Details')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">{{ $subCategory->name }} Details</h4>
                        <a href="{{ route('sub-category.index') }}" class="btn btn-success btn-sm mr-2"><i
                                class="fa-solid fa-left-long mx-1"></i>Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th class="wider-th-subcat">ID</th>
                                <td>{{ $subCategory->id }}</td>
                            </tr>

                            <tr>
                                <th>Sub category Name</th>
                                <td>{{ $subCategory->name }}</td>
                            </tr>

                            <tr>
                                <th>Sub category Slug</th>
                                <td>{{ $subCategory->slug }}</td>
                            </tr>

                            <tr>
                                <th>Category</th>
                                <td>{{ $subCategory->category->name }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>{{ $subCategory->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>

                            <tr>
                                <th>Order By</th>
                                <td>{{ $subCategory->order_by }}</td>
                            </tr>

                            <tr>
                                <th>Created At</th>
                                <td>{{ $subCategory->created_at->toDateTimeString() }}</td>
                            </tr>

                            <tr>
                                <th>Updated At</th>
                                <td>{{ $subCategory->created_at != $subCategory->updated_at ? $subCategory->updated_at->toDateTimeString() : 'Not updated' }}
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('sub-category.edit', $subCategory->id) }}"
                            class="btn btn-secondary btn-sm mx-2"><i class="fa-solid fa-pen-to-square mx-1"></i>Edit</a>

                        {!! Form::open([
                            'method' => 'delete',
                            'id' => 'form_' . $subCategory->id,
                            'route' => ['sub-category.destroy', $subCategory->id],
                        ]) !!}

                        {!! Form::button('<i class="fa-solid fa-trash"></i> Delete', [
                            'type' => 'button',
                            'data-id' => $subCategory->id,
                            'class' => 'delete btn btn-danger btn-sm',
                        ]) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Category Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th class="wider-th-category">ID</th>
                                <td>{{ $subCategory->category?->id }}</td>
                            </tr>

                            <tr>
                                <th>Name</th>
                                <td>{{ $subCategory->category?->name }}</td>
                            </tr>

                            <tr>
                                <th>Slug</th>
                                <td>{{ $subCategory->category?->slug }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td class="{{ $subCategory->category?->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $subCategory->category?->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('category.show', $subCategory->category?->id) }}" class="btn btn-info btn-sm"><i
                                class="fa-solid fa-eye mx-1"></i></i>Know More</a>
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
