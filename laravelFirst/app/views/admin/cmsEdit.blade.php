@extends('admin/layout');

<script src="{{asset('tinymce/js/tinymce/tinymce.min.js');}}"></script>
<script src="{{asset('plupload-2.1.2/js/moxie.min.js');}}"></script>
<!--<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>-->
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "jbimages advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons |  jbimages",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
     relative_urls : false
});
</script>

@section('mainContent');
<h2>Edit CMS</h2>

<h4 style="color:red">{{HTML::ul($errors->all())}}</h4>
@if(Session::has('msg'))
{{Session::get('msg')}}
@endif

{{Form::open(array('action'=>'cmsController@cmsEdit','enctype'=>'multipart/form-data'))}}

@foreach($single_cms as $cmsinfo)
  <div class="form-group col-sm-8 col-sm-offset-2">
    <label >Content Title</label>
    <input type="hidden" value="{{$cmsinfo->content_id}}" name="id">
    <input type="text" name="content_title" value="{{$cmsinfo->content_title}}"  class="form-control" placeholder="Enter First Name">
  </div>

  <div class="form-group col-sm-8 col-sm-offset-2">
    <label >Content Description</label>
    <textarea name="content_description" rows="10" class="form-control"  placeholder="Enter Last Name">
      {{$cmsinfo->content_description}}
    </textarea> 
  </div>
  

 <div class="form-group col-sm-8 col-sm-offset-2">
  <input type="submit" name="submit" value="Update CMS" class="btn btn-success col-sm-2">
 	
 </div>
 @endforeach
{{Form::close()}}
@stop