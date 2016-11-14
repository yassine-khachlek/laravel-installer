@extends('Yk\LaravelInstaller::layouts.app')

@section('scripts')
<script type="text/javascript">
$(function() {
  	window.location.href = "{{ url('/install') }}";
});
</script>
@append