@extends('admin/layout');
@section('mainContent');

<script>
$(document).ready(function() {

   $("#e9").select2();
   $("#cu").select2({
    maximumSelectionSize: 4,
   });
});
</script>

<h2>Edit Restaurant</h2>

<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>

@if(Session::has('restaurant_msg'))
{{Session::get('restaurant_msg')}}
@endif


@foreach($restaurant as $rinfo)
{{Form::open(array('action'=>'RestaurantController@editrestaurant','enctype'=>'multipart/form-data'))}}
  <div class="form-group col-sm-8 col-sm-offset-2">
    <label >Restaurant Name</label>
    <label style="color:red;font-size:18px;">*</label>

    <input type="hidden" name="id" value="{{$rinfo->restaurant_id}}">
    <input type="text" name="name" value="{{$rinfo->restaurant_name}}"  class="form-control"  placeholder="Enter Restaurant Name">
  </div>

<div class="form-group col-sm-8 col-sm-offset-2">
    <label>Restaurant Cuisine</label>
   <select id="cu" style="Padding: 0px;" class="col-md-12" name="cuisine[]" multiple="multiple">
   <?php 
   if(count($restaurant_cuisine)>0){
      foreach($restaurant_cuisine as $res_cus){
    ?>
      <option value="{{$res_cus->cuisineID}}" selected="selected"> {{$res_cus->cuisine_name}}</option>

    <?php } 
    foreach($cuisine as $cuinfo){ 
      if(in_array($cuinfo->cuisineID, $get_cui)){ ?>     
    
    <?php }else{ ?>
      <option value="{{$cuinfo->cuisineID}}"> {{$cuinfo->cuisine_name}}</option>     

      <?php } } }else{
      foreach($cuisine as $cisineinfo){?>

      <option value="{{$cisineinfo->cuisineID}}">{{$cisineinfo->cuisine_name}}</option>

      <?php } }?>

    </select>
  </div>

  <div class="form-group col-sm-8 col-sm-offset-2">
    <label>Restaurant Location</label>
    <label style="color:red;font-size:18px;">*</label>

   <select class="form-control" name="location">
      <option value="">..:: Select Restaurant Location ::..</option>
      @foreach($location as $linfo)
      <option value="{{$linfo->location_id}}" @if($linfo->location_id == $rinfo->location_id){{"selected"}}@endif>{{$linfo->location_name}}</option>
      @endforeach
    </select>
  </div>

<div class="form-group col-sm-8 col-sm-offset-2">
    <label >Restaurant Rating</label>
    <label style="color:red;font-size:18px;">*</label>

    <select class="form-control" name="rating">
      <option value="">....:: Select Restaurant Rating ::....</option>
      <option value="1" @if($rinfo->rating == 1){{"selected"}}@endif>1</option>
      <option value="2" @if($rinfo->rating == 2){{"selected"}}@endif>2</option>
      <option value="3" @if($rinfo->rating == 3){{"selected"}}@endif>3</option>
      <option value="4" @if($rinfo->rating == 4){{"selected"}}@endif>4</option>
      <option value="5" @if($rinfo->rating == 5){{"selected"}}@endif>5</option>
      <option value="6" @if($rinfo->rating == 6){{"selected"}}@endif>6</option>
    </select>
  </div>


<div class="form-group col-sm-8 col-sm-offset-2">
    <label>Restaurant Product Category</label>
   <select id="e9" class="col-md-12" style="Padding: 0px;" name="category[]" multiple="multiple" >

      <?php if(count($restaurant_category)>0){
      foreach($restaurant_category as $info){
      ?>
      <option value="{{$info->category_id}}" selected="selected">{{$info->category_name}}</option>
    <?php }

      foreach($category as $cinfo){
        if(in_array($cinfo->category_id , $get_cat)){

        }else{ 
        ?>  
       <option value="{{$cinfo->category_id}}" >{{$cinfo->category_name}}</option>

<?php } } }else{
  foreach($category as $cinfo){    ?>
      <option value="{{$cinfo->category_id}}" >{{$cinfo->category_name}}</option>
   <?php } }?>
    </select>
  </div>

<div class="form-group col-sm-8 col-sm-offset-2">
    <label>Restaurant Offer Schedule </label>
    <input type="text" name="offer" value="{{$rinfo->offer}}" class="form-control" placeholder="Restaurant offer and schedule"> 
  </div>

<div class="form-group col-sm-8 col-sm-offset-2">
<label>Restaurant sponsor for Searching &nbsp;&nbsp;&nbsp;&nbsp;</label>
<label class="radio-inline">
  <input type="radio" name="sponsor" id="inlineRadio1" value="yes"> YES
</label>
<label class="radio-inline">
  <input type="radio" name="sponsor" id="inlineRadio2" value="no"> NO
</label>
</div>

  <div class="form-group col-sm-8 col-sm-offset-2">
    <label >Restaurant full Address</label>
    <label style="color:red;font-size:18px;">*</label>
    
    <textarea class="form-control"  name="address" rows="5">{{$rinfo->address}}</textarea>
  </div>
  
  <div class="form-group col-sm-4 col-sm-offset-2">
    <label >Restaurant Logo</label>
    <input type="file" name="image"  class="btn btn-primary">
  </div>

  <div class="form-group col-sm-4">
  <img src="{{URL::to('images/restaurant/thumbs/'.$rinfo->r_image)}}" width="30%">
  </div>

 <div class="form-group col-sm-8 col-sm-offset-2">
  <input type="submit" name="submit" value="Update Restaurant" class="btn btn-success col-sm-2.5">
 	
 </div>
{{Form::close()}}
@endforeach
@stop