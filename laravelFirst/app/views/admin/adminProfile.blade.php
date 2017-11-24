@extends('admin/layout')
@section('mainContent')

<h2>View and Edit Account</h2>
<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>

@if(Session::has('msg'))
{{Session::get('msg');}}
@endif

<div class="row">
@foreach($adminData as $ainfo)
<div class="col-sm-8">
{{Form::open(array('action'=>'AdminController@profile','enctype'=>'multipart/form-data'))}}
  <div class="form-group col-sm-12">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" name="firstname" value="{{$ainfo->firstname}}" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
  </div>

  <div class="form-group col-sm-12">
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" name="lastname" value="{{$ainfo->lastname}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name">
  </div>

  <div class="form-group col-sm-12">
    <label for="exampleInputEmail1">Usesr Name</label>
    <input type="text" name="username" value="{{$ainfo->username}}" class="form-control" id="exampleInputEmail1" placeholder="Username email">
  </div>

  <div class="form-group col-sm-12">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" value="{{$ainfo->email}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
  </div>

  <div class="form-group col-sm-12">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" >
  </div>
 
  <div class="form-group col-sm-12">
    <label for="exampleInputFile">Profile Picture</label>
    <input type="file" name="image" id="exampleInputFile" class="btn btn-primary">
  </div>

 <div class="form-group col-sm-12">
  <input type="submit" name="submit" value="Update Profile" class="btn btn-success col-sm-1.5">
 	
 </div>
{{Form::close()}}
 
@endforeach
</div>
<div class="col-sm-4">
        <img src="{{URL::to('images/'.$ainfo->image)}}" class="img-responsive">
</div>
</div>

  
@stop