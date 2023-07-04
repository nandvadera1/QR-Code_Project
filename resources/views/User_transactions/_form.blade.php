<div class="card-body">
    <div class="form-group row">
        {!! Form::label('code', 'Code', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('description', null, ['class' => 'form-control', 'required', 'placeholder' => "Enter code"]) !!}
        </div>
        @error('code')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>
</div>
