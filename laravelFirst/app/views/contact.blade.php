@extends('layout')
@section('mainContant')
<?php 
$contact = DB::table('tbl_cms')->where('content_id',1)->first();
?>
<h2>{{ucfirst($contact->content_title)}}</h2>
<p>
{{$contact->content_description}}
</p>

@if(Session::has('message'))
  <div class="row">
  	<div class="col-md-4">
  		
  
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>You are Successfully  {{ Session::get('message') }}</strong> 
</div>
	</div>
  </div>
@endif


<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>
<br>
<!-- {{Form::open(array('url'=>'contact'))}} -->
{{Form::open(array('action'=>'HomeController@contact', 'class'=>'form-horizontal col-sm-12'))}}
<!-- <form action="{{ URL::to('contact');}}" class="form-horizontal col-sm-6" method="post"> -->

<div class="form-group">
{{Form::label('name','Name',array('class' => 'col-sm-2 control-label'))}}
<label style="color:red;font-size:21px">*</label>
<div class="col-sm-8">
{{Form::text('name','',array('class'=>'form-control', 'placeholder'=>'Enter your name'))}}
</div>
</div>

<div class="form-group">
{{Form::label('email','E-mail',array('class' => 'col-sm-2 control-label'))}}
<label style="color:red;font-size:21px">*</label>
<div class="col-sm-8">
{{Form::text('email','',array('class'=>'form-control','placeholder'=>'Enter your email'))}}
</div>
</div>

<div class="form-group">
{{Form::label('Mobile','',array('class' => 'col-sm-2 control-label'))}}
<label style="color:red;font-size:21px">*</label>
<div class="col-sm-8">
{{Form::text('mobile','',array('class'=>'form-control','placeholder'=>'Enter mobile number'))}}
</div>
</div>

<div class="form-group">
{{Form::label('Message','message',array('class' => 'col-sm-2 control-label'))}}
<label style="color:red;font-size:21px">*</label>
<div class="col-sm-8">
{{Form::textarea('message','',array('class'=>'form-control','placeholder'=>'Enter text message'))}}
</div>
</div>

 <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {{Form::submit('Send Message',array('class'=>'btn btn-success'))}}
    </div>
  </div>

{{Form::close()}}

@stop
