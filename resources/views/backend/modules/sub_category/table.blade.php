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
                                    class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>

                            <a href="{{ route('sub-category.edit', $subCategory->id) }}"><button
                                    class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-edit"></i></button></a>

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
