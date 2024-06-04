{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, [
    'id' => 'name',
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter tag name...',
]) !!}

{!! Form::label('slug', 'Tag Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, [
    'id' => 'slug',
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter tag slug...',
    'readonly' => 'readonly',
]) !!}

{!! Form::label('order_by', 'Tag Serial', ['class' => 'mt-2']) !!}
{!! Form::number('order_by', null, [
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter tag serial...',
]) !!}


{!! Form::label('status', 'Tag Status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'class' => 'form-select mt-1',
    'placeholder' => 'Select status...',
]) !!}
