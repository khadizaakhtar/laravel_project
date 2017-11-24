@extends('admin/layout');
@section('mainContent');

<h2>Add Menu</h2>
<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>

<div class="row">
{{Form::open(array('action'=>'CategoryController@addcategory','enctype'=>'multipart/form-data'))}}
  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputEmail1">Menu Name</label>
    <label style="color:red;font-size:18px;">*</label>

    <input type="text" name="category_name"  class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
  </div>

  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputEmail1">Menu Type</label>
    <select class="form-control" name="type">
      <option value="0">...Preant...</option>
      @foreach($allcategory as $info)
      <option value="{{$info->category_id}}">{{$info->category_name}}</option>
      @endforeach
    </select>
  </div>
  
  <div class="form-group col-sm-8 col-sm-offset-2">
    <label for="exampleInputFile">Menu Picture</label>
    <label style="color:red;font-size:18px;">*</label>
    
    <input type="file" name="image" id="exampleInputFile" class="btn btn-primary">
  </div>
 <div class="form-group col-sm-8 col-sm-offset-2">
  <input type="submit" name="submit" value="Add Menu" class="btn btn-success col-sm-2">
 	
 </div>
{{Form::close()}}
</div>
@stop