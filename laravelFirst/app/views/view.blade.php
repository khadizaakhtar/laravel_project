@extends('layout')
@section('mainContant')
	<h1>View Information</h1>
	@if(Session::has('message'))
<div class="alert alert-info" role="alert">
	{{Session::get('message')}}
</div>


@endif
<div class="table-responsive">	
     <table class="table table-striped">
       <tr class="info">
       	<td>Name</td>
       	<td>Email Address</td>
       	<td>Phone</td>
       	<td>Message</td>
       	<td width="120px;">Action</td>
       </tr>
       @foreach($info as $vinfo)
        <tr>
        	<td>{{$vinfo->name}}</td>
        	<td>{{$vinfo->email}}</td>
        	<td>{{$vinfo->mobile}}</td>
        	<td>{{$vinfo->message}}</td>
        	<td>
          <a href="{{URL::to('/deleteContact/')}}<?php echo "/". $vinfo->id?>" onclick="return chackDelete()" class="label label-danger">delete</a>

            <a href="{{URL::to('/editContact/'.$vinfo->id)}}" class="label label-primary" >Edit</a></td>
        </tr>
       	
       @endforeach
	 </table>
	 </div>

 

@stop
