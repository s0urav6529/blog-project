@extends('backend.layouts.master')

@section('page_title', 'Post')

@section('page_sub_title', 'Edit')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Post {{ $post->title }}</h4>
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

                    {!! Form::model($post, ['method' => 'put', 'route' => ['post.update', $post->id]]) !!}

                    {!! Form::hidden('id', $post->id) !!}

                    @include('backend.modules.post.form')

                    <div class="d-flex justify-content-center mt-1">
                        <a href="{{ route('post.index') }}" class="btn btn-success btn-sm mt-3"><i
                                class="fa-solid fa-left-long mx-1"></i>Back</a>
                        {!! Form::button('<i class="fa-solid fa-file-pen"></i> Update', [
                            'type' => 'submit',
                            'class' => 'btn btn-warning btn-sm mt-3 mx-2',
                        ]) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
