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
  <h1>View Restaurant</h1>

@if(Session::has('restaurant_msg'))
<div class="alert alert-info" role="alert">
{{Session::get('restaurant_msg')}}
</div>
@endif

<br><br>

     <table id="example" class="table table-bordered display nowrap" cellspacing="0" width="100%">
     <thead>
       <tr>
       <th></th>
          <th>Restaurant Name</th>
          <th>Location</th>
          <th>Category</th>
          <th>Cuisine</th>
          <th>Offer</th>
          <th>Rating</th>
          <th>Sponsor</th>
          <th width="100px!importent">Logo</th>
          <th>Address</th>
          <th width="100px !importent">Action</th>
       </tr>
      </thead> 
      <tfoot>
       <tr>
       <th></th>

          <th>Restaurant Name</th>
          <th>Location</th>
          <th>Category</th>
          <th>Cuisine</th>         
          <th>Offer</th>
          <th>rating</th>
          <th>Sponsor</th>        
          <th>Logo</th>
          <th>Address</th>
          <th>Action</th>
       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($restaurant as $rinfo)
        <tr>
        <td></td>
          <td>{{$rinfo->restaurant_name}}</td>
          <td>{{$rinfo->location_name}}</td>
          <td><?php $r = new Restaurant(); $rc=$r->get_restaurant_category($rinfo->restaurant_id)?>
          @foreach($rc as $rcinfo){{$rcinfo->category_name.', ';}}@endforeach
          </td>

          <td>
            <?php $cuisine = $r->get_restaurant_cuisine($rinfo->restaurant_id);?>
            @foreach($cuisine as $cu){{$cu->cuisine_name.", "}}@endforeach
          </td>

          <td>{{$rinfo->offer}}</td>
          <td>{{$rinfo->rating}}</td>
          <td>{{$rinfo->sponsor}}</td>
          <td><img src="{{URL::to('images/restaurant/thumbs/'.$rinfo->r_image)}}" class="img-responsive" width="50%"></td>
          <td>{{$rinfo->address}}</td>

          <td>
          @if(Auth::adminlogin()->user())
          <a href="{{URL::to('/deleterestaurant/'.$rinfo->restaurant_id)}}" onclick="return chackDelete()" class="btn btn-danger">delete</a>
          @endif
          <a href="{{URL::to('/editrestaurant/'.$rinfo->restaurant_id)}}" class="btn btn-primary" >Edit</a>
          </td>
        </tr>
        @endforeach
        </tbody>
       
   </table>


 

@stop
