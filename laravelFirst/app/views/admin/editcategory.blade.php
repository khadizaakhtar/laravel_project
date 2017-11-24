@extends('admin/layout');
@section('mainContent');

<h2>Edit Menu</h2>

<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>

@if(Session::has('cat_msg'))
{{Session::get('cat_msg')}}
@endif

<div class="row">

{{Form::open(array('action'=>'CategoryController@editCategory','enctype'=>'multipart/form-data'))}}
@foreach($category as $cinfo)

  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputEmail1">Menu Name</label>
    <input type="hidden" value="{{$cinfo->category_id}}" name="id">
    <input type="text" name="category_name" value="{{$cinfo->category_name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
  </div>

  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputEmail1">Menu Type</label>
    <select class="form-control" name="type">
      <option value="0">...Preant...</option>
      @foreach($allcategory as $info)
      <option value="{{$info->category_id}}" @if($cinfo->type == $info->category_id){{"selected"}} @endif>{{$info->category_name}}</option>
      @endforeach
    </select>
  </div>
  
  <div class="form-group col-sm-4 col-sm-offset-2">
    <label for="exampleInputFile">Menu Picture</label>
    <input type="file" name="image" id="exampleInputFile" class="btn btn-primary">
  </div>
  <div class="form-group col-sm-4">
    <img src="{{URL::to('images/category/thumbs/'.$cinfo->c_image)}}" width="35%">
  </div>

 <div class="form-group col-sm-8 col-sm-offset-2">

  <input type="submit" name="submit" value="Update Menu" class="btn btn-success col-sm-2">
 </div>
 @endforeach
{{Form::close()}}
</div>
@stop