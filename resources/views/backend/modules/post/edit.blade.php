@extends('backend.layouts.master')

@section('page_title', 'Post')

@section('page_sub_title', 'Edit')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-truncate card-header-title">
                            <h4 class="mb-0 text-truncate">{{ $post->title }}</h4>
                        </div>
                        <a href="{{ route('post.index') }}"><button class="btn btn-success btn-sm ml-2"><i
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

                    {!! Form::model($post, ['method' => 'put', 'route' => ['post.update', $post->id], 'files' => true]) !!}

                    {!! Form::hidden('id', $post->id) !!}

                    @include('backend.modules.post.form')

                    <div class="d-flex justify-content-center mt-1">
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
