@props(['name' , 'user'])

<div class="form-group">
    {!! Form::label($name,ucwords($name)) !!}
    {!! Form::text($name, isset($user) ? $user->$name : old($name, ''), ['class' => 'form-control', 'required', 'placeholder' => "Enter $name"]) !!}
</div>

<x-error name="{{ $name }}" />
