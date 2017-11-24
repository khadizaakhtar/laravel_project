@extends('layout')
@section('mainContant')

@if(Session::has('message'))
  <div class="row">
  	<div class="col-md-4">
  		
  
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>You are {{ Session::get('message') }}</strong> 
</div>
	</div>
  </div>
@endif

<br>
<div class="row">

<div class="col-md-8 col-md-offset-2">
<h3>Create User Account</h3>
<br>
{{Form::open(array('action'=>'HomeController@signup', 'class'=>'form-horizontal col-sm-12', 'enctype'=>'multipart/form-data'))}}
<div class="form-group">
    <label class="col-sm-3 control-label">First Name</label>
    <label style="color:red;font-size:19px">*</label>
  <div class="col-sm-8">  
  {{Form::text('firstname','',array('class'=>'form-control','placeholder'=>'Enter your first Name'))}}
  <h5 style="color:red">@if($errors->has('firstname')){{$errors->first('firstname')}}@endif</h5>
  </div>  
  </div>


  <div class="form-group">
    <label class="col-sm-3 control-label">Last Name</label>
    <label style="color:red;font-size:19px
">*</label>
    <div class="col-sm-8">
    <input type="text" name="lastname" class="form-control" value="{{Input::get('lastname')}}" placeholder="Enter Last Name">
    <h5 style="color:red">@if($errors->has('lastname')){{$errors->first('lastname')}}@endif</h5>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Usesr Name</label>
    <label style="color:red;font-size:19px
">*</label>
    <div class="col-sm-8">
    <input type="text" name="user_name" value="{{Input::get('user_name')}}" class="form-control" placeholder="Enter User Name">
    <h5 style="color:red">@if($errors->has('user_name')){{$errors->first('user_name')}}@endif</h5>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Mobile Number</label>
    <label style="color:red;font-size:19px
">*</label>
    <div class="col-sm-8">
    <input type="text" name="mobile" value="{{Input::get('mobile')}}" class="form-control" placeholder="Enter Mobile Number">
    <h5 style="color:red">@if($errors->has('mobile')){{$errors->first('mobile')}}@endif</h5>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Email address</label>
    <label style="color:red;font-size:19px
">*</label>
    <div class="col-sm-8">
    <input type="email" name="email" value="{{Input::get('email')}}" class="form-control"  placeholder="Enter email">
    <h5 style="color:red">@if($errors->has('email')){{$errors->first('email')}}@endif</h5>   
  </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">Retype Email address</label>
    <label style="color:red;font-size:19px
">*</label>
    <div class="col-sm-8">
    <input type="email" name="reemail" value="{{Input::get('reemail')}}" class="form-control"  placeholder="Retype Enter email">
    <h5 style="color:red">@if($errors->has('reemail')){{$errors->first('reemail')}}@endif</h5>
    
  </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">Password</label>
    <label style="color:red;font-size:19px
">*</label>
    <div class="col-sm-8">
    <input type="password" name="Password" value="{{Input::get('Password')}}" class="form-control"  placeholder="Password">
    <h5 style="color:red">@if($errors->has('Password')){{$errors->first('Password')}}@endif</h5>
    
  </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">Confirmation Password</label>
    <label style="color:red;font-size:19px
">*</label>
    <div class="col-sm-8">
    <input type="password" name="Password_confirmation" value="{{Input::get('Password_confirmation')}}" class="form-control"  placeholder="Password">
    <h5 style="color:red">@if($errors->has('Password_confirmation')){{$errors->first('Password_confirmation')}}@endif</h5>
    
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Address</label>
    <div class="col-sm-8">
    <textarea class="form-control" placeholder="Enter your Address" name="address">{{Input::get('address')}}</textarea>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Profile Picture</label>
    <label style="color:red;font-size:19px
">*</label>
    <div class="col-sm-8">
    <input type="file" name="image" class="btn btn-primary">
    <h5 style="color:red">@if($errors->has('image')){{$errors->first('image')}}@endif</h5>
    
  </div>
  </div>

 <div class="form-group col-sm-8">
  <input type="submit" name="submit" value="Sign Up" class="btn btn-success col-sm-2 col-sm-offset-5">
 	
 </div>
{{Form::close()}}	
</div>    
</div>		
@stop