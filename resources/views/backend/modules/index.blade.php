@extends('backend.layouts.master')

@section('page_title', 'Dashboard')

@section('page_sub_title', 'Blog')

@section('contents')
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header">
                    <h4>
                        <center>Total Admin</center>
                    </h4>
                </div>
                <div class="card-body">
                    <h4>
                        <center>{{ $admins }}</center>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-header">
                    <h4>
                        <center>Total User</center>
                    </h4>
                </div>
                <div class="card-body">
                    <h4>
                        <center>{{ $users }}</center>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white mb-4">
                <div class="card-header">
                    <h4>
                        <center>Total Post</center>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>
                                <center>Published: {{ $published_posts }}</center>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <h4>
                                Unpublished: {{ $unpublished_posts }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card bg-warning text-white mb-4">
                <div class="card-header">
                    <h4>
                        <center>Total Category</center>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>
                                <center>Active: {{ $active_category }}</center>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <h4>
                                <center>Inactive: {{ $inactive_category }}</center>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-header">
                    <h4>
                        <center>Total Sub-Category</center>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>
                                <center>Active: {{ $active_subcategory }}</center>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <h4>
                                <center>Inactive : {{ $inactive_subcategory }}</center>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark text-white mb-4">
                <div class="card-header">
                    <h4>
                        <center>Total Tag</center>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>
                                <center>Active : {{ $active_tags }}</center>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <h4>
                                <center>Inactive : {{ $inactive_tags }}</center>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
