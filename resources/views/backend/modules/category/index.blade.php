@extends('backend.layouts.master')

@section('page_title', 'Category')

@section('page_sub_title', 'List')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-container d-flex align-items-center">
                            <form id="filter-form" action="{{ route('category.index') }}" method="get"
                                class="d-flex align-items-center">
                                <div class="form-group me-3">
                                    <label class="cat-l-status">Status </label>
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
                                <i class="fa-solid fa-plus mx-1"></i>Add Category
                            </button>
                        </a>
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
                            @if ($category_data->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="alert alert-warning mb-0" role="alert">
                                            <strong>No Category Found !</strong>
                                        </div>
                                    </td>
                                </tr>
                            @else
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
                                                        class="btn btn-info btn-sm"><i
                                                            class="fa-solid fa-eye"></i></button></a>

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
                            @endif
                        </tbody>
                    </table>

                    {{-- pagination open --}}
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $category_data->withQueryString()->links() }}
                    </div>
                    {{-- pagination end --}}

                </div>
            </div>
        </div>
    </div>

    {{--  notification message toast --}}
    @if (session('msg'))
        @include('backend.modules.common-script.toast')
    @endif

    @push('js')
        <script>
            /*  select to for filteration */
            $(document).ready(function() {
                $('#status-select').select2();
            });

            /* parameter is only included in the URL if it is explicitly provided during filteration */
            $('#filter-form').on('submit', function(event) {
                $(this).find('input, select').each(function() {
                    if (!$(this).val()) {
                        $(this).prop('disabled', true);
                    }
                });
            });
        </script>
    @endpush
    {{-- common script tag for delete category --}}
    @include('backend.modules.common-script.delete')
@endsection
