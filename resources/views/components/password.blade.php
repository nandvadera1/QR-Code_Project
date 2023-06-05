<div class="form-group">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => 'Password']) !!}
</div>
@error('password')
<p class="text-danger text-xs mt-1">
    {{ $message }}
</p>
@enderror
