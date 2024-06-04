{!! Form::label('name', 'Sub-category Name') !!}
{!! Form::text('name', null, [
    'id' => 'name',
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter sub cateogry name...',
]) !!}

{!! Form::label('slug', 'Sub-category Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, [
    'id' => 'slug',
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter sub cateogry slug...',
    'readonly' => 'readonly',
]) !!}

{!! Form::label('category_id', 'Category', ['class' => 'mt-2']) !!}
{!! Form::select('category_id', $category_data, null, [
    'class' => 'form-select mt-1',
    'placeholder' => 'Select category...',
]) !!}

{!! Form::label('order_by', 'Sub-category Serial', ['class' => 'mt-2']) !!}
{!! Form::number('order_by', null, [
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter sub cateogry serial...',
]) !!}


{!! Form::label('status', 'Sub-category Status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'class' => 'form-select mt-1',
    'placeholder' => 'Select status...',
]) !!}
