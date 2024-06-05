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
        <select name="sub_category_id" id="subCategory-id" class="form-select mt-1">
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
<br>
<div class="row">
    @foreach ($tag_data as $tag)
        <div class="col-md-3">
            {!! Form::checkbox('tag_ids[]', $tag->id, false) !!} <span>{{ $tag->name }}</span>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-6">
        {!! Form::label('photo', 'Choose image', ['class' => 'mt-2']) !!}
        {!! Form::file('photo', ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::label('status', 'Post Status', ['class' => 'mt-2']) !!}
        {!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
            'class' => 'form-select mt-1',
            'placeholder' => 'Select status...',
        ]) !!}
    </div>
</div>


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
        /* description box editor */
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        /* category wise subcategory load */
        $('#category_id').on('change', function() {

            let category_id = $(this).val();

            $('#subCategory-id').empty();
            $('#subCategory-id').append('<option selected="selected">Select sub-category...</option>');

            axios.get(window.location.origin + '/dashboard/get-subcategory/' + category_id).then(res => {

                let subCategory_data = res.data;

                subCategory_data.map((subCategory, index) => {
                    $('#subCategory-id').append(
                        `<option value="${subCategory.id}">${subCategory.name}</option>`);
                })
            });

        });

        /* slug creator */
        $('#title').on('input', function() {

            let title = $(this).val();
            let slug = title.replaceAll(' ', '-').toLowerCase();
            $('#slug').val(slug);
        });
    </script>
@endpush
