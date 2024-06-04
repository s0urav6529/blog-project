@extends('backend.layouts.master')

@section('page_title', 'Tag')

@section('page_sub_title', 'Create')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Create Tag</h4>
                        <a href="{{ route('tag.index') }}"> <button class="btn btn-success btn-sm"><i
                                    class="fa-solid fa-left-long mx-1"></i>Back
                            </button></a>
                    </div>
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

                    {!! Form::open(['method' => 'post', 'route' => 'tag.store']) !!}

                    @include('backend.modules.tag.form')

                    <div class="d-grid">
                        {!! Form::button('Create Tag', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-3']) !!}
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
