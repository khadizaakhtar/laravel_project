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
<div class="row">
@foreach($user as $uinfo)

<div class="col-md-6 col-md-offset-2">
<br>
<h3>Account Settings</h3>
<br>

{{Form::open(array('action'=>'HomeController@setting','enctype'=>'multipart/form-data'))}}
<div class="form-group col-sm-10">
    <label >First Name</label>
    <input type="text" name="firstname" value="{{$uinfo->firstname}}" class="form-control" placeholder="Enter First Name">
    <h5 style="color:red">@if($errors->has('firstname')){{$errors->first('firstname')}}@endif</h5>
  </div>

  <div class="form-group col-sm-10">
    <label>Last Name</label>
    <input type="text" name="lastname" class="form-control" value="{{$uinfo->lastname}}"  placeholder="Enter Last Name">
    <h5 style="color:red">@if($errors->has('lastname')){{$errors->first('lastname')}}@endif</h5>
  </div>

  <div class="form-group col-sm-10">
    <label >Usesr Name</label>
    <input type="text" name="user_name" value="{{$uinfo->username}}" class="form-control" placeholder="Enter User Name">
    <h5 style="color:red">@if($errors->has('user_name')){{$errors->first('user_name')}}@endif</h5>
   
  </div>

 <div class="form-group col-sm-8">
    <label >Mobile Number</label>
    <input type="text" name="mobile" value="{{$uinfo->user_mobile}}" class="form-control" placeholder="Enter Mobile Number">
    <h5 style="color:red">@if($errors->has('mobile')){{$errors->first('mobile')}}@endif</h5>
  </div>

  <div class="form-group col-sm-10">
    <label >Email address</label>
    <input type="email" name="email" value="{{$uinfo->email}}" class="form-control"  placeholder="Enter email">
    <h5 style="color:red">@if($errors->has('email')){{$errors->first('email')}}@endif</h5>
    
  </div>

  <div class="form-group col-sm-10">
    <label >Retype Email address</label>
    <input type="email" name="reemail" value="{{$uinfo->email}}" class="form-control"  placeholder="Retype Enter email">
    <h5 style="color:red">@if($errors->has('reemail')){{$errors->first('reemail')}}@endif</h5>
    
  </div>

  <div class="form-group col-sm-10">
    <label>New Password</label>
    <input type="password" name="Password" value="{{Input::get('Password')}}" class="form-control"  placeholder="Password">
    
  </div>

  <div class="form-group col-sm-8">
    <label>Address</label>
    <textarea class="form-control" placeholder="Enter your Address" name="address">{{$uinfo->user_address}}</textarea>
    <h5 style="color:red">@if($errors->has('address')){{$errors->first('address')}}@endif</h5>
  </div>

  <div class="form-group col-sm-10">
    <label >Profile Picture</label>
    <input type="file" name="image" class="btn btn-primary">
    <h5 style="color:red">@if($errors->has('image')){{$errors->first('image')}}@endif</h5>
    
  </div>

 <div class="form-group col-sm-10">
  <input type="submit" name="submit" value="Update Account" class="btn btn-success col-sm-1.5">
 	
 </div>
{{Form::close()}}	
</div>

<div class="col-md-2">
<br>
<br>
<br>

 <img src="{{URL::to('/images/'.$uinfo->image)}}" width="80%"> 
</div>
@endforeach
 
</div>		
@stop