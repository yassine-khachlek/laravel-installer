@extends('Yk\LaravelInstaller::layouts.app')

@section('content')
<form action="" method="POST">
  {{ method_field('POST') }}
  {{ csrf_field() }}

  @foreach($fields as $field)
  <div class="form-group">
    <label for="{{ $field['name'] }}">{{ $field['name'] }}</label>
    <input name="{{ $field['name'] }}" type="text" class="form-control" id="{{ $field['name'] }}" value="{{ $field['value'] }}" placeholder="{{ $field['name'] }}">
  </div>
  @endforeach

  <button type="submit" class="btn btn-primary btn-lg btn-block">Install</button>
</form>
@append