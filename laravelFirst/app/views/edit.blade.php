@extends('layout')
@section('mainContant')
<h2>Edit Contact </h2>


@if(Session::has('message'))
    <div class="alert-box success">
        <h2>{{ Session::get('message') }}</h2>
    </div>
@endif


<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>
<br>

@foreach($info as $einfo)

<!-- {{Form::open(array('url'=>'contact'))}} -->
{{Form::open(array('action'=>'HomeController@updateContact', 'url'=>'updateContact', 'class'=>'form-horizontal col-sm-6'))}}
<div class="form-group">
{{Form::label('name','Name',array('class' => 'col-sm-2 control-label'))}}
<div class="col-sm-8">
{{Form::hidden('id',$einfo->id,array('class'=>'form-control', 'placeholder'=>'Enter your name'))}}
{{Form::text('name',$einfo->name,array('class'=>'form-control', 'placeholder'=>'Enter your name'))}}
</div>
</div>
<div class="form-group">
{{Form::label('email','E-mail',array('class' => 'col-sm-2 control-label'))}}
<div class="col-sm-8">
{{Form::text('email',$einfo->email,array('class'=>'form-control','placeholder'=>'Enter your email'))}}
</div>
</div>
<div class="form-group">
{{Form::label('mobile','Mobile',array('class' => 'col-sm-2 control-label'))}}
<div class="col-sm-8">
{{Form::text('mobile',$einfo->mobile,array('class'=>'form-control','placeholder'=>'Enter mobile number'))}}
</div>
</div>
<div class="form-group">
{{Form::label('message','Message',array('class' => 'col-sm-2 control-label'))}}
<div class="col-sm-8">
{{Form::textarea('message',$einfo->message,array('class'=>'form-control','placeholder'=>'Enter text message'))}}
</div>
</div>

 <div class="form-group">
    <div class="col-sm-offset-2 col-sm-12">
      {{Form::submit('Update',array('class'=>'btn btn-success btn-lg'))}}
    </div>
  </div>
{{Form::close()}}

@endforeach

@stop
