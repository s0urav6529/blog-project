@extends('backend.layouts.master')

@section('page_title', 'Post')

@section('page_sub_title', 'List')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-container d-flex align-items-center">
                            <form id="filter-form" class="d-flex align-items-center">
                                <div class="form-group me-3">
                                    <label class="post-l-category">Category </label>
                                    <select name="category" class="category-select form-control form-control-sm"
                                        id="category-select">
                                        <option value="" {{ request('category') === null ? 'selected' : '' }}>...
                                        </option>
                                        @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ request('category') == $id ? 'selected' : '' }}>{{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group me-3">
                                    <label class="post-l-subcategory">Sub-category </label>
                                    <select name="sub_category" class="subcategory-select form-control form-control-sm"
                                        id="subcategory-select">
                                        <option value="" {{ request('sub_category') === null ? 'selected' : '' }}>...
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group me-5">
                                    <label class="post-l-status">Status </label>
                                    <select name="status" class="status-select form-control form-control-sm"
                                        id="status-select">
                                        <option value="" {{ request('status') === null ? 'selected' : '' }}>...
                                        </option>
                                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Published
                                        </option>
                                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                                            Not Published
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group me-5">
                                    <label class="post-l-approval">Approval </label>
                                    <select name="approval" class="approval-select form-control form-control-sm"
                                        id="approval-select">
                                        <option value="" {{ request('approval') === null ? 'selected' : '' }}>...
                                        </option>
                                        <option value="1" {{ request('approval') === '1' ? 'selected' : '' }}>Approved
                                        </option>
                                        <option value="0" {{ request('approval') === '0' ? 'selected' : '' }}>
                                            Not Approved
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <a href="{{ route('post.create') }}">
                            <button class="btn btn-success">
                                <i class="fa-solid fa-plus mx-1"></i>Add Post </button>
                        </a>
                    </div>
                </div>
                <div class="card-body" id="results">
                    @include('backend.modules.post.table', ['posts' => $posts])
                </div>
            </div>
        </div>

        {{-- @image modal open --}}
        <button id="img_show_btn" type="button" class="btn btn-primary d-none" data-bs-toggle="modal"
            data-bs-target="#image_show"></button>
        <div class="modal fade" id="image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Blog Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="img-thumbnail" alt="Display image" id="display_image" />
                    </div>
                </div>
            </div>
        </div>
        {{-- @image model end --}}

    </div>

    {{--  notification message toast --}}
    @if (session('msg'))
        @push('js')
            @include('backend.modules.post.commonJs.toast')
        @endpush
    @endif

    @push('js')
        <script>
            const subCategoryLoad = (category_id) => {

                $.ajax({
                    url: window.location.origin + '/dashboard/get-subcategory/' + category_id,
                    method: 'GET'
                }).then(res => {

                    res.map((subCategory, index) => {
                        $('#subcategory-select').append(
                            `<option value="${subCategory.id}">${subCategory.name}</option>`
                        );
                    });

                }).catch(error => {
                    console.log(error);
                });
            };

            $(document).ready(function() {
                $('.status-select').select2();
                $('.category-select').select2();
                $('.approval-select').select2();
                $('.subcategory-select').select2();

                function filterQuery() {

                    let urlParams = new URLSearchParams(window.location.search);

                    let category = urlParams.get('category') || '';
                    let status = urlParams.get('status') || '';
                    let approval = urlParams.get('approval') || '';
                    let subCategory = urlParams.get('sub_category') || '';


                    $('#category-select').val(category).trigger('change');
                    $('#status-select').val(status).trigger('change');
                    $('#approval-select').val(approval).trigger('change');
                    $('#subcategory-select').val(subCategory).trigger('change');
                }

                function sendRequest() {

                    let form = $('#filter-form');
                    let url = "{{ route('post.index') }}";
                    let params = form.serializeArray();

                    let query = params.map(function(param) {
                        return encodeURIComponent(param.name) + '=' + encodeURIComponent(param.value);
                    }).filter(function(param) {
                        return param.split('=')[1] !== '';
                    }).join('&');

                    url = url + (query ? '?' + query : '');

                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            $('#results').html(response);
                            // Push the new state to the history stack
                            history.pushState({
                                url: url
                            }, '', url);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }

                // Initialize form values based on URL parameters on page load
                filterQuery();

                $('#category-select, #status-select, #approval-select, #subcategory-select').on('change', function(
                    event) {

                    if (event.target.id == 'category-select') {

                        let category_id = $(event.target).val();
                        let subcategory_id = $('#subcategory-select');
                        subcategory_id.empty();
                        subcategory_id.append(`<option value=''>...</option>`);

                        if (category_id != '') {
                            subCategoryLoad(category_id);
                        }
                    }
                    sendRequest();
                });

                // Handle the back and forward button and restore the state
                window.onpopstate = function(event) {
                    if (event.state && event.state.url) {
                        let url = event.state.url;

                        // Update the form values based on the URL
                        let urlParams = new URLSearchParams(new URL(url).search);
                        let category = urlParams.get('category') || '';
                        let status = urlParams.get('status') || '';
                        let approval = urlParams.get('approval') || '';
                        let subCategory = urlParams.get('sub-category') || '';

                        $('#category-select').val(category).trigger('change');
                        $('#status-select').val(status).trigger('change');
                        $('#approval-select').val(approval).trigger('change');
                        $('#subcategory-select').val(subCategory).trigger('change');

                        // Load the content based on the URL
                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function(response) {
                                $('#results').html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                };
            });
        </script>

        {{-- include common script tag for image modal, delete post --}}
        @include('backend.modules.post.commonJs.index-js')
    @endpush
@endsection
