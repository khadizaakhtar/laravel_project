<!DOCTYPE html>
<html>
<head>
	<title>laravel admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}"> 

  <link type="text/css" rel="stylesheet" href="{{asset('DataTables/media/css/jquery.dataTables.min.css')}}">
  <link type="text/css" rel="stylesheet" href="{{asset('DataTables/media/css/dataTables.responsive.css')}}"> 
  <link type="text/css" rel="stylesheet" href="{{asset('select2/select2.css')}}">
  


  {{HTML::style('css/bootstrap.css');}}
	{{HTML::style('css/datepicker.css');}}
	{{HTML::style('css/bootstrap-theme.css');}}

	{{HTML::script('js/jquery.min.js');}}
  {{HTML::script('js/bootstrap.js');}}

  

  {{HTML::script('DataTables/media/js/jquery.dataTables.min.js');}}
  {{HTML::script('DataTables/media/js/dataTables.responsive.min.js');}}

	{{HTML::script('DataTables/resources/syntax/shCore.js');}}
  {{HTML::script('DataTables/resources/demo.js');}}

  {{HTML::script('select2/select2.js');}}


<script type="text/javascript">
        function chackDelete(){
              var chack=confirm("Are You Sure to delete this ?");
              if(chack){
                return true;
              }else{
                return false;
              }
            }
</script>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{URL::to('/deshboard')}}">Laravel</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      @if(Auth::adminlogin()->user())
        <li class="@if(isset($loc_active)){{$loc_active}}@endif"><a href="{{URL::to('/location')}}">Manage Location</a></li>
        <li class="@if(isset($cui_active)){{$cui_active}}@endif"><a href="{{URL::to('/cuisine')}}">Manage Cuisine</a></li>
        <li class="@if(isset($res_active)){{$res_active}}@endif"><a href="{{URL::to('/restaurant')}}">Manage Restaurant</a></li>
        <li class="@if(isset($cat_active)){{$cat_active}}@endif"><a href="{{URL::to('/category')}}">Manage Menu</a></li>     
        <li class="@if(isset($top_active)){{$top_active}}@endif"><a href="{{URL::to('/topping')}}">Toppings</a></li>

        <li class="@if(isset($inv_active)){{$inv_active}}@endif"><a href="{{URL::to('/invoice')}}">Invoice</a></li>
        <li class="@if(isset($cms_active)){{$cms_active}}@endif"><a href="{{URL::to('/cms')}}">CMS</a></li>
        <li class="@if(isset($use_active)){{$use_active}}@endif"><a href="{{URL::to('/users')}}">Users</a></li>
        <li class="@if(isset($won_active)){{$won_active}}@endif"><a href="{{URL::to('/owner')}}">Restaurant Owner</a></li>
      @endif
       @if(Auth::ownerlogin()->user()) 
        <li class="@if(isset($res_active)){{$res_active}}@endif"><a href="{{URL::to('/restaurant')}}">Manage Restaurant</a></li>
        <li class="@if(isset($pro_active)){{$pro_active}}@endif"><a href="{{URL::to('/product')}}">Manage Product</a></li>
        <li class="@if(isset($inv_active)){{$inv_active}}@endif"><a href="{{URL::to('/invoice')}}">Invoice</a></li>
        @endif
      </ul>
    
       <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">

          @if(Auth::adminlogin()->user())
          <img src="{{URL::to('images/'.Auth::adminlogin()->user()->image)}}" width="40%">
          {{Auth::adminlogin()->user()->firstname.' '.Auth::adminlogin()->user()->lastname}}
            <li><a href="{{URL::to('/profile')}}">Profile Setting</a></li>
            <li><a href="{{URL::to('/createAdmin')}}">Create Admin</a></li>
          @endif

          @if(Auth::ownerlogin()->user())
          <img src="{{URL::to('images/'.Auth::ownerlogin()->user()->image)}}" width="40%">
          {{Auth::ownerlogin()->user()->firstname.' '.Auth::ownerlogin()->user()->lastname}}
          <li><a href="{{URL::to('/profile')}}">Profile Setting</a></li>

          @endif

            <li class="divider"></li>
            <li><a href="{{URL::to('/adminLogout')}}">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>  

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="clear" style="margin-top:40px;"></div>
   <div class="container mainColor" style="margin-bottom:100px;">
      @yield('mainContent')
  </div>


     <div class="container-fluid navbar navbar-default navbar-fixed-bottom">
     
    </div>


<link type="text/css" res="stylesheet" href="{{asset('css/datepicker.css')}}"> 
{{HTML::script('js/bootstrap-datepicker.js');}}

<script type="text/javascript">
  
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 
var checkin = $('.dpd1').datepicker({
onRender: function(date) {
return date.valueOf() < now.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
if (ev.date.valueOf() > checkout.date.valueOf()) {
var newDate = new Date(ev.date)
newDate.setDate(newDate.getDate() + 1);
checkout.setValue(newDate);
}
checkin.hide();
$('.dpd2')[0].focus();
}).data('datepicker');
var checkout = $('.dpd2').datepicker({
onRender: function(date) {
return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
checkout.hide();
}).data('datepicker')
</script>
</body>
</html>