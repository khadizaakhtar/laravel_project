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
<h1>View Restaurant Owners</h1>
@if(Session::has('msg'))
<div class="alert alert-success" role="alert">{{Session::get('msg')}}</div>
@endif
<br><br>

     <table id="example" class="table table-bordered display nowrap" cellspacing="0" width="100%">
     <thead>
       <tr>
         <th></th>
         <th>ID</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email</th>
         <th>Restaurant Name</th>
         <th>Image</th>
         <th>Activation</th>

         <th>Action</th>
       </tr>
      </thead> 
      <tfoot>
       <tr>
       <th></th>
        <th>ID</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email</th>
         <th>Restaurant Name</th>
         <th>Image</th>
         <th>Activation</th>
         <th>Action</th>

       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($woner as $uinfo)
        <tr>
        <td></td>
         <td>{{$uinfo->ID}}</td>
         <td>{{$uinfo->firstname}}</td>
         <td>{{$uinfo->lastname}}</td>
         <td>{{$uinfo->email}}</td>
         <td>{{$uinfo->restaurant_name}}</td>

         <td><img src="{{URL::to('images/'.$uinfo->image)}}" width="20%"></td>
         <td><?php if($uinfo->activation == 1){ echo "Account Active";}else { echo "Account Not Active";}?></td>
         <td>
          @if($uinfo->activation == 0)<a class="btn btn-primary" href="{{URL::to('/owneractive/1/'.$uinfo->ID)}}">Active</a>@else<a class="btn btn-primary" href="{{URL::to('/owneractive/0/'.$uinfo->ID)}})}}">Deactive</a>@endif
           <a class="btn btn-danger" href="{{URL::to('/usersDelete/'. $uinfo->ID)}}" onclick="return chackDelete()">Delete</a>
         </td>
        </tr>
        @endforeach
        </tbody>
       
   </table>


@stop