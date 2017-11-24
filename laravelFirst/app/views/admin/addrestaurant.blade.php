@extends('layout');
@section('mainContant')


<script>
$(document).ready(function() {
    $("#e4").select2({
	  placeholder: '..:: Select Product Category ::..',
    });

    $("#cu").select2({
      maximumSelectionSize: 4,
      placeholder: '..:: Select Restaurant Cuisine ::..',
    });
});

</script>

<div class="row">
<!-- <h4 style="color:red">{{HTML::ul($errors->all())}}</h4> -->

@if(Session::has('restaurant_msg'))
<div class="alert alert-success" role="alert">{{Session::get('restaurant_msg')}}</div>

@endif

{{Form::open(array('action'=>'RestaurantController@addrestaurant','enctype'=>'multipart/form-data'))}}

<div class="col-md-6">
<h3>Restaurant Information</h3>

  <div class="form-group">
    <label >Restaurant Name </label>
    <span style="color:red; font-size:21px;">*</span>
    <input type="text" name="name" value="{{Input::get('name')}}"  class="form-control"  placeholder="Enter Restaurant Name">
    <label style="color:red">@if($errors->has('name')){{$errors->first('name')}}@endif</label>
  </div>

<div class="form-group ">
    <label>Restaurant Cuisine</label>
    <span style="color:red; font-size:21px;">*</span>

   <select id="cu" style="Padding: 0px;" class="col-md-12" name="cuisine[]" multiple>
      @foreach($cusine as $cuinfo)
      <option value="{{$cuinfo->cuisineID}}">{{$cuinfo->cuisine_name}}</option>
      @endforeach
    </select>
    <br><label style="color:red">@if($errors->has('cuisine')){{$errors->first('cuisine')}}@endif</label>

  </div>

  <div class="form-group ">
  <br><br>
    <label>Restaurant Location</label>
    <span style="color:red; font-size:21px;">*</span>

   <select class="form-control" name="location">
      <option value="">..:: Select Restaurant Location ::..</option>
      @foreach($location as $linfo)
      <option value="{{$linfo->location_id}}" @if($linfo->location_id == Input::get('location')){{"selected";}}@endif >{{$linfo->location_name}}</option>
      @endforeach
    </select>
   <label style="color:red">@if($errors->has('location')){{$errors->first('location')}}@endif</label>

  </div>

<div class="form-group ">
    <label >Restaurant Rating</label>
    <span style="color:red; font-size:21px;">*</span>

    <select class="form-control" style="Padding: 0px;" name="rating">
      <option value="">....:: Select Restaurant Rating ::....</option>
      <option value="1" @if(Input::get('rating')== 1){{"selected";}}@endif >1</option>
      <option value="2" @if(Input::get('rating')== 2){{"selected";}}@endif >2</option>
      <option value="3" @if(Input::get('rating')== 3){{"selected";}}@endif >3</option>
      <option value="4" @if(Input::get('rating')== 4){{"selected";}}@endif >4</option>
      <option value="5" @if(Input::get('rating')== 5){{"selected";}}@endif>5</option>
      <option value="6" @if(Input::get('rating')== 6){{"selected";}}@endif>6</option>
    </select>
    <label style="color:red">@if($errors->has('rating')){{$errors->first('rating')}}@endif</label>

  </div>

 <div class="form-group ">
    <label>Restaurant Product Category</label>
    <span style="color:red; font-size:21px;">*</span>

   <select id="e4" class="col-md-12" style="Padding: 0px;" name="category[]" multiple>
      @foreach($category as $cinfo)
      <option value="{{$cinfo->category_id}}">{{$cinfo->category_name}}</option>
      @endforeach
    </select>
    <br><label style="color:red">@if($errors->has('category')){{$errors->first('category')}}@endif</label>

  </div>

<div class="form-group ">
<br><br>
    <label>Restaurant Offer Schedule </label>
    <input type="text" name="offer" class="form-control" value="{{Input::get('offer')}}" placeholder="Restaurant offer and schedule"> 
    <label style="color:red">@if($errors->has('offer')){{$errors->first('offer')}}@endif</label>

  </div>

