@extends('layout')

@section('mainContant')
<div class="row">
<div class="col-md-8 col-md-offset-2">
@if(Session::has('msg'))
<div class="alert alert-success" role="alert">{{Session::get('msg')}}</div>
@endif
<div class="panel panel-primary">
  <div class="panel-heading"><b>Delivery Address</div>
  <div class="panel-body">

<h4>

<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>
</h4>
   {{Form::open(array('action'=>'CartController@delivery'))}}

   <div class="form-group">
   <label>Name</label>
   	<input type="text" name="name" class="form-control" placeholder="Enter your name..." /> 
   </div>

   <div class="form-group">
   <label>Mobile Number</label>
   	<input type="text" name="mobile" class="form-control" placeholder="Enter your mobile..." /> 
   </div>

   <div class="form-group">
   <label>Email Address</label>
   	<input type="text" name="email" class="form-control" placeholder="Enter your email..." /> 
   </div>

   <div class="form-group">
   <label>city</label>
   	<input type="text" name="city" class="form-control" placeholder="Enter your city..." /> 
   </div>

   <div class="form-group">
   <label>Area</label>
   	<input type="text" name="area" class="form-control" placeholder="Enter your area..." /> 
   </div>

   <div class="form-group">
   <label>Full Address</label>
   	<input type="text" class="form-control" name="address" placeholder="Enter your full address..." /> 
   </div>

   <input type="submit" name="submit" class="btn btn-primary" value="Send Your Order">

   {{Form::close();}}
  </div>
</div>
</div>
</div>



@stop