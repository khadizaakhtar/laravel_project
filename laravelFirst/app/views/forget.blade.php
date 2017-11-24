<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{HTML::style('css/bootstrap.css');}}
    {{html::style('bootstrp-theme.css');}}

    {{HTML::script('js/jquery.min.js');}}
    {{HTML::script('js/bootstrap.js');}}
</head>

<body>
<div class="container">
<div class="page-header">
</div>
<div class="container">
    <div class="row colored">
        <div id="contentdiv" class="contcustom">
            <span class="fa fa-spinner bigicon"></span>
            <h4 style="color:red">{{HTML::ul($errors->all())}}</h4>

            @if(Session::has('forget_error'))
            <h4 style="color:red">{{Session::get('forget_error')}}</h4>
            @endif

            @if(Session::has('forget'))
            <h4 style="color:green">{{Session::get('forget')}}</h4>
            @endif
            <h3>Forget Password</h3>
            <div>
           {{Form::open(array('action'=> 'HomeController@forgetpassword'))}}
                <input  type="text" name="email" placeholder="Enter your Email">                      
                 <input type="submit" name="submit" class="btn btn primary" value="Send Mail">
             </form>
            </div>
            <br>

            {{Form::close()}}
        </div>

    </div>
</div>

<style>
.redborder {
    border:2px solid #f96145;
    border-radius:2px;
}

.hidden {
    display: none;
}

.visible {
    display: normal;
}

.colored {
    background-color: #F0EEEE;
}

.row {
    padding: 20px 0px;
}

.bigicon {
    font-size: 97px;
    color: #f96145;
}

.contcustom {
    text-align: center;
    width: 300px;
    border-radius: 0.5rem;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 10px auto;
    background-color: white;
    padding: 20px;
}

input {
    width: 100%;
    margin-bottom: 17px;
    padding: 15px;
    background-color: #ECF4F4;
    border-radius: 2px;
    border: none;
}

h2 {
    margin-bottom: 20px;
    font-weight: bold;
    color: #ABABAB;
}

.btn {
    border-radius: 2px;
    padding: 10px;
}

.med {
    font-size: 27px;
    color: white;
}

.medhidden {
    font-size: 27px;
    color: #f96145;
    padding: 10px;
    width:100%;
}

.wide {
    background-color: #8EB7E4;
    width: 100%;
    -webkit-border-top-right-radius: 0;
    -webkit-border-bottom-right-radius: 0;
    -moz-border-radius-topright: 0;
    -moz-border-radius-bottomright: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
</style>

<!-- Interactive Login - END -->

</div>

</body>
</html>