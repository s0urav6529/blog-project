@extends('backend.layouts.master')

@section('page_title', 'Category')

@section('page_sub_title', 'Edit')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Category {{ $category->name }}</h4>
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

                    {!! Form::model($category, ['method' => 'put', 'route' => ['category.update', $category->id]]) !!}

                    {!! Form::hidden('id', $category->id) !!}

                    @include('backend.modules.category.form')

                    <div class="d-flex justify-content-center mt-1">
                        <a href="{{ route('category.index') }}" class="btn btn-success btn-sm mt-3"><i
                                class="fa-solid fa-left-long mx-1"></i>Back</a>
                        {!! Form::button('<i class="fa-solid fa-file-pen"></i> Update Catgory', [
                            'type' => 'submit',
                            'class' => 'btn btn-warning btn-sm mt-3 mx-2',
                        ]) !!}
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
