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
        @if ($categories->isEmpty())
            <tr>
                <td colspan="8" class="text-center">
                    <div class="alert alert-warning mb-0" role="alert">
                        <strong>No Category Found !</strong>
                    </div>
                </td>
            </tr>
        @else
            @foreach ($categories as $index => $category)
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
                            <a href="{{ route('category.show', $category->id) }}"><button class="btn btn-info btn-sm"><i
                                        class="fa-solid fa-eye"></i></button></a>

                            <a href="{{ route('category.edit', $category->id) }}"><button
                                    class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-edit"></i></button></a>

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
    {{ $categories->withQueryString()->links() }}
</div>
{{-- pagination end --}}

{{-- common script tag for delete post --}}
@include('backend.modules.common-script.delete')

{{--  common notification toast message --}}
@if (session('msg'))
    @include('backend.modules.common-script.toast')
@endif
