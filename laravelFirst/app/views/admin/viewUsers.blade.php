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
<h1>View Users</h1>
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
         <th>Mobile</th>
         <th>Address</th>
         <th>Image</th>
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
         <th>Mobile</th>
         <th>Address</th>
         <th>Image</th>
         <th>Action</th>

       </tr>
      </tfoot> 
      
       <tbody>
        @foreach($users as $uinfo)
        <tr>
        <td></td>
         <td>{{$uinfo->ID}}</td>
         <td>{{$uinfo->firstname}}</td>
         <td>{{$uinfo->lastname}}</td>
         <td>{{$uinfo->email}}</td>
         <td>{{$uinfo->user_mobile}}</td>
         <td>{{$uinfo->user_address}}</td>
         <td><img src="{{URL::to('images/'.$uinfo->image)}}" width="50%"></td>
         <td>
           <a class="btn btn-danger" href="{{URL::to('/usersDelete/'. $uinfo->ID)}}" onclick="return chackDelete()">Delete</a>
         </td>
        </tr>
        @endforeach
        </tbody>
       
   </table>


@stop