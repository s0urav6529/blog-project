@extends('backend.layouts.master')

@section('page_title', 'Category')

@section('page_sub_title', 'Details')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Category Details</h4>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $category->id }}</td>
                            </tr>

                            <tr>
                                <th>Category Name</th>
                                <td>{{ $category->name }}</td>
                            </tr>

                            <tr>
                                <th>Category Slug</th>
                                <td>{{ $category->slug }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>

                            <tr>
                                <th>Order By</th>
                                <td>{{ $category->order_by }}</td>
                            </tr>

                            <tr>
                                <th>Created At</th>
                                <td>{{ $category->created_at->toDateTimeString() }}</td>
                            </tr>

                            <tr>
                                <th>Updated At</th>
                                <td>{{ $category->created_at != $category->updated_at ? $category->updated_at->toDateTimeString() : 'Not updated' }}
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('category.index') }}"><button class="btn btn-success btn-sm mt-2"><i
                                class="fa-solid fa-left-long mx-1"></i>Back</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
