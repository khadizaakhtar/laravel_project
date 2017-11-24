@extends('layout')
@section('mainContant')

<?php 
$about = DB::table('tbl_cms')->where('content_id',2)->first();
?>
<h1>{{ucfirst($about->content_title);}}</h1>
<p>{{$about->content_description}}</p>
@stop