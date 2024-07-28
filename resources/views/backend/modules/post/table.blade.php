<table class="table table-striped table-bordered table-hover post-table">
    <thead>
        <tr>
            <th>SL</th>
            <th>Title</th>
            <th>
                <p>Category</p>
                <hr>
                <p>Sub-category</p>
            </th>
            <th>Description</th>
            <th>Photo</th>
            <th>Tag</th>
            <th>
                <p>Status</p>
                <hr>
                <p>Is Aprroved</p>
                <hr>
                <p>Created By</p>
            </th>
            <th>
                <p>Created At</p>
                <hr>
                <p>Updated At</p>
            </th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($posts->isEmpty())
            <tr>
                <td colspan="9" class="text-center">
                    <div class="alert alert-warning mb-0" role="alert">
                        <strong>No Post Found !</strong>
                    </div>
                </td>
            </tr>
        @else
            @foreach ($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <p><a href="{{ route('category.show', $post->category_id) }}"
                                class="text-decoration-none text-success">{{ $post->category?->name }}</a>

                        </p>
                        <hr>
                        <p><a href="{{ route('sub-category.show', $post->sub_category_id) }}"
                                class="text-decoration-none ">{{ $post->sub_category?->name }}</a>
                        </p>
                    </td>
                    <td>{{ substr(strip_tags($post->description), 0, 70) }}...</td>

                    <td>
                        <img class="img-thumbnail post-image"
                            data-src="{{ strpos($post->photo, 'https') === 0 ? $post->photo : asset('images/post/original/' . $post->photo) }}"
                            src="{{ strpos($post->photo, 'https') === 0 ? $post->photo : asset('images/post/thumbnail/' . $post->photo) }}"
                            alt="">
                    </td>
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
                    <td>
                        <p class="{{ $post->status == 1 ? 'text-success' : 'text-danger' }}">
                            {{ $post->status == 1 ? 'Published' : 'Not Published' }}</p>
                        <hr>
                        <p class="{{ $post->is_approved == 1 ? 'text-success' : 'text-danger' }}">
                            {{ $post->is_approved == 1 ? 'Aprroved' : 'Not Aprroved' }}</p>
                        <hr>
                        <p>{{ $post->user?->name }}</p>
                    </td>
                    <td>
                        <p>{{ $post->created_at->toDateTimeString() }}</p>
                        <hr>
                        <p>{{ $post->created_at != $post->updated_at ? $post->updated_at->toDateTimeString() : 'Not updated' }}
                        </p>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('post.show', $post->id) }}"><button class="btn btn-info btn-sm"><i
                                        class="fa-solid fa-eye"></i></button></a>

                            <a href="{{ route('post.edit', $post->id) }}"><button
                                    class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-edit"></i></button></a>

                            {!! Form::open([
                                'method' => 'delete',
                                'id' => 'form_' . $post->id,
                                'route' => ['post.destroy', $post->id],
                            ]) !!}

                            {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                'type' => 'button',
                                'data-id' => $post->id,
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
    {{ $posts->withQueryString()->links() }}
</div>
{{-- pagination end --}}

{{-- common script tag for image modal --}}
@include('backend.modules.post.commonJs.modalTrigger')
{{-- common script tag for delete post --}}
@include('backend.modules.common-script.delete')

{{--  common notification toast message --}}
@if (session('msg'))
    @include('backend.modules.common-script.toast')
@endif
