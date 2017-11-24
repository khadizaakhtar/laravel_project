@extends('admin/layout')
@section('mainContent')
<script type="text/javascript">
        function chackDelete(){
              var chack=confirm("Are You Sure to Complete this Order?");
              if(chack){
                return true;
              }else{
                return false;
              }
            }
</script>
<br>
<h1>View Invoice</h1>
<a href="{{URL::to('/downloadPDF/'.$id)}}" class="pull-right btn btn-danger">Download Invoice</a>
@if($active == 0)
<a style="margin-right:10px;" href="{{URL::to('/completeOrder/'.$id)}}" onclick="return chackDelete();" class="btn btn-success pull-right">Complete</a>
@else
<span style="margin-right:10px;" class="btn btn-danger pull-right">This Order was Completed</span>
@endif
<div class="panel panel-primary">
  <div class="panel-heading">View Order Invoice</div>
  
  <div class="panel-body">
   
   <?php if(count($order)>0){?>
  <div class="table-responsive">
  <table class="table table-bordered">
  <thead>
   <tr>
   	<th>Product Name</th>
   	<th>Product Quantity</th>
   	<th>Product Image</th>
   	<th>Extra Topping</th>
   	<th>Product Price</th>
   </tr>
  </thead>

  <tbody>
  <?php $ttprice = 0; $ptprice = 0; ?>
  @foreach($order as $rinfo)
  	<tr>
  		<td>{{$rinfo->product_name}}</td>
  		<td>{{$rinfo->qty}}</td>
  		<td ><img src="{{URL::to('/images/product/thumbs/'.$rinfo->p_image)}}" width="15%"></td>
  		<td>
  		<?php 
  		$topping_id = $rinfo->topping_id;
  		$tid = explode(',', $topping_id);
  		//print_r($tid);
  		$topping = DB::table('tbl_toppings')->wherein('topping_id',$tid)->get();
  		//print_r($topping);
  		foreach($topping as $tinfo){
  			echo $tinfo->topping_name.' ----- $'.$tinfo->topping_price.'<br>';
  			$ttprice = $ttprice + ($rinfo->qty*$tinfo->topping_price);
  		}
  		 ?>

  		</td>
  		<td>{{$rinfo->qty}} X {{$rinfo->product_price}} = ${{$rinfo->qty*$rinfo->product_price}}</td>
  	</tr>
  	<?php $ptprice = $ptprice + ($rinfo->qty*$rinfo->product_price); ?>
  	@endforeach
  	<tr>
  		<td colspan="3" style="text-align:right"><b>Sub-Total :</b></td>
  		<td><b>$ {{$ttprice}}</b></td>
  		<td><b>$ {{$ptprice}}</b></td>
  	</tr>

  	<tr>
  		<td colspan="4" style="text-align:right"><b>Total :</b></td>
  		<td><b>$ {{$ttprice + $ptprice}}</b></td>
  	</tr>
  </tbody>
  </table>
</div>
<?php }else{?>
<h4>You have not order</h4>
<?php }?>
  </div>
</div>

@stop