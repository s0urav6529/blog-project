@extends('backend.layouts.master')

@section('page_title', 'Tag')

@section('page_sub_title', 'List')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-container d-flex align-items-center">
                            <form id="filter-form" action="{{ route('tag.index') }}" method="get"
                                class="d-flex align-items-center">
                                <div class="form-group me-3">
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
                                <div class="form-group me-5">
                                    <label class="orderBy-tag-label">Order By </label>
                                    <select name="order_by" class="order_by-select form-control form-control-sm">
                                        <option value="" {{ request('order_by') === null ? 'selected' : '' }}>...
                                        </option>
                                        <option value="desc" {{ request('order_by') === 'desc' ? 'selected' : '' }}>Desc
                                        </option>
                                        <option value="asc" {{ request('order_by') === 'asc' ? 'selected' : '' }}>Asc
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group ms-5">
                                    <input type="submit" value="Filter" class="btn btn-primary custom-submit-btn">
                                </div>
                            </form>
                        </div>
                        <a href="{{ route('sub-category.create') }}">
                            <button class="btn btn-success">
                                <i class="fa-solid fa-plus mx-1"></i>Add Tag
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Tag Name</th>
                                <th>Tag Slug</th>
                                <th>Order By</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tag_data->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="alert alert-warning mb-0" role="alert">
                                            <strong>No Tag Found !</strong>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($tag_data as $index => $tag)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->slug }}</td>
                                        <td>{{ $tag->order_by }}</td>
                                        <td class="{{ $tag->status == 1 ? 'text-success' : 'text-danger' }}">
                                            {{ $tag->status == 1 ? 'Active' : 'Inactive' }}
                                        </td>
                                        <td>{{ $tag->created_at->toDateTimeString() }}</td>
                                        <td>{{ $tag->created_at != $tag->updated_at ? $tag->updated_at->toDateTimeString() : 'Not updated' }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('tag.show', $tag->id) }}"><button
                                                        class="btn btn-info btn-sm"><i
                                                            class="fa-solid fa-eye"></i></button></a>

                                                <a href="{{ route('tag.edit', $tag->id) }}"><button
                                                        class="btn btn-warning btn-sm mx-1"><i
                                                            class="fa-solid fa-edit"></i></button></a>

                                                {!! Form::open([
                                                    'method' => 'delete',
                                                    'id' => 'form_' . $tag->id,
                                                    'route' => ['tag.destroy', $tag->id],
                                                ]) !!}

                                                {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                                    'type' => 'button',
                                                    'data-id' => $tag->id,
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
                        {{ $tag_data->links() }}
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

            /*  select to for filteration of sort-by */
            $(document).ready(function() {
                $('.order_by-select').select2();
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
                console.log(id);
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
