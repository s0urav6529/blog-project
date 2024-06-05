@extends('backend.layouts.master')

@section('page_title', 'Post')

@section('page_sub_title', 'Create')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Create Post</h4>
                        <a href="{{ route('post.index') }}"> <button class="btn btn-success btn-sm"><i
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

                    {!! Form::open(['method' => 'post', 'route' => 'post.store', 'files' => true]) !!}

                    @include('backend.modules.post.form')

                    <div class="justify-content-center">
                        {!! Form::button('Create Post', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-2']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
