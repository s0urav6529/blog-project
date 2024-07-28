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
        @if ($tags->isEmpty())
            <tr>
                <td colspan="8" class="text-center">
                    <div class="alert alert-warning mb-0" role="alert">
                        <strong>No Tag Found !</strong>
                    </div>
                </td>
            </tr>
        @else
            @foreach ($tags as $index => $tag)
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
                            <a href="{{ route('tag.show', $tag->id) }}"><button class="btn btn-info btn-sm"><i
                                        class="fa-solid fa-eye"></i></button></a>

                            <a href="{{ route('tag.edit', $tag->id) }}"><button class="btn btn-warning btn-sm mx-1"><i
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
    {{ $tags->withQueryString()->links() }}
</div>
{{-- pagination end --}}

{{-- common script tag for delete post --}}
@include('backend.modules.common-script.delete')

{{--  common notification toast message --}}
@if (session('msg'))
    @include('backend.modules.common-script.toast')
@endif
