<html>
	<head>
		<title>Home page</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}"> 
  <link type="text/css" rel="stylesheet" href="{{asset('select2/select2.css')}}"> 


  {{HTML::style('css/bootstrap.css');}}
  {{html::style('bootstrp-theme.css');}}

  {{HTML::script('js/jquery.min.js');}}
  {{HTML::script('js/bootstrap.js');}}


  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
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
    
          <nav class="navbar navbar-default navbar-fixed-top " role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a  href="#"><img class="logo" src="{{URL::to('images/logo.png')}}"></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php if(isset($active1)){ echo $active1;}?>"><a href="{{URL::to('/')}}">Home</a></li>
        <li class="<?php if(isset($active2)){ echo $active2;}?>"><a href="{{URL::to('/about')}}">About US</a></li>
        <li class="<?php if(isset($active4)){ echo $active4;}?>"><a href="{{URL::to('/contact')}}">Contact US</a></li>
        <li class="<?php if(isset($res_active)){echo $res_active;}?>"><a href="{{URL::to('/addrestaurant')}}">Add Restaurant</a></li>

        <!-- <li class="<?php if(isset($active3)){ echo $active3;}?>"><a href="{{URL::to('/gallery')}}">Gallery</a></li> -->
        @if(Auth::userlogin()->check())       
        <!-- <li class="<?php if(isset($active5)){ echo $active5;}?>"><a href="{{URL::to('/view')}}">View Contact</a></li> -->
        <li class="<?php if(isset($active6)){ echo $active6;}?>"><a href="{{URL::to('/order')}}">Your Order</a></li>
        <li ><a href="{{URL::to('/logout')}}">LogOut</a></li>

        @else
        <li class="<?php if(isset($active6)){ echo $active6;}?>"><a href="{{URL::to('/signUp')}}">Sign Up</a></li> 
        @endif

      </ul>
      @if(Auth::userlogin()->check())
 <ul class="nav navbar-nav navbar-right">
   <li class="<?php if(isset($set_active)){echo $set_active;}?>"><a href="{{URL::to('/setting')}}">Account Settings</a></li>
 </ul>
 @endif


@if(!Auth::userlogin()->check())

{{Form::open(array('action'=>'HomeController@login', 'class'=>'navbar-form navbar-right form-inline','role'=>'form'))}}
    <!--  {{HTML::ul($errors->all())}} -->

@if(Session::has('loginerror'))
<span style="color:red; font-size:12px;">{{Session::get('loginerror')}}</span>
@endif

  <div class="form-group">
    <input type="text" name="username" class="form-control" placeholder="<?php if($errors->has('username')){echo $errors->first('username', 'UserName is required');}else{echo 'Enter Username';}?>">  
  </div>

  <div class="form-group">
    <input type="password" name="password"  class="form-control"  placeholder="<?php if($errors->has('password')){echo $errors->first('password', 'password is required');}else{echo 'Enter password';}?>">
    
  </div>
  <button type="submit" value="login" name="login" class="btn btn-success">SignIn</button>
 <a style="font-size:11px;" href="{{URL::to('/forgetpassword')}}">Forget password</a>

{{Form::close()}}

@endif

<ul class="nav navbar-nav navbar-right">
 @if(Auth::userlogin()->check())
</h5>
@endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="clear" style="margin-top:70px;"></div>
   <div class="container" style="margin-bottom:100px;">
			@yield('mainContant')
	</div>

     <div class="nav navbar navbar-default" style="margin-bottom:0px;">
			 <div id="footer">
        <?php 
        $footer = DB::table('tbl_cms')->where('content_id',3)->pluck('content_description');
        echo "<div class='footer_content'>" .$footer. "</div>";
        ?>
       </div>
    </div>
        <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>

        <script type="text/javascript" src="{{asset('select2/select2.js')}}"></script>
		
	</body>
</html>