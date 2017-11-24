@extends('layout')

@section('mainContant')

<style>
	.active2 {background-color: #ce0b10; color: #ffffff !important; font-weight: bold;}
	.c_p_n{ color: #ce0b10; font-weight: bold; }
	#total{color: #ce0b10; font-weight: bold; font-size: 18px;}
</style>

<script type="text/javascript">
	$(document).ready(function(){

							$.ajax({
								url: "<?php echo URL::to('/viewCart');?>",
								success: function(data){

									$.each(data, function(k,v) {
									console.log(v.options.length);
										newTr = $('<div style="padding:15px;" class="cart_'+v.id+'"></div>');

										newTr.html('<span class="c_p_n">'+v.name+'</span><input id="delete'+v.id+'" class="pull-right" type="image" value="'+v.rowid+'" src="<?php echo URL::to("/images/remove.jpg")?>" width="10%" />');
										for(var x=0; x<v.options.topping.length; x++){
											newTr.append('<h5>&nbsp;&nbsp;&nbsp;'+v.options.topping[0].topping_name+' --------- $'+v.options.topping[0].topping_price+'</h5>');
										}	
										newTr.append('<h4>&nbsp;&nbsp;&nbsp;'+v.qty+'x'+v.price+'<span class="pull-right">$'+v.subtotal+'</span></h4>');
									    newTr.prependTo("#showCart");	

									    $("#delete"+v.id).click(function(){
									    	var rowid;
									    	
									    	$.post("<?php echo URL::to('/deleteCart')?>",{rowid: v.rowid}, function(data){
									    		//console.log(data);
									    		$('#t').html("$"+data);
									    	});
									    	$(".cart_"+v.id).remove();
									    });

									});	
								 $('#t').html("$<?php echo Cart::total();?>");		
									
																			    		
								}
							});

	});
</script>


<?php 



?>
<div class="row">
		<div class="panel panel-default">
    <div class="panel-body">
    	<div class="col-md-3">
    		<a href="{{URL::to('/foods/'.$restaurant->restaurant_id)}}">
      		<img class="img-responsive" src="{{URL::to('images/restaurant/thumbs/'.$restaurant->r_image)}}" alt="...">
    		</a>
    	</div>

    	<div class="col-md-6">
    		<h2><a href="{{URL::to('/foods/'.$restaurant->restaurant_id)}}">{{$restaurant->restaurant_name}}</a></h2>
    		<h3>{{$restaurant->address}}</h3>	
    	</div>

    	<div class="col-md-3">
    		<h3>Restaurant Rating </h3>
    		@for($i=1; $i<=$restaurant->rating;$i++)
    		 <img width="13%" src="{{URL::to('images/star.jpg')}}">
    		 @endfor
    		 @for($j=$i; $j<=6; $j++)
    		 <img width="13%" src="{{URL::to('images/star2.jpg')}}">
    		 @endfor
    	</div>
    </div>
	</div>

</div>

<div class="row">

<div class="col-md-3">
		<div class="list-group">
		  <a  class="list-group-item active">
		    Menu Item
		  </a>
		  @foreach($category as $cinfo)
		   @if($cinfo->type==0)
		  <a href="{{URL::to('/foods/'.$rid.'/'.$cinfo->category_id)}}" class="list-group-item @if($cid==$cinfo->category_id){{'active'}}@endif">
		  <img width="13%" src="{{URL::to('images/category/thumbs/'.$cinfo->c_image)}}"> {{$cinfo->category_name}}
		  </a>
		  @endif		  
		  @foreach($category as $sinfo)
		  @if($cinfo->category_id == $sinfo->type)
		  <a href="{{URL::to('/foods/'.$rid.'/'.$sinfo->category_id)}}" class="list-group-item @if($cid==$sinfo->category_id){{'active'}}@endif">
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img width="13%" src="{{URL::to('images/category/thumbs/'.$cinfo->c_image)}}"> {{$sinfo->category_name}}
		  </a>		  
		  @endif
		  @endforeach
		  @endforeach
		</div>	
	</div>


<!-- start product details list -->
	<div class="col-md-6">	
	@if(count($product)>0)
	<?php $i=1; ?>
	@foreach($product as $pinfo)
	<?php $i=$i+1; ?>

	<script type="text/javascript">
				$(document).ready(function(){

					var i="<?php echo $i;?>";
				

					$('#cart'+i).click(function(){
							var id= $(this).val();
							$('#showCart').html('');
							var topping = $('#e9'+i).val();
							var qty = $('#qty'+i).val();
							var newTr;
							//alert(topping[0]);

							$.ajax({
								url: "<?php echo URL::to('/addCart/');?>/"+id+'/'+qty+'/'+topping,
								success: function(data){

									$.each(data, function(k,v) {
									console.log(data);
										newTr = $('<div style="padding:15px;" class="cart_'+v.id+'"></div>');

										newTr.html('<span class="c_p_n">'+v.name+'</span><input id="delete'+v.id+'" class="pull-right" type="image" value="'+v.rowid+'" src="<?php echo URL::to("/images/remove.jpg")?>" width="10%" />');
										for(var x=0; x<v.options.topping.length; x++){
											newTr.append('<h5>&nbsp;&nbsp;&nbsp;'+v.options.topping[0].topping_name+' --------- $'+v.options.topping[0].topping_price+'</h5>');
										}	
										newTr.append('<h4>&nbsp;&nbsp;&nbsp;'+v.qty+'x'+v.price+'<span class="pull-right">$'+v.subtotal+'</span></h4>');
									    newTr.prependTo("#showCart");	

									    $("#delete"+v.id).click(function(){
									    	var rowid;
									    	
									    	$.post("<?php echo URL::to('/deleteCart')?>",{rowid: v.rowid}, function(data){
									    		//console.log(data);
									    		$('#t').html("$"+data);
									    	});
									    	$(".cart_"+v.id).remove();
									    });

									    $.post("<?php echo URL::to('/gettotal')?>",function(data){
									    	$('.total').html("$"+data);
									    });

									});	
											
								}
							});
					
					});
						
				

// <!-- start popup script -->


 $("#e9"+i).select2({
 	placeholder: "Select Your Extra Toppings"
 });



	$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
 
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})


});
</script>
<!-- end popup script -->


