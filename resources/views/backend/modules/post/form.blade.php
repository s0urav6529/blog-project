{!! Form::label('title', 'Title') !!}
{!! Form::text('title', null, [
    'id' => 'title',
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter post title...',
]) !!}

{!! Form::label('slug', 'Post Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, [
    'id' => 'slug',
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter post slug...',
    'readonly' => 'readonly',
]) !!}

<div class="row">
    <div class="col-md-6">
        {!! Form::label('category_id', 'Category', ['class' => 'mt-2']) !!}
        {!! Form::select('category_id', $category_data, null, [
            'id' => 'category_id',
            'class' => 'form-select mt-1',
            'placeholder' => 'Select category...',
        ]) !!}
    </div>
    <div class="col-md-6">
        {!! Form::label('sub_category_id', 'Sub-category', ['class' => 'mt-2']) !!}
        <select name="sub_category_id" id="subCategory_id" class="form-select mt-1">
            <option selected="selected">Select sub-category...</option>
        </select>
    </div>
</div>

{!! Form::label('description', 'Post Description', ['class' => 'mt-2']) !!}
{!! Form::textarea('description', null, [
    'id' => 'description',
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter post description...',
]) !!}


{!! Form::label('tag_id', 'Select Tag', ['class' => 'mt-2']) !!}
<div class="row border rounded p-3 bg-light mt-1">
    @foreach ($tag_data as $tag)
        <div class="col-md-3 mb-2">
            <div class="form-check">
                {!! Form::checkbox(
                    'tag_ids[]',
                    $tag->id,
                    Route::currentRouteName() == 'post.edit' ? in_array($tag->id, $selected_tags) : false,
                    [
                        'class' => 'form-check-input',
                    ],
                ) !!}
                <span>{{ $tag->name }}</span>
            </div>
        </div>
    @endforeach
</div>


<div class="row mt-2">
    <div class="col-md-6">
        {!! Form::label('photo', 'Choose image', ['class' => 'mt-2']) !!}
        {!! Form::file('photo', ['class' => 'form-control mt-1']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::label('status', 'Post Status', ['class' => 'mt-2']) !!}
        {!! Form::select('status', [1 => 'Published', 0 => 'Not Published'], null, [
            'class' => 'form-select mt-1',
            'placeholder' => 'Select status...',
        ]) !!}
    </div>
</div>

@if (Route::currentRouteName() == 'post.edit')
    <div class="my-3 d-flex justify-content-center">
        <img class="img-thumbnail post-image" data-src="{{ $post->photo }}" src="{{ $post->photo }}" alt="">
    </div>
@endif


@push('css')
    <style>
        /* description box size */
        .ck.ck-editor__main>.ck-editor__editable {
            border-color: var(--ck-color-base-border);
            min-height: 220px;
        }
    </style>
@endpush

@push('js')
    {{-- axios cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
        integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- ckedior cdn --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        /* subcategory load function */
        const categoryWiseSubCategoryLoad = (category_id, sub_category_id = 'null') => {

            let route_name = '{{ Route::CurrentRouteName() }}';
            let select = '';

            if (route_name == 'post.create') {
                select = 'selected';
            }

            let subcat_id = $('#subCategory_id');
            subcat_id.empty();

            subcat_id.append(`<option ${select} >Select sub-category...</option>`);

            axios.get(window.location.origin + '/dashboard/get-subcategory/' + category_id).then(res => {

                let subCategory_data = res.data;

                subCategory_data.map((subCategory, index) => {

                    select = '';

                    if (route_name == 'post.edit' && sub_category_id == subCategory.id) {
                        select = 'selected';
                    }
                    return subcat_id.append(
                        `<option ${select} value="${subCategory.id}">${subCategory.name}</option>`);
                });
            });
        }

        /* description box editor */
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        /* slug creator */
        $('#title').on('input', function() {
            let title = $(this).val();
            let slug = title.replaceAll(' ', '-').toLowerCase();
            $('#slug').val(slug);
        });

        /* category wise subcategory load during create */
        $('#category_id').on('change', function() {
            categoryWiseSubCategoryLoad($(this).val());
        });
    </script>
    {{-- category wise subcategory load during edit  --}}
    @if (Route::currentRouteName() == 'post.edit')
        <script>
            categoryWiseSubCategoryLoad('{{ $post->category_id }}', '{{ $post->sub_category_id }}')
        </script>
    @endif
@endpush
