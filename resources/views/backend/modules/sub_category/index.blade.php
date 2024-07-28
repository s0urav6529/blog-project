@extends('backend.layouts.master')

@section('page_title', 'Sub-category')

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
                                    <label class="subcat-l-category">Category </label>
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
                                <div class="form-group me-5">
                                    <label class="subcat-l-status">Status </label>
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
                                    <label class="subcat-l-orderby">Order By </label>
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
                        <a href="{{ route('sub-category.create') }}">
                            <button class="btn btn-success">
                                <i class="fa-solid fa-plus mx-1"></i>Add Sub-category
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body" id="results">
                    @include('backend.modules.sub_category.table', ['subCategories' => $subCategories])
                </div>
            </div>
        </div>
    </div>

    {{--  notification message toast --}}
    @if (session('msg'))
        @push('js')
            @include('backend.modules.common-script.toast')
        @endpush
    @endif

    @push('js')
        <script>
            /*  select to for filteration of status */
            $(document).ready(function() {
                $('.status-select').select2();
                $('.category-select').select2();
                $('.order_by-select').select2();

                function filterQuery() {

                    let urlParams = new URLSearchParams(window.location.search);

                    let category = urlParams.get('category') || '';
                    let status = urlParams.get('status') || '';
                    let orderBy = urlParams.get('order_by') || '';

                    $('#category-select').val(category).trigger('change');
                    $('#status-select').val(status).trigger('change');
                    $('#order_by-select').val(orderBy).trigger('change');
                }

                function sendRequest() {

                    let form = $('#filter-form');
                    let url = "{{ route('sub-category.index') }}";
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

                $('#category-select, #status-select, #order_by-select').on('change', function() {
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
                        let orderBy = urlParams.get('order_by') || '';

                        $('#category-select').val(category).trigger('change');
                        $('#status-select').val(status).trigger('change');
                        $('#order_by-select').val(orderBy).trigger('change');

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
        {{-- common script tag for delete subcategory --}}
        @include('backend.modules.common-script.delete')
    @endpush
@endsection
