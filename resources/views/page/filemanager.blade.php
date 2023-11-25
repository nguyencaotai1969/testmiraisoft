@extends('master')
@section('title','File Manager')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <style type="text/css">
    
	@media only screen and (min-width:767px){
     	.row-content{
		   line-height: 100px;
		}
  	}
    </style>
@endsection
@section('content')
  	<div id="app">

        <app></app>        
    </div>

    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="{{ asset('js/app.js') }}?v={{ time() }}"></script>

@endsection