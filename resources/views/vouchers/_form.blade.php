<div class="card-body">
    <div class="form-group row">
        {!! Form::label('campaign_id', 'Campaign', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('campaign_id', $campaignId, $campaignId ?? null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a campaign']) !!}
        </div>
        @error('password')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('number', 'Number of Vouchers', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('amount', null, ['class' => 'form-control', 'required', 'placeholder' => "Enter number of vouchers"]) !!}
        </div>
        @error('amount')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

</div>