<!-- start popup	 -->
<div class="modal fade" id="exampleModal<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="exampleModalLabel">You have selected <span style="color:red">{{$pinfo->name}}</span></h3>
        <h3>Price is   <span style="color:red">${{$pinfo->price}}</span></h3>
      </div>
      <div class="modal-body">
        <form role="form">

         <div class="form-group">
            <label for="message-text" class="control-label">How Many Order:</label>
            <input type="text" id="qty{{$i}}" value="1" class="form-control" placeholder="Enter Product Quantity" id="message-text"/>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="control-label">Select Your Extra Toppings:</label>
            <select class="form-control" id="e9<?php echo $i;?>"  style="Padding: 0px;" multiple="multiple">
            <?php $topping = DB::table('tbl_toppings')->get();?>
            	@foreach($topping as $tinfo)
            	<option value="{{$tinfo->topping_id}}">{{$tinfo->topping_name.' - '.$tinfo->topping_price}}</option>
            	@endforeach
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" value="{{$pinfo->product_id}}" id="cart{{$i}}" class="btn btn-primary" data-dismiss="modal">Add to Cart</button>
      </div>
    </div>
  </div>
</div>
<!-- end popup -->



		<div class="row">
				<div class="panel panel-default">
    			<div class="panel-body">
    				<div class="col-md-2">
						<img style="margin-top:20%" src="{{URL::to('/images/product/thumbs/'.$pinfo->p_image)}}" class="img-responsive">   					
    				</div>	
					<div class="col-md-6">
						<h4>{{$pinfo->name}}</h4>
						<h4>$ {{$pinfo->price}}</h4>
					</div>
					<div class="col-md-4">

						<button  data-toggle="modal" data-target="#exampleModal<?php echo $i?>"  class="btn btn-primary btn-sm pull-right" style="margin-top:20%">Click for Cart</button>
					</div>
				</div>
				</div>
		</div>	
	@endforeach
	@else
	<h2>{{"No Foods fond"}}</h2>
	@endif
	</div>

<!-- end product list -->



	<div class="col-md-3">
		<div class="panel panel-primary">
  <div class="panel-heading">Your Order Items</div>
  
  		<div id="showCart">
  			
  		</div>

  		
  <div class="panel-body">
		<div id="total">Total <span id="t" class="total pull-right"></span></div>
		<br>
    <p>
<?php if(!Auth::userlogin()->user()){?>
	<button type="button" id="check" class="btn btn-primary center-block" data-toggle="<?php if(!Auth::userlogin()->user()){echo 'modal';}?>" data-target=".bs-example-modal-sm">Go to CheckOut</button>
<?php }else{?>
	<a href="{{URL::to('/delivery')}}" class="btn btn-primary center-block" id="check">Go to CheckOut</a>
<?php }?>

    </p>
  </div>

  
</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#signin").click(function(){
			//alert("sfdds");
			var name = $("#name").val();
			var password = $("#password").val();

			if(name ==''){
				$("#show1").html("please Enter Email");
			}
			if(password == ''){
				$("#show2").html("please Enter Password");
			}
		});

		$("#name").keyup(function(){
			var name = $(this).val();
			if(name !=''){
				$("#show1").html("");			
			}
		});

		$("#password").keyup(function(){
			var password = $(this).val();
			if(password !=''){
				$("#show2").html("");			

			}
		});


	$("#check").click(function(){
			
			$.post("<?php echo URL::to('/gettotal')?>",function(data){
				//alert(data);
				if(data == 0){
					//$(this).attr('data-dismiss','modal');
					alert("Your Cart items is empty ! please add any item");
					return false;
				}
			});

		});	


	});

	function login(){
		var email=document.getElementById('name').value;
		var password=document.getElementById('password').value;
		if(email =='' && password ==''){
			return false;
		}else{
			return true;
		}
	}



</script>


<div style="top:12%" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
      <button class="close" data-dismiss="modal" type="button">
<span aria-hidden="true" style="padding:5px;">×</span>
<span class="sr-only">Close</span>
</button>
     <h3 style="text-align:center">Sign In For Check Out</h3>
     <!-- {{Form::open(array('action' => 'CartController@checklogin', ''))}} -->

     <form action="{{URL::to('/checklogin')}}" onsubmit="return login();" method="post">
     {{Form::token();}}
     <div style="padding:15px;">
      <div class="form-group">     
      <label>Email Address :</label>
      	<input type="email" name="email" id="name" class="form-control" />
      	<span style="color:red" id="show1"></span>
      </div>

      <div class="form-group">
      <label>Password :</label>
      	<input type="password" name="password" id="password" class="form-control" />
      	<span style="color:red" id="show2"></span>

      </div>

      <button class="btn btn-primary center-block" id="signin">SignIn</button>
      </div>
      {{Form::close();}}
    </div>
  </div>
</div>


</div>
@stop