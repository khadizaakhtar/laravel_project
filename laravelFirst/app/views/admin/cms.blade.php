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
	<h1>Manage CMS</h1>

@if(Session::has('msg'))
<div class="alert alert-info" role="alert">
{{Session::get('msg')}}
</div>
@endif

<!-- <a class="btn btn-primary pull-right" href="{{URL::to('/addcategory')}}">Add Category</a> -->
<br><br>

     <table id="example" class="table table-bordered display nowrap" cellspacing="0" width="100%">
     <thead>
       <tr>
       <th></th>
         	<th>Content Name</th>
          <th>Content Description</th>
         	<th width="100px !importent">Action</th>
       </tr>
      </thead> 

      <tfoot>
       <tr>
       <th></th>
          <th>Content Name</th>
          <th>Content Description</th>
          <th>Action</th>
       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($cms as $cmsinfo)
         <tr>
         <td></td>
          <td>{{$cmsinfo->content_title}}</td>
          <td>{{$cmsinfo->content_description}}</td>

        	<td>
          <a href="{{URL::to('/cmsDelete/'.$cmsinfo->content_id)}}" onclick="return chackDelete()" class="btn btn-danger">delete</a>
          <a href="{{URL::to('/cmsEdit/'.$cmsinfo->content_id)}}" class="btn btn-primary" >Edit</a>
          </td>
        </tr>
        @endforeach
       	</tbody>
       
	 </table>

@stop
