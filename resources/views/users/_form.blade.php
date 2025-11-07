<div class="card-body">
    <div class="form-group row">
        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', $user->name ?? null, ['class' => 'form-control', 'required', 'placeholder' => "Enter name"]) !!}
        </div>
        @error('name')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('phone_number', $user->phone_number ?? null, ['class' => 'form-control', 'required', 'placeholder' => "Enter phone number"]) !!}
        </div>
        @error('phone_number')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('email', $user->email ?? null, ['class' => 'form-control', 'required', 'placeholder' => "Enter email"]) !!}
        </div>
        @error('email')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Password"]) !!}
        </div>
        @error('password')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('user_type_id', 'Type', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('user_type_id', $type, $user->user_type_id ?? null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a type']) !!}
        </div>
        @error('user_type_id')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('verified', 'Verified', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            <div class="form-check">
                {!! Form::hidden('verified', 0) !!}
                {!! Form::checkbox('verified', 1, isset($user) ? $user->verified : null, ['class' => 'form-check-input', 'id' => 'verified_checkbox']) !!}
            </div>
        </div>
        @error('verified')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="form-group row">
        {!! Form::label('email_verified', 'Email Verified', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            <div class="form-check">
                {!! Form::hidden('email_verified', 0) !!}
                {!! Form::checkbox('email_verified', 1, isset($user) ? $user->email_verified : null, ['class' => 'form-check-input', 'id' => 'email_verified_checkbox']) !!}
            </div>
        </div>
        @error('email_verified')
        <p class="text-danger text-xs mt-1">
            {{ $message }}
        </p>
        @enderror
    </div>

</div>
