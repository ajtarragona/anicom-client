@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Anicom Home')
@endsection



@section('breadcrumb')
    @breadcrumb([
    	'items'=> [
    		['name'=>__("Anicom")]
    	]
    ])
@endsection


@section('menu')
   @include('anicom-client::menu')
@endsection


@section('body')
HOLA
@endsection


@section('style')
	<link href="{{ asset('vendor/ajtarragona/css/anicom.css') }}" rel="stylesheet">
@endsection


@section('js')
	<script src="{{ asset('vendor/ajtarragona/js/anicom.js')}}" language="JavaScript"></script>
@endsection
