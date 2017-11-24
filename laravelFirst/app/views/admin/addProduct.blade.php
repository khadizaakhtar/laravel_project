@extends('admin/layout');
@section('mainContent');
<h2>Add Product</h2>

<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>
@if(Session::has('product_msg'))
{{Session::get('product_msg')}}
@endif

{{Form::open(array('action'=>'ProductController@addproduct','enctype'=>'multipart/form-data'))}}
  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputEmail1">Product Name</label>
    <label style="color:red;font-size:18px;">*</label>

    <input type="text" name="name"  class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
  </div>

  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputEmail1">Product Menu</label>
    <label style="color:red;font-size:18px;">*</label>

   <select class="form-control" name="category">
      <option value="">Select Product Menu</option>
      @foreach($category as $cinfo)
      @if($cinfo->type==0)
      <option value="{{$cinfo->category_id}}">{{$cinfo->category_name}}</option>
      @endif
      @foreach($category as $sinfo)
      @if($cinfo->category_id == $sinfo->type)
      <option value="{{$sinfo->category_id}}">&nbsp;&nbsp;&nbsp;{{$sinfo->category_name}}</option>
      @endif
      @endforeach
      @endforeach
    </select>
  </div>

  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputEmail1">Product Price</label>
    <label style="color:red;font-size:18px;">*</label>

    <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name">
  </div>
  
  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputFile">Product Picture</label>
    <label style="color:red;font-size:18px;">*</label>
    
    <input type="file" name="image" id="exampleInputFile" class="btn btn-primary">
  </div>
 <div class="form-group col-sm-8 col-sm-offset-2">
  <input type="submit" name="submit" value="Add Product" class="btn btn-success col-sm-2">
 	
 </div>
{{Form::close()}}
@stop