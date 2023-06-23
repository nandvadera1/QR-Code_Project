<div class="card-body">
    <div class="form-group row">
        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', $product->name ?? null, ['class' => 'form-control', 'required', 'placeholder' => "Enter name"]) !!}
        </div>
        @error('name')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

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
</div>
