@extends('admin/layout');
@section('mainContent');
<h2>Create New Account</h2>
<!-- <h5 style="color:red">{{HTML::ul($errors->all())}}</h5> -->

@if(Session::has('message'))
  <div class="alert alert-success">{{Session::get('message');}}</div>
@endif


<br>
{{Form::open(array('action'=>'AdminController@createAdmin','enctype'=>'multipart/form-data','class'=>'form-horizontal'))}}
  <div class="form-group">
    <label class="col-sm-2 control-label">First Name</label>
    <label style="color:red;font-size:18px;">*</label>
    <div class="col-sm-8">
    <input type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
    <h5 style="color:red">@if($errors->has('firstname')){{$errors->first('firstname')}}@endif</h5>
  </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-2 control-label">Last Name</label>
    <label style="color:red;font-size:18px;">*</label>
    <div class="col-sm-8">
    <input type="text" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name">
    <h5 style="color:red">@if($errors->has('lastname')){{$errors->first('lastname')}}@endif</h5>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Usesr Name</label>
    <label style="color:red;font-size:18px;">*</label>
    <div class="col-sm-8">
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username email">
    <h5 style="color:red">@if($errors->has('username')){{$errors->first('username')}}@endif</h5>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Email address</label>
    <label style="color:red;font-size:18px;">*</label>
    <div class="col-sm-8">
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    <h5 style="color:red">@if($errors->has('email')){{$errors->first('email')}}@endif</h5>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Retype Email address</label>
    <label style="color:red;font-size:18px;">*</label>
    <div class="col-sm-8">
    <input type="email" name="retype_email" class="form-control" id="exampleInputEmail1" placeholder="Enter retype email">
    <h5 style="color:red">@if($errors->has('retype_email')){{$errors->first('retype_email')}}@endif</h5>
  </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-2 control-label">Password</label>
    <label style="color:red;font-size:18px;">*</label>
    <div class="col-sm-8">
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <h5 style="color:red">@if($errors->has('password')){{$errors->first('password')}}@endif</h5>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Retype Password</label>
    <label style="color:red;font-size:18px;">*</label>
    <div class="col-sm-8">
    <input type="password" name="retype_password" class="form-control" id="exampleInputPassword1" placeholder="Retype Password">
    <h5 style="color:red">@if($errors->has('retype_password')){{$errors->first('retype_password')}}@endif</h5>
  </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-2 control-label">Profile Picture</label>
    <div class="col-sm-8">
    <input type="file" name="image" id="exampleInputFile" class="btn btn-primary">
  </div>
  </div>

 <div class="form-group col-sm-8">
  <input type="submit" name="submit" value="Create New Admin" class="btn btn-success col-sm-3 col-sm-offset-8">
 	
 </div>
{{Form::close()}}
@stop