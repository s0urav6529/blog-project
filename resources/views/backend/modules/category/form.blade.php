{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, [
'id' => 'name',
'class' => 'form-control form-control-sm mt-1',
'placeholder' => 'Enter cateogry name...',
]) !!}

{!! Form::label('slug', 'Category Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, [
'id' => 'slug',
'class' => 'form-control form-control-sm mt-1',
'placeholder' => 'Enter cateogry slug...',
'readonly' => 'readonly',
]) !!}

{!! Form::label('order_by', 'Category Serial', ['class' => 'mt-2']) !!}
{!! Form::number('order_by', null, [
'class' => 'form-control form-control-sm mt-1',
'placeholder' => 'Enter cateogry serial...',
]) !!}


{!! Form::label('status', 'Category Status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
'class' => 'form-select mt-1',
'placeholder' => 'Select status...',
]) !!}
