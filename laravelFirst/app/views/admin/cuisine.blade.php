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
<br>
<h2>Manage Cuisine</h2>

@if(Session::has('msg'))
<div class="alert alert-info" role="alert">
{{Session::get('msg')}}
</div>
@endif

<br><br>
<div class="row">

<div class="col-md-6">
<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>
@if(isset($form)==1)
  {{Form::open(array('action'=>'CuisineController@addcuisine'))}}
  <!-- <form action="{{URL::to('addlocation')}}" method="post"> -->
  <div class="form-group col-sm-8">
    <label>Cuisine Name</label>
    <label style="color:red;font-size:18px;">*</label>

    <input type="text" name="cuisine_name"  class="form-control"  placeholder="Enter Cuisine">
  </div>

 <div class="form-group col-sm-8">
  <input type="submit" name="submit" value="Add Cuisine" class="btn btn-success"> 
 </div>

{{Form::close()}}
@endif



@if(isset($edit)==1)
@if(isset($single_cuisine))
@foreach($single_cuisine as $sinfo)
{{Form::open(array('action'=>'CuisineController@editcuisine'))}}
  <div class="form-group col-sm-8">
    <label>Cuisine Name</label>
    <label style="color:red;font-size:18px;">*</label>
    
    <input type="hidden" value="{{$sinfo->cuisineID}}" name="id">
    <input type="text" name="cuisine_name" value="{{$sinfo->cuisine_name}}"  class="form-control"  placeholder="Enter Cuisine">
  </div>

 

 <div class="form-group col-sm-8">
  <input type="submit" name="submit" value="Update Cuisine" class="btn btn-success"> 
 </div>

{{Form::close()}}
@endforeach
@endif
@endif
</div>


<div class="col-md-6">
     <table id="example" class="table table-bordered display nowrap" cellspacing="0" width="100%">
     <thead>
       <tr>
       <th></th>
          <th>Cuisine ID</th>
         	<th>Cuisine Name</th>
         	<th width="100px !importent">Action</th>
       </tr>
      </thead>

      <tfoot>
       <tr>
       <th></th>
          <th>Cuisine ID</th>
          <th>Cuisine Name</th>
          <th>Action</th>
       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($cuisine as $cinfo)
        <tr>
        <td></td>
        	<td>{{e($cinfo->cuisineID)}}</td>
        	<td>{{$cinfo->cuisine_name}}</td>  
          <td>      
          <a href="{{URL::to('/deletecuisine/'.$cinfo->cuisineID)}}" onclick="return chackDelete()" class="label label-danger">delete</a>
          <a href="{{URL::to('/editcuisine/'.$cinfo->cuisineID)}}" class="label label-primary" >Edit</a>
          </td>
        </tr>
        @endforeach
       	</tbody>
       
	 </table>
   </div>
</div>
@stop
