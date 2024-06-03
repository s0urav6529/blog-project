@extends('backend.layouts.master')

@section('page_title', 'Category')

@section('page_sub_title', 'Create')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create Category</h4>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['method' => 'post', 'route' => 'category.store']) !!}

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


                    <div class="d-grid">
                        {!! Form::button('Create Catgory', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-3']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $('#name').on('input', function() {

                let name = $(this).val();
                let slug = name.replaceAll(' ', '-').toLowerCase();
                $('#slug').val(slug);
            })
        </script>
    @endpush

@endsection