<div class="form-group ">
<label>Restaurant sponsor for Searching </label>
    <span style="color:red; font-size:21px;">* &nbsp;&nbsp;&nbsp;&nbsp;</span>

<label class="radio-inline">
  <input type="radio" name="sponsor" id="inlineRadio1" value="yes" @if(Input::get('sponsor')== "yes"){{"checked";}}@endif > YES
</label>
<label class="radio-inline">
  <input type="radio" name="sponsor" id="inlineRadio2" value="no" @if(Input::get('sponsor')== "no"){{"checked";}}@endif > NO
</label>
    <label style="color:red">@if($errors->has('sponsor')){{$errors->first('sponsor')}}@endif</label>

</div>

  <div class="form-group ">
    <label >Restaurant full Address</label>
    <span style="color:red; font-size:21px;">*</span>

    <textarea class="form-control"  name="address" rows="5">{{Input::get('address')}}</textarea>
    <label style="color:red">@if($errors->has('address')){{$errors->first('address')}}@endif</label>

  </div>
  
  <div class="form-group ">
    <label >Restaurant Logo</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="file" name="rimage"  class="btn btn-primary" >
    <label style="color:red">@if($errors->has('rimage')){{$errors->first('rimage')}}@endif</label>

  </div>

</div>



<div class="col-md-6">
<h3>Your Information</h3>

<div class="form-group ">
    <label >First Name</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="text" name="firstname" class="form-control" value="{{Input::get('firstname')}}" placeholder="Enter First Name">
    <label style="color:red">@if($errors->has('firstname')){{$errors->first('firstname')}}@endif</label>
  
  </div>

  <div class="form-group">
    <label >Last Name</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="text" name="lastname" class="form-control" value="{{Input::get('lastname')}}"  placeholder="Enter Last Name">
    <label style="color:red">@if($errors->has('lastname')){{$errors->first('lastname')}}@endif</label>
  
  </div>

  <div class="form-group ">
    <label >Usesr Name</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="text" name="username" class="form-control" value="{{Input::get('username')}}" placeholder="Username email">
    <label style="color:red">@if($errors->has('username')){{$errors->first('username')}}@endif</label>
  
  </div>

  <div class="form-group">
    <label >Email address</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="email" name="email" class="form-control" value="{{Input::get('email')}}" placeholder="Enter email">
    <label style="color:red">@if($errors->has('email')){{$errors->first('email')}}@endif</label>
  
  </div>

  <div class="form-group">
    <label >Retype Email address</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="email" name="retype_email" class="form-control" value="{{Input::get('retype_email')}}" placeholder="Enter retype email">
    <label style="color:red">@if($errors->has('retype_email')){{$errors->first('retype_email')}}@endif</label>
  
  </div>

  <div class="form-group">
    <label >Password</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="password" name="password" class="form-control" value="{{Input::get('password')}}" placeholder="Password">
    <label style="color:red">@if($errors->has('password')){{$errors->first('password')}}@endif</label>
  
  </div>

  <div class="form-group">
    <label >Retype Password</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="password" name="retype_password" class="form-control" value="{{Input::get('retype_password')}}" placeholder="Retype Password">
    <label style="color:red">@if($errors->has('retype_password')){{$errors->first('retype_password')}}@endif</label>
  
  </div>

  <div class="form-group ">
    <label for="exampleInputFile">Profile Picture</label>
    <span style="color:red; font-size:21px;">*</span>

    <input type="file" name="pimage" id="exampleInputFile" class="btn btn-primary">
    <label style="color:red">@if($errors->has('pimage')){{$errors->first('pimage')}}@endif</label>
  
  </div>

</div>

 <div class="form-group col-sm-7 pull-right">
  <input type="submit" name="submit" value="Add Restaurant" class="btn btn-success col-sm-3">
 </div>
{{Form::close()}}

</div>

@stop