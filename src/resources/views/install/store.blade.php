@extends('Yk\LaravelInstaller::layouts.app')

@section('content')

<a href="{{ url('/') }}" class="btn btn-primary btn-lg btn-block">
	Home
</a>

<br>

@foreach( $output as $m )
<div class="alert alert-success" role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	{{ $m }}
</div>
@endforeach

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">.env</h3>
  </div>
  <div class="panel-body">

	<pre><code>{{ $env }}</code></pre>

  </div>
</div>

@append