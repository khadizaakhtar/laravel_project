@extends('admin/layout')
@section('mainContent')

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
	<h1>View Product</h1>

@if(Session::has('product_msg'))
<div class="alert alert-info" role="alert">
{{Session::get('product_msg')}}
</div>
@endif

<a class="btn btn-primary pull-right" href="{{URL::to('/addproduct')}}">Add Product</a>
<br><br>

     <table id="example" class="table table-bordered display nowrap" cellspacing="0" width="100%">
     <thead>
       <tr>
       <th></th>
         	<th>Product Name</th>
         	<th>Category Name</th>
         	<th>Product Price</th>
         	<th>Product Image</th>
         	<th width="100px !importent">Action</th>
       </tr>
      </thead> 
      <tfoot>
       <tr>
       <th></th>

          <th>Product Name</th>
          <th>Category Name</th>
          <th>Product Price</th>
          <th>Product Image</th>
          <th>Action</th>
       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($product as $pinfo)
        <tr>
        <td></td>
        	<td>{{$pinfo->name}}</td>

           <?php $check = ''; ?>
           @foreach($category as $cinfo)
           @if($check=='')
           @if($cinfo->category_id == $pinfo->type)
          <td>{{$pinfo->category_name.' ('.$cinfo->category_name.')'}}</td>
           <?php $check =1; ?>
           @endif
           @endif
           @endforeach

           @if($check=='')
          <td>{{$pinfo->category_name}}</td>
           @endif

        	<td>{{$pinfo->price}}</td>
          <td><img src="{{URL::to('images/product/thumbs/'.$pinfo->p_image)}}" class="img-responsive" width="13%"></td>

        	<td>
          <a href="{{URL::to('/deleteProduct/'.$pinfo->product_id)}}" onclick="return chackDelete()" class="btn btn-danger">delete</a>
          <a href="{{URL::to('/editProduct/'.$pinfo->product_id)}}" class="btn btn-primary" >Edit</a>
          </td>
        </tr>
        @endforeach
       	</tbody>
       
	 </table>


 

@stop
