@extends('backend.layouts.master')

@section('page_title', 'Sub-category')

@section('page_sub_title', 'List')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-container d-flex align-items-center">
                            <form id="filter-form" action="{{ route('sub-category.index') }}" method="get"
                                class="d-flex align-items-center">
                                <div class="form-group me-3">
                                    <label class="category-label">Category </label>
                                    <select name="category" class="category-select form-control form-control-sm">
                                        <option value="" {{ request('status') === null ? 'selected' : '' }}>...
                                        </option>
                                        @foreach ($categories as $id => $name)
                                            <option value="{{ $name }}"
                                                {{ request('category') == $name ? 'selected' : '' }}>{{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group me-5">
                                    <label class="status-label">Status </label>
                                    <select name="status" class="status-select form-control form-control-sm">
                                        <option value="" {{ request('status') === null ? 'selected' : '' }}>...
                                        </option>
                                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group ms-5">
                                    <input type="submit" value="Filter" class="btn btn-primary custom-submit-btn">
                                </div>
                            </form>
                        </div>
                        <a href="{{ route('category.create') }}">
                            <button class="btn btn-success">
                                <i class="fa-solid fa-plus mx-1"></i>Add Sub-category
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Sub-category Name</th>
                                <th>Sub-category Slug</th>
                                <th>Category Name</th>
                                <th>Order By</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($subCategories->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <div class="alert alert-warning mb-0" role="alert">
                                            <strong>No Sub-category Found !</strong>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($subCategories as $index => $subCategory)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>{{ $subCategory->slug }}</td>
                                        <td>{{ $subCategory->category->name }}</td>
                                        <td>{{ $subCategory->order_by }}</td>
                                        <td class="{{ $subCategory->status == 1 ? 'text-success' : 'text-danger' }}">
                                            {{ $subCategory->status == 1 ? 'Active' : 'Inactive' }}
                                        </td>
                                        <td>{{ $subCategory->created_at->toDateTimeString() }}</td>
                                        <td>{{ $subCategory->created_at != $subCategory->updated_at ? $subCategory->updated_at->toDateTimeString() : 'Not updated' }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('sub-category.show', $subCategory->id) }}"><button
                                                        class="btn btn-info btn-sm"><i
                                                            class="fa-solid fa-eye"></i></button></a>

                                                <a href="{{ route('sub-category.edit', $subCategory->id) }}"><button
                                                        class="btn btn-warning btn-sm mx-1"><i
                                                            class="fa-solid fa-edit"></i></button></a>

                                                {!! Form::open([
                                                    'method' => 'delete',
                                                    'id' => 'form_' . $subCategory->id,
                                                    'route' => ['sub-category.destroy', $subCategory->id],
                                                ]) !!}

                                                {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                                    'type' => 'button',
                                                    'data-id' => $subCategory->id,
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
                        {{ $subCategories->withQueryString()->links() }}
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
            /*  select to for filteration of status */
            $(document).ready(function() {
                $('.status-select').select2();
            });

            /*  select to for filteration of category */
            $(document).ready(function() {
                $('.category-select').select2();
            });

            /* parameter is only included in the URL if it is explicitly provided during filteration */
            $('#filter-form').on('submit', function(event) {
                $(this).find('input, select').each(function() {
                    if (!$(this).val()) {
                        $(this).prop('disabled', true);
                    }
                });
            });
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
        </script>
    @endpush
@endsection
