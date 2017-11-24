@extends('layout')
@section('mainContant')
<link type="text/css" rel="stylesheet" href="{{asset('DataTables/media/css/jquery.dataTables.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('DataTables/media/css/dataTables.responsive.css')}}"> 
{{HTML::script('DataTables/media/js/jquery.dataTables.min.js');}}
  {{HTML::script('DataTables/media/js/dataTables.responsive.min.js');}}

	{{HTML::script('DataTables/resources/syntax/shCore.js');}}
  {{HTML::script('DataTables/resources/demo.js');}}
<script type="text/javascript" language="javascript" class="init">
  $(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'asc' ]
    } );
} );

</script>
<br>
<h1>View Your Order</h1>
@if(Session::has('msg'))
<div class="alert alert-success" role="alert">{{Session::get('msg')}}</div>
@endif
<br><br>

     <table id="example" class="table table-bordered display nowrap" cellspacing="0" width="100%">
     <thead>
       <tr>
       <th></th>
          <th>OrderID</th>
          <th>Restaurant Info</th>
          <th>Order Name</th>
          <th>First Name</th>
         	<th>Last Name</th>
			    <th>Mobile</th>
         	<th>Email</th>
          <th>City</th>
         	<th>Area</th>
         	<th>Address</th>
         	<th>Quentity</th>
         	<th>Total Price</th>
         	<th width="100px !importent">Action</th>
       </tr>
      </thead> 
      <tfoot>
       <tr>
          <th></th>
          <th>OrderID</th>
          <th>Restaurant Info</th>
  			  <th>Order Name</th>
          <th>First Name</th>
          <th>Last Name</th>
  			  <th>Mobile</th>
         	<th>Email</th>
         	<th>City</th>
          <th>Area</th>
         	<th>Address</th>
         	<th>Quentity</th>
         	<th>Total Price</th>
         	<th width="100px !importent">Action</th>
       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($order as $rinfo)
        <tr>
        <td></td>
          <td>{{$rinfo->orderID}}</td>
          <td><b>{{$rinfo->restaurant_name.'</b><br>'.$rinfo->res_address}}</td>
          <td>{{$rinfo->name}}</td>
          <td>{{$rinfo->firstname}}</td>
        	<td>{{$rinfo->lastname}}</td>
        	<td>{{$rinfo->mobile}}</td>
        	<td>{{$rinfo->email}}</td>
          <td>{{$rinfo->city}}</td>
        	<td>{{$rinfo->area}}</td>
        	<td>{{$rinfo->address}}</td>
        	<td>{{$rinfo->total_qty}}</td>
        	<td>$ {{$rinfo->total_price}}</td>
  		<td>
          <!-- <a href="{{URL::to('/deleteInvoice/'.$rinfo->orderID)}}" onclick="return chackDelete()" class="btn btn-danger">delete</a> -->
          <a href="{{URL::to('/viewOrder/'.$rinfo->orderID)}}" class="btn btn-primary">Details</a>
        </td>
        </tr>
        @endforeach
       	</tbody>
       
	 </table>


@stop