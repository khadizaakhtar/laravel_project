@extends('layout')

@section('mainContant')
<style>
	.active2 {background-color: #ce0b10; color: #ffffff !important; font-weight: bold;}
	.panel-body span{ font-size: 17px;}
    .margin{margin-bottom: 5px; padding: 8px; }
    .fogin{clear: both;}
</style>
<div class="row">
	<div class="panel panel-default">
  <div class="panel-body">
    <span>Your Search Restaurant Location is <b style="color:red">{{Session::get('location')}}<b/</span>
  </div>
</div>

</div>


	
	<div class="row">
    <div class="col-md-3 fogin">
       <div class="btn-group-vertical" role="group" aria-label="fogin" style="width:100%">
       <h3>I'm hungry for...</h3>
       <?php foreach($cuisine as $cuinfo){ ?>
       <a href="{{URL::to('/cuisineRestaurant/'.$cuinfo->cuisineID)}}" class="margin <?php if($cuinfo->cuisineID == $cuid){echo 'btn btn-success';}else{echo 'btn btn-default';}?>"><b>{{$cuinfo->cuisine_name}}</b></a>    
       <?php }?> 
       </div> 
    </div>
    

 <!-- Response Resturant     -->
<div class="col-md-9">
    @if(count($response)>0)
    @foreach($response as $rinfo)
  <div class="panel panel-default">
    
    <div class="panel-body">
      <div class="col-md-3">
        <a href="{{URL::to('/foods/'.$rinfo->restaurant_id)}}">
          <img class="img-responsive" src="{{URL::to('images/restaurant/thumbs/'.$rinfo->r_image)}}" alt="...">
        </a>
      </div>

      <div class="col-md-6">
        <h2><a href="{{URL::to('/foods/'.$rinfo->restaurant_id)}}">{{$rinfo->restaurant_name}}</a></h2>
        <h4>{{$rinfo->address}}</h4>  
      </div>

      <div class="col-md-3">
      Top sponsor restaurants
        <h3>Rating </h3>
        @for($i=1; $i<=$rinfo->rating;$i++)
         <img width="13%" src="{{URL::to('images/star.jpg')}}">
         @endfor
         @for($j=$i; $j<=6; $j++)
         <img width="13%" src="{{URL::to('images/star2.jpg')}}">
         @endfor
      </div>
    </div>
    </div>
    @endforeach 
    @endif

<!-- End Response Restaurant -->



    @if(count($restaurant)>0)
    @foreach($restaurant as $rinfo)
	<div class="panel panel-default">
    
    <div class="panel-body">
    	<div class="col-md-3">
    		<a href="{{URL::to('/foods/'.$rinfo->restaurant_id)}}">
      		<img class="img-responsive" src="{{URL::to('images/restaurant/thumbs/'.$rinfo->r_image)}}" alt="...">
    		</a>
    	</div>

    	<div class="col-md-6">
    		<h2><a href="{{URL::to('/foods/'.$rinfo->restaurant_id)}}">{{$rinfo->restaurant_name}}</a></h2>
    		<h4>{{$rinfo->address}}</h4>	
    	</div>

    	<div class="col-md-3">
    		<h3>Rating </h3>
    		@for($i=1; $i<=$rinfo->rating;$i++)
    		 <img width="13%" src="{{URL::to('images/star.jpg')}}">
    		 @endfor
    		 @for($j=$i; $j<=6; $j++)
    		 <img width="13%" src="{{URL::to('images/star2.jpg')}}">
    		 @endfor
    	</div>
    </div>
    </div>
    @endforeach
    @else
    <!-- <h2>{{"No Restaurant fond"}}</h2> -->
    @endif
	</div>


	</div>
	

@stop