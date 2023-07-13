<div class="card-body">
    <div class="form-group row">
        {!! Form::label('user_id', 'User', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('user_id', $userId, null, ['class' => 'form-control', 'required', 'placeholder' => 'Select User', 'id' => 'userSelect']) !!}
        </div>
        @error('user_id')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row" id="pointsAvailable" style="display: none">
        {!! Form::label('pointsAvailable', 'User`s Current Balance', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('pointsAvailable', null, ['class' => 'form-control', 'required', 'placeholder' => 'Enter points', 'id'=>'value', 'disabled']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('points', 'Points', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('points', null, ['class' => 'form-control', 'required', 'placeholder' => "Enter points"]) !!}
        </div>
        @error('points')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('description', 'Code', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('description', null, ['class' => 'form-control', 'required', 'placeholder' => "Enter code"]) !!}
        </div>
        @error('description')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>
</div>

@section('js')
    <script>
        const userSelect = document.getElementById('userSelect');

        userSelect.addEventListener('change', function() {
            const user = this.value;

            const pointsAvailable = document.getElementById('pointsAvailable');

            pointsAvailable.style.display = user ? 'flex' : 'none';

            $.ajax({
                type: 'GET',
                url: '/admin/transactions/points/' + user,
                data: user,
                success: function (data){
                    value.value = data;
                }
            })
        });

    </script>
@endsection
