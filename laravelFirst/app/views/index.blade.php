@extends('layout')
@section('mainContant')
<?php Cart::destroy();?>
 <script>
$(document).ready(function() {
  $('#search').submit(function(){
      var location = $('#location').val();
      if(location == '')
      {
        alert('Please Select Location');
        return false;
      }
  });

 });
</script>

<style type="text/css">
  .offer{
    font-size: 17px;
     color: white;
     font-weight:600;  
     background-color: #ce0b10;
     padding: 2%;
     text-align: center;;
  }
</style>

<div id="home">
@if(Session::has('reset_msg'))
<div class="alert alert-success" role="alert">{{Session::get('reset_msg')}}</div>
@endif

<h1>Order your takeaway online</h1>

<div class="home_order">
{{Form::open(array('action' => 'HomeController@search_restaurant', 'id' => 'search'))}}
<!-- <form role="form" action="{{URL::action('HomeController@search_restaurant')}}" method="post" id="search"> -->
  <div class="form-group col-md-4">
    <label>Search Order Location...</label>
    <select id="location" class="form-control" name="location">
    <option value="">Select Location</option>
    @foreach($location as $loc)
      <option value="{{$loc->location_id}}">{{$loc->location_name}}</option>
      @endforeach
    </select>
    @if($errors->has('location'))
 <label>{{$errors->first('location')}}</label>
 @endif
  </div>

  <div class="form-group col-md-4">
    <label>I'm hungry for...</label>

    <select class="form-control" name="cuisine">
      <option value="">Show Everything</option>
      @foreach($cuisine as $cinfo)
      <option value="{{$cinfo->cuisineID}}">{{$cinfo->cuisine_name}}</option>
      @endforeach
    </select>
  </div>

<div class="form-group ">
   <input type="submit" name="find" class="btn col-md-3" value="Find Takeaway">
</div>

  <div style="clear:both"></div>
{{Form::close();}}

</div>

<br>
<br>
<?php $i= 0;?>
@foreach($restaurant as $cinfo)
<?php if($i==3){$i=0;}  if($i==0){?>
<div class="row">
<?php }?>
  <div class="col-sm-4 col-md-4">
    <div class="thumbnail">
    @if($cinfo->offer !='')
    <div class="offer">{{$cinfo->offer}}</div>
    <br>
    @else
    <br>
    <br>
    <br>
    @endif
     <a href="{{URL::to('/foods/'.$cinfo->restaurant_id)}}"> <img  src="{{URL::to('images/restaurant/thumbs/'.$cinfo->r_image)}}" alt="Restaurant Image"></a>
      <div class="caption">
        <h3><a href="{{URL::to('/foods/'.$cinfo->restaurant_id)}}">{{$cinfo->restaurant_name}}</a></h3>
        <h5><a href="{{URL::to('/foods/'.$cinfo->restaurant_id)}}">{{$cinfo->address}}</a></h5>
      </div>
    </div>
  </div>

<?php $i= $i+1; if($i==3){?>
</div>
<?php } ?>

  @endforeach

</div>
@stop