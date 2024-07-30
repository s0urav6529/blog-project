@if (Auth::user()->role === \App\Models\User::ADMIN && Route::currentRouteName() == 'user-profile.edit')
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', $userProfile->user?->name, [
        'class' => 'form-control form-control-sm mt-1',
        'placeholder' => 'Enter phone number...',
        $isEditable ? '' : 'readonly' => 'readonly',
    ]) !!}

    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', $userProfile->user?->email, [
        'class' => 'form-control form-control-sm mt-1',
        'placeholder' => 'Enter phone number...',
        $isEditable ? '' : 'readonly' => 'readonly',
    ]) !!}

    {!! Form::label('role', 'Role', ['class' => 'mt-2']) !!}
    {!! Form::select('role', $roles, $role, ['class' => 'form-select form-select-sm mt-1']) !!}
@else
    {!! Form::hidden('user_id', Auth::id()) !!}
@endif

{!! Form::label('phone', 'Phone') !!}
{!! Form::text('phone', null, [
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter phone number...',
    $isEditable ? '' : 'readonly' => 'readonly',
]) !!}

{!! Form::label('gender', 'Select Gender', ['class' => 'mt-2']) !!}
<div class="d-flex mt-1">
    <div class="d-flex me-4">{!! Form::radio('gender', 'Male', false, [
        'class' => 'form-check me-1',
        $isEditable ? '' : 'disabled' => 'disabled',
    ]) !!} Male</div>
    <div class="d-flex me-4">{!! Form::radio('gender', 'Female', false, [
        'class' => 'form-check me-1',
        $isEditable ? '' : 'disabled' => 'disabled',
    ]) !!} Female</div>
    <div class="d-flex">{!! Form::radio('gender', 'Other', false, [
        'class' => 'form-check me-1',
        $isEditable ? '' : 'disabled' => 'disabled',
    ]) !!} Other</div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('division_id', 'Division', ['class' => 'mt-2']) !!}
        {!! Form::select('division_id', $divisions, null, [
            'id' => 'division_id',
            'class' => 'form-select mt-1',
            'placeholder' => 'Select division...',
            $isEditable ? '' : 'disabled' => 'disabled',
        ]) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('district_id', 'District', ['class' => 'mt-2']) !!}
        <select name="district_id" id="district_id" class="form-select mt-1" {{ $isEditable ? '' : 'disabled' }}>
            <option selected="selected">Select district...</option>
        </select>
    </div>
    <div class="col-md-4">
        {!! Form::label('thana_id', 'Upazila/Thana', ['class' => 'mt-2']) !!}
        <select name="thana_id" id="thana_id" class="form-select mt-1" {{ $isEditable ? '' : 'disabled' }}>
            <option selected="selected">Select thana...</option>
        </select>
    </div>
</div>

{!! Form::label('address', ' Address', ['class' => 'mt-2']) !!}
{!! Form::textarea('address', null, [
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Write address...',
    'rows' => '3',
    $isEditable ? '' : 'readonly' => 'readonly',
]) !!}

@if (Auth::user()->role === \App\Models\User::ADMIN && Route::currentRouteName() == 'user-profile.edit')
    {!! Form::label('role', 'Role', ['class' => 'mt-2']) !!}
    {!! Form::select('role', $roles, $role, ['class' => 'form-select form-select-sm mt-1']) !!}
@endif

@push('js')
    {{-- axios cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
        integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const isEditable = {{ $isEditable ? 'true' : 'false' }};

        const getDistricts = (division_id, select_district = null) => {

            $('#thana_id').empty().append(`<option>Select thana...</option>`).attr('disabled', 'disabled');

            axios.get(`${window.location.origin}/get-districts/${division_id}`).then(res => {

                let districts = res.data;

                let all_districts = $('#district_id');

                if (isEditable) {
                    all_districts.removeAttr('disabled');
                }
                all_districts.empty();
                all_districts.append(`<option>Select district...</option>`);

                districts.map((district, index) => {

                    all_districts.append(
                        `<option value="${district.id}" ${select_district == district.id ? 'selected' : '' }>${district.name}</option>`
                    );
                });
            });
        }

        const getThanas = (district_id, select_thana = null) => {

            axios.get(`${window.location.origin}/get-thanas/${district_id}`).then(res => {

                let thanas = res.data;

                let all_thanas = $('#thana_id');

                if (isEditable) {
                    all_thanas.removeAttr('disabled');
                }
                all_thanas.empty();
                all_thanas.append(`<option>Select thana...</option>`);

                thanas.map((thana, index) => {

                    all_thanas.append(
                        `<option value="${thana.id}" ${select_thana == thana.id ? 'selected' : ''}>${thana.name}</option>`
                    );
                });
            });
        }

        $('#division_id').on('change', function() {
            getDistricts($(this).val());
        });

        $('#district_id').on('change', function() {
            getThanas($(this).val());
        });
    </script>
@endpush

@if (!empty($profile))
    @push('js')
        <script>
            getDistricts('{{ $profile->division_id }}', '{{ $profile->district_id }}');
            getThanas('{{ $profile->district_id }}', '{{ $profile->thana_id }}');
        </script>
    @endpush
@endif

{{--  notification message toast --}}
@if (session('msg'))
    @push('js')
        <script>
            Swal.fire({
                position: "top-end",
                icon: '{{ session('notification_color') }}',
                toast: true,
                title: '{{ session('msg') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endpush
@endif
