<div class="card-body">
    <div class="form-group row">
        {!! Form::label('category_id', 'Category', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            @if(isset($product))
                {!! Form::select('category_id', $categoryType, $categoryID ?? null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a type', 'disabled' => 'disabled']) !!}
            @else
                {!! Form::select('category_id', $categoryType, $categoryID ?? null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a type']) !!}
            @endif
        </div>
        @error('password')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', $campaign->name ?? null, ['class' => 'form-control', 'required', 'placeholder' => "Enter name"]) !!}
        </div>
        @error('name')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

{{--    <div class="form-group row">--}}
{{--        {!! Form::label('is_enabled', 'Is Enabled', ['class' => 'col-sm-2 col-form-label']) !!}--}}
{{--        <div class="col-sm-10">--}}
{{--            {!! Form::number('is_enabled', $campaign->is_enabled ?? null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 1, 'step' => 1, 'placeholder' => "Enter 1 or 0"]) !!}--}}
{{--        </div>--}}
{{--        @error('is_enabled')--}}
{{--        <p class="text-danger text-xs mt-1">--}}
{{--            {{ $message }}--}}
{{--        </p>--}}
{{--        @enderror--}}
{{--    </div>--}}

    <div class="form-group row">
        {!! Form::label('is_enabled', 'Enabled', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            <div class="form-check">
                {!! Form::hidden('is_enabled', 0) !!}
                {!! Form::checkbox('is_enabled', 1, $campaign->is_enabled ?? null, ['class' => 'form-check-input', 'id' => 'is_enabled_checkbox']) !!}
                {!! Form::label('is_enabled_checkbox', ' Enable the campaign', ['class' => 'form-check-label']) !!}
            </div>
        </div>
        @error('is_enabled')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('start_at', 'Start Date', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::date('start_at', $campaign->start_at ?? null, ['class' => 'form-control', 'required']) !!}
        </div>
        @error('start_at')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('end_at', 'End Date', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::date('end_at', $campaign->end_at ?? null, ['class' => 'form-control', 'required']) !!}
        </div>
        @error('end_at')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('amount', 'Amount', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('amount', $campaign->amount ?? null, ['class' => 'form-control', 'required', 'placeholder' => "Enter amount"]) !!}
        </div>
        @error('amount')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('products', 'Products', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('products[]', $productType, $selectedProducts ?? null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'required']) !!}
        </div>
        @error('products')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

</div>
