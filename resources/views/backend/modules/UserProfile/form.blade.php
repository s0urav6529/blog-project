{!! Form::label('phone', 'Phone') !!}
{!! Form::text('phone', null, [
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Enter phone number...',
]) !!}

<div class="row">
    <div class="col-md-4">
        {!! Form::label('division_id', 'Division', ['class' => 'mt-2']) !!}
        {!! Form::select('division_id', $divisions, null, [
            'id' => 'division_id',
            'class' => 'form-select mt-1',
            'placeholder' => 'Select division...',
        ]) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('district_id', 'District', ['class' => 'mt-2']) !!}
        <select name="district_id" id="district_id" class="form-select mt-1" disabled>
            <option selected="selected">Select district...</option>
        </select>
    </div>
    <div class="col-md-4">
        {!! Form::label('thana_id', 'Upazila/Thana', ['class' => 'mt-2']) !!}
        {!! Form::select('division_id', $divisions, null, [
            'id' => 'divi_id',
            'class' => 'form-select mt-1',
            'placeholder' => 'Select thana...',
        ]) !!}
    </div>
</div>

{!! Form::label('address', ' Address', ['class' => 'mt-2']) !!}
{!! Form::textarea('address', null, [
    'class' => 'form-control form-control-sm mt-1',
    'placeholder' => 'Write address...',
    'rows' => '5',
]) !!}



@push('js')
    {{-- axios cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
        integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        const getDistricts = (division_id) => {



            axios.get(`${window.location.origin}/get-districts/${division_id}`).then(res => {

                let districts = res.data;

                let all_districts = $('#district_id');

                all_districts.removeAttr('disabled');
                all_districts.empty();
                all_districts.append(`<option value= "" >Select district..</option>`);

                districts.map((district, index) => {

                    all_districts.append(
                        `<option value="${district.id}">${district.name}</option>`);
                });
            });
        }

        $('#division_id').on('change', function() {
            getDistricts($(this).val());
        });
    </script>
@endpush
