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
        {!! Form::label('subCategory_id', 'Sub-category', ['class' => 'mt-2']) !!}
        <select name="subCategory_id" id="subCategory-id" class="form-select mt-1">
            <option selected="selected">Select sub-category...</option>
        </select>
    </div>
</div>


{!! Form::label('status', 'Post Status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'class' => 'form-select mt-1',
    'placeholder' => 'Select status...',
]) !!}

@push('js')
    <script>
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
    </script>
@endpush
