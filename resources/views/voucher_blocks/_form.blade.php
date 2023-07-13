<div class="card-body">
    <div class="form-group row">
        {!! Form::label('campaign_id', 'Campaign', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('campaign_id', $campaignId, null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a type']) !!}
        </div>
        @error('campaign_id')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => "Enter name"]) !!}
        </div>
        @error('name')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('amount', 'Number of Vouchers', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('amount', null, ['class' => 'form-control', 'required', 'placeholder' => "Enter amount"]) !!}
        </div>
        @error('amount')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

</div>
