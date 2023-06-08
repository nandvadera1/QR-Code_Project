<div class="card-body">

    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $user->name ?? null, ['class' => 'form-control', 'required', 'placeholder' => "Enter name"]) !!}
    </div>
    @error('name')
    <p class="text-danger text-xs mt-1">
        {{ $message }}
    </p>
    @enderror

    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', $user->email ?? null, ['class' => 'form-control', 'required', 'placeholder' => "Enter email"]) !!}
    </div>
    @error('email')
    <p class="text-danger text-xs mt-1">
        {{ $message }}
    </p>
    @enderror

    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => 'Password']) !!}
    </div>
    @error('password')
    <p class="text-danger text-xs mt-1">
        {{ $message }}
    </p>
    @enderror

    <div class="form-group">
        {!! Form::label('user_type_id', 'Type') !!}
        {!! Form::select('user_type_id', $type, $user->user_type_id ?? null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a type']) !!}
    </div>
    @error('user_type_id')
    <p class="text-danger text-xs mt-1">
        {{ $message }}
    </p>
    @enderror

</div>


