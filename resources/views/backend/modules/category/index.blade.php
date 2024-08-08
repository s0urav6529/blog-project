@extends('backend.layouts.master')

@section('page_title', 'Category')

@section('page_sub_title', 'List')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center header-area">
                        <div class="form-container d-flex align-items-center filter-area-category">
                            <form id="filter-form" action="{{ route('category.index') }}" method="get"
                                class="d-flex align-items-center">
                                <div class="form-group me-3">
                                    <label class="cat-l-status">Status </label>
                                    <select name="status" class="status-select form-control form-control-sm"
                                        id="status-select">
                                        <option value="" {{ request('status') === null ? 'selected' : '' }}>...
                                        </option>
                                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group me-5">
                                    <label class="cat-l-orderby">Order By </label>
                                    <select name="order_by" class="order_by-select form-control form-control-sm"
                                        id="order_by-select">
                                        <option value="" {{ request('order_by') === null ? 'selected' : '' }}>...
                                        </option>
                                        <option value="desc" {{ request('order_by') === 'desc' ? 'selected' : '' }}>Desc
                                        </option>
                                        <option value="asc" {{ request('order_by') === 'asc' ? 'selected' : '' }}>Asc
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="search-area-category">
                            <div class="category-search">
                                <form id="search-form">
                                    <input type="text" name="search" id="search" class="form-control"
                                        placeholder="Search categories...">
                                </form>
                            </div>
                        </div>

                        <div class="add-btn-category">
                            <a href="{{ route('category.create') }}">
                                <button class="btn btn-success">
                                    <i class="fa-solid fa-plus mx-1"></i>Add Category
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="results">
                    {{-- @if (session('msg'))
                        <div class="alert alert-{{ session('notification_color') }}" id="alert-msg">
                            {{ session('msg') }}
                        </div>
                    @endif --}}
                    @include('backend.modules.category.table', ['categories' => $categories])
                </div>
            </div>
        </div>
    </div>

    {{--  notification message toast --}}
    @if (session('msg'))
        @include('backend.modules.common-script.toast')
    @endif

    @push('js')
        <script>
            $(document).ready(function() {

                $('#status-select').select2();
                $('#order_by-select').select2();


                /* filtering in category start */
                function updateFormValues() {

                    let urlParams = new URLSearchParams(window.location.search);

                    let status = urlParams.get('status') || '';
                    let orderBy = urlParams.get('order_by') || '';

                    // Set the value for status-select and order_by-select
                    $('#status-select').val(status).trigger('change');
                    $('#order_by-select').val(orderBy).trigger('change');
                }

                function sendRequest() {
                    let form = $('#filter-form');
                    let url = form.attr('action');
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

                updateFormValues();

                // Bind change event to select elements
                $('#status-select, #order_by-select').on('change', function() {
                    sendRequest();
                });

                // Handle the back and forward button and restore the state
                window.onpopstate = function(event) {
                    if (event.state && event.state.url) {
                        let url = event.state.url;

                        // Update the form values based on the URL
                        let urlParams = new URLSearchParams(new URL(url).search);
                        let status = urlParams.get('status') || '';
                        let orderBy = urlParams.get('order_by') || '';

                        // Set the value for status-select and order_by-select
                        $('#status-select').val(status).trigger('change');
                        $('#order_by-select').val(orderBy).trigger('change');

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
                /* filtering in category end */


                /* searching in category */
                $('#search-form').on('submit', function(event) {
                    event.preventDefault();
                    fetchCategories();
                });

                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    fetchCategories(page);
                });

                function fetchCategories(page = 1) {
                    $.ajax({
                        url: '{{ route('category.search') }}',
                        method: 'GET',
                        data: {
                            search: $('#search').val(),
                            page: page
                        },
                        success: function(response) {
                            $('#results').html(response);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
                /* filtering in category end */

            });
        </script>
    @endpush
    {{-- common script tag for delete category --}}
    @include('backend.modules.common-script.delete')
@endsection
