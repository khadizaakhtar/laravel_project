@extends('admin/layout');
@section('mainContent');
<h2>Edit Product</h2>

<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>

@if(Session::has('product_msg'))
{{Session::get('product_msg')}}
@endif

{{Form::open(array('action'=>'ProductController@editProduct','enctype'=>'multipart/form-data'))}}
@foreach($product as $pinfo)

  <div class="form-group col-sm-8 col-md-offset-2">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" name="name" value="{{$pinfo->name}}"  class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
  </div>

  <div class="form-group col-sm-8 col-md-offset-2">
    <label for="exampleInputEmail1">Product Category</label>
    <select class="form-control" name="category_id">
      <option value="">...Select Product Category...</option>
      @foreach($category as $cinfo)
      <option value="{{$cinfo->category_id}}" @if($cinfo->category_id==$pinfo->category_id){{"selected"}}@endif>{{$cinfo->category_name}}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-sm-8 col-md-offset-2">
    <label for="exampleInputEmail1">Product Price</label>
    <input type="text" name="price" value="{{$pinfo->price}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name">
  </div>
  
  <div class="form-group col-sm-5 col-md-offset-2">
    <label for="exampleInputFile">Product Picture</label>
    <input type="file" name="image" id="exampleInputFile" class="btn btn-primary">
  </div>

  <div class="form-group col-sm-3">
    <img src="{{URL::to('images/product/thumbs/'.$pinfo->p_image)}}" width="40%">
  </div>

 <div class="form-group col-sm-8 col-md-offset-2">
  <input type="hidden" value="{{$pinfo->product_id}}" name="id">  
  <input type="submit" name="submit" value="Update Product" class="btn btn-success col-sm-2">
 	
 </div>
 @endforeach
{{Form::close()}}
@stop