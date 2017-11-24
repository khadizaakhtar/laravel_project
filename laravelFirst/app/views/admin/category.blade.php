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
	<h1>View Menu</h1>

@if(Session::has('cat_msg'))
<div class="alert alert-info" role="alert">
{{Session::get('cat_msg')}}
</div>
@endif

<a class="btn btn-primary pull-right" href="{{URL::to('/addcategory')}}">Add Menu</a>
<br><br>

     <table id="example" class="table table-bordered display nowrap" cellspacing="0" width="100%">
     <thead>
       <tr>
       <th></th>
         	<th>Menu Name</th>
         	<th>Type</th>
         	<th>Image</th>
         	<th width="100px !importent">Action</th>
       </tr>
      </thead> 
      <tfoot>
       <tr>
       <th></th>

          <th>Menu Name</th>
          <th>Type</th>
          <th>Image</th>
          <th>Action</th>
       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($category as $cinfo)
        <tr>
        <td></td>
        	<td>{{$cinfo->category_name}}</td>
        	<td>
          @if($cinfo->type==0)
           {{"<strong>Main Menu</strong>"}}
          @else 
            <?php $check = ''; ?>
             @foreach($category as $info)
             @if($check=='')
             @if($info->category_id == $cinfo->type)
              {{"Sub Menu of <strong>".$info->category_name."</strong>"}}
             <?php $check =1; ?>
             @endif
             @endif
             @endforeach

          @endif
          </td>
          <td><img src="{{URL::to('images/category/thumbs/'.$cinfo->c_image)}}" class="img-responsive" width="13%"></td>

        	<td>
          <a href="{{URL::to('/deleteCategory/'.$cinfo->category_id)}}" onclick="return chackDelete()" class="btn btn-danger">delete</a>
          <a href="{{URL::to('/editCategory/'.$cinfo->category_id)}}" class="btn btn-primary" >Edit</a>
          </td>
        </tr>
        @endforeach
       	</tbody>
       
	 </table>

@stop
