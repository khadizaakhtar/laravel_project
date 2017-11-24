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
<h2>Manage Location</h2>

@if(Session::has('location_msg'))
<div class="alert alert-info" role="alert">
{{Session::get('location_msg')}}
</div>
@endif

<br><br>
<div class="row">

<div class="col-md-4">
<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>
@if(isset($form)==1)
  {{Form::open(array('action'=>'LocationController@addlocation'))}}
  <!-- <form action="{{URL::to('addlocation')}}" method="post"> -->
  <div class="form-group col-sm-12">
    <label>Location Name</label>
    <label style="color:red;font-size:18px;">*</label>
    <input type="text" name="location_name"  class="form-control"  placeholder="Enter Location">
  </div>

  <div class="form-group col-sm-12">
    <label >Postal Code</label>
    <label style="color:red;font-size:18px;">*</label>
    
    <input type="text" name="postal_code"  class="form-control"  placeholder="Enter Postal Code">
  </div>

  <div class="form-group col-sm-12">
    <label >Location Details</label>
    <textarea class="form-control" name="location_details" placeholder="Enter Postal Code"></textarea> 
  </div>

 <div class="form-group col-sm-12">
  <input type="submit" name="submit" value="Add Location" class="btn btn-success"> 
 </div>

{{Form::close()}}
@endif



@if(isset($edit)==1)
@if(isset($single_location))
@foreach($single_location as $sinfo)
{{Form::open(array('action'=>'LocationController@editLocation'))}}
  <div class="form-group col-sm-12">
    <label>Location Name</label>
    <label style="color:red;font-size:18px;">*</label>

    <input type="hidden" value="{{$sinfo->location_id}}" name="id">
    <input type="text" name="location_name" value="{{$sinfo->location_name}}"  class="form-control"  placeholder="Enter Location">
  </div>

  <div class="form-group col-sm-12">
    <label >Postal Code</label>
    <label style="color:red;font-size:18px;">*</label>
    
    <input type="text" name="postal_code" value="{{$sinfo->postal_code}}"  class="form-control"  placeholder="Enter Postal Code">
  </div>

  <div class="form-group col-sm-12">
    <label >Location Details</label>
    <textarea class="form-control" name="location_details" placeholder="Enter Postal Code">{{$sinfo->location_details}}</textarea> 
  </div>

 <div class="form-group col-sm-12">
  <input type="submit" name="submit" value="Update Location" class="btn btn-success"> 
 </div>

{{Form::close()}}
@endforeach
@endif
@endif
</div>


<div class="col-md-8">
     <table id="example" class="table table-bordered display nowrap" cellspacing="0" width="100%">
     <thead>
       <tr>
       <th></th>
         	<th>Location Name</th>
         	<th>Postal Code</th>
          <th>Location Details</th>
         	<th width="100px !importent">Action</th>
       </tr>
      </thead>

      <tfoot>
       <tr>
       <th></th>
          <th>Location Name</th>
          <th>Postal Code</th>
          <th>Location Details</th>
          <th>Action</th>
       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($location as $linfo)
        <tr>
        <td></td>
        	<td>{{e($linfo->location_name)}}</td>
          <td>{{$linfo->postal_code}}</td>  
        	<td>{{$linfo->location_details}}</td>  
          <td>      
          <a href="{{URL::to('/deleteLocation/'.$linfo->location_id)}}" onclick="return chackDelete()" class="label label-danger">delete</a>
          <a href="{{URL::to('/editLocation/'.$linfo->location_id)}}" class="label label-primary" >Edit</a>
          </td>
        </tr>
        @endforeach
       	</tbody>
       
	 </table>
   </div>
</div>
@stop
