@extends('admin/layout')
@section('mainContent')

<script type="text/javascript" language="javascript" class="init">
  $(document).ready(function(){
    $('#example').DataTable({
        responsive: {
            details: {
                type: 'column'
                
            }
        },

        columnDefs: [{
            className: 'control',
            orderable: false,
            targets:   0
        }],

        order: [ 1, 'asc' ]
    });
});

</script>
<br>
<h2>Manage Toppings</h2>

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
  {{Form::open(array('action'=>'ToppingController@addtopping'))}}
  <!-- <form action="{{URL::to('addlocation')}}" method="post"> -->
  <div class="form-group col-sm-8">
    <label>Topping Name</label>
    <label style="color:red;font-size:18px;">*</label>

    <input type="text" name="topping_name"  class="form-control"  placeholder="Enter Topping">
  </div>

  <div class="form-group col-sm-8">
    <label >Topping Price</label>
    <label style="color:red;font-size:18px;">*</label>
    
    <input type="text" name="topping_price"  class="form-control"  placeholder="Enter Topping Price">
  </div>

 <div class="form-group col-sm-8">
  <input type="submit" name="submit" value="Add Topping" class="btn btn-success"> 
 </div>

{{Form::close()}}
@endif



@if(isset($edit)==1)
@if(isset($single_topping))
@foreach($single_topping as $sinfo)
{{Form::open(array('action'=>'ToppingController@editTopping'))}}
  <div class="form-group col-sm-8">
    <label>Topping Name</label>
    <input type="hidden" value="{{$sinfo->topping_id}}" name="id">
    <input type="text" name="topping_name" value="{{$sinfo->topping_name}}"  class="form-control"  placeholder="Enter Topping">
  </div>

  <div class="form-group col-sm-8">
    <label >Topping Price</label>
    <input type="text" name="topping_price" value="{{$sinfo->topping_price}}"  class="form-control"  placeholder="Enter Topping Price">
  </div>

 <div class="form-group col-sm-8">
  <input type="submit" name="submit" value="Update Topping" class="btn btn-success"> 
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
         	<th>Topping Name</th>
         	<th>Topping Price</th>
         	<th width="100px !importent">Action</th>
       </tr>
      </thead>

      <tfoot>
       <tr>
       <th></th>
          <th>Topping Name</th>
          <th>Topping Price</th>
          <th>Action</th>
       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($topping as $linfo)
        <tr>
        <td></td>
        	<td>{{e($linfo->topping_name)}}</td>
        	<td>${{$linfo->topping_price}}</td>  
          <td>      
          <a href="{{URL::to('/deleteTopping/'.$linfo->topping_id)}}" onclick="return chackDelete()" class="label label-danger">delete</a>
          <a href="{{URL::to('/editTopping/'.$linfo->topping_id)}}" class="label label-primary" >Edit</a>
          </td>
        </tr>
        @endforeach
       	</tbody>
       
	 </table>
   </div>
</div>
@stop
