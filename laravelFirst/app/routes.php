<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
   {
    $name=array('active1'=>'active');
    $data['cuisine'] = with(new Cuisine)->get_cuisine();
    $data['location'] = DB::table('tbl_location')->get();
    $data['restaurant'] = DB::table('tbl_restaurant')->where('activation',1)->get();

    return View::make('index',$data)->with($name);   
  });
  

Route::get('/about',function()
   {
    $name=array('active2'=>'active');
    return View::make('about',$name); 
   });
   

Route::get('/gallery', function(){
    return View::make('gallery',$active=array('active3'=>'active'));
});   


 Route::get('/contact', function(){
     return View::make('contact',array('active4'=>'active'));
 });



Route::get('/view', 'HomeController@viewContact')->before('guests'); 
Route::get('/deleteContact/{id}', 'HomeController@deleteContact')->before('guests');
Route::get('/editContact/{id}', 'HomeController@editContact')->before('guests');
Route::post('/updateContact','HomeController@updateContact')->before('guests');
Route::post('/contact', 'HomeController@contact')->before('csrf');  
Route::any('/signUp','HomeController@signup')->before('guest');
Route::post('/login','HomeController@login');
Route::get('/logout', 'HomeController@logout')->before('guests');
Route::any('/setting', 'HomeController@setting')->before('guests');
Route::any('/forgetpassword', 'HomeController@forgetpassword');
Route::any('/reset/{code}', 'HomeController@reset');

Route::get('/foods/{rid}', 'HomeController@foods');
Route::get('/foods/{rid}/{cid}', 'HomeController@foods');

Route::post('/search_restaurant', 'HomeController@search_restaurant');

Route::get('/order', 'InvoiceController@Order')->before('guests');
Route::get('/viewOrder/{id}', 'InvoiceController@viewOrder')->before('guests');

Route::any('/cuisineRestaurant/{id}', 'HomeController@cuisine_restaurant');


//admin panel Routing 
Route::get('/admin','AdminController@index');
Route::post('/adminlogin','AdminController@login');
Route::get('/deshboard',array('before'=>'checklogin', 'uses'=>'AdminController@home'));
Route::get('/createAdmin','AdminController@createAdmin')->before('guestadmin');
Route::post('/createAdmin','AdminController@createAdmin')->before('guestadmin');
Route::get('/adminLogout','AdminController@logout');
Route::get('/profile','AdminController@profile')->before('checklogin');
Route::post('/profile','AdminController@profile')->before('checklogin');
Route::any('/password_reset/{code}','AdminController@password_reset');
Route::any('/forget','AdminController@forget');

//Product Route
Route::any('/product','ProductController@product')->before('checklogin');
Route::any('/addproduct','ProductController@addproduct')->before('checklogin');
Route::any('/deleteProduct/{id}','ProductController@deleteProduct')->before('checklogin');
Route::any('/editProduct/{id}','ProductController@editProduct')->before('checklogin');

//Category Route
Route::any('/category','CategoryController@category')->before('guestadmin');
Route::any('/addcategory','CategoryController@addcategory')->before('guestadmin');
Route::any('/deleteCategory/{id}','CategoryController@deleteCategory')->before('guestadmin');
Route::any('/editCategory/{id}','CategoryController@editCategory')->before('guestadmin');

//Location Route
Route::any('/location','LocationController@location')->before('guestadmin');
Route::any('/addlocation','LocationController@addlocation')->before('guestadmin');
Route::any('/deleteLocation/{id}','LocationController@deleteLocation')->before('guestadmin');
Route::any('/editLocation/{id}','LocationController@editLocation')->before('guestadmin');

//Restaurant Route
Route::any('/restaurant', 'RestaurantController@restaurant')->before('checklogin');
Route::any('/addrestaurant', 'RestaurantController@addrestaurant');
Route::any('/deleterestaurant/{id}', 'RestaurantController@deleterestaurant')->before('checklogin');
Route::any('/editrestaurant/{id}', 'RestaurantController@editrestaurant')->before('checklogin');

//Invoice Route
Route::any('/invoice', 'InvoiceController@invoice')->before('checklogin');
Route::any('/deleteInvoice/{id}', 'InvoiceController@deleteInvoice')->before('checklogin');
Route::any('/detailsInvoice/{id}', 'InvoiceController@detailsInvoice')->before('checklogin');
Route::any('/downloadPDF/{id}', 'InvoiceController@downloadPDF')->before('checklogin');
Route::any('/completeOrder/{id}', 'InvoiceController@completeOrder')->before('checklogin');

//Topping Route
Route::any('/topping', 'ToppingController@topping')->before('guestadmin');
Route::any('/addtopping', 'ToppingController@addtopping')->before('guestadmin');
Route::any('/deleteTopping/{id}', 'ToppingController@deleteTopping')->before('guestadmin');
Route::any('/editTopping/{id}', 'ToppingController@editTopping')->before('guestadmin');

//Cuisine Route
Route::any('/cuisine', 'CuisineController@cuisine')->before('guestadmin');
Route::any('/addcuisine', 'CuisineController@addcuisine')->before('guestadmin');
Route::any('/editcuisine/{id}', 'CuisineController@editcuisine')->before('guestadmin');
Route::any('/deletecuisine/{id}', 'CuisineController@deletecuisine')->before('guestadmin');

//CMS Route
Route::any('/cms', 'cmsController@cms')->before('guestadmin');
Route::any('/cmsDelete/{id}', 'cmsController@cmsDelete')->before('guestadmin');
Route::any('/cmsEdit/{id}', 'cmsController@cmsEdit')->before('guestadmin');

//Admin User Route
Route::any('/users', 'UsersController@users')->before('guestadmin');
Route::any('/usersDelete/{id}', 'UsersController@usersDelete')->before('guestadmin');

//Restaurant Woner Route
Route::any('/owner', 'AdminController@woner')->before('guestadmin'); 
Route::any('/owneractive/{active}/{id}', 'AdminController@owneractive')->before('guestadmin');

//cart Routing
Route::any('/addCart/{id}/{qty}/{topping}', 'CartController@addCart');
Route::any('/viewCart', 'CartController@viewCart');
Route::post('/deleteCart', "CartController@deleteCart");
Route::post('/gettotal',function(){
  $total = Cart::total();
  return $total;
});
Route::any('/checklogin','CartController@checklogin');
Route::any('/delivery', 'CartController@delivery')->before('guests');











// Route::post('contact', function(){ 
    // $data=Input::all();

     // $required=array(
       // 'name'=>'required',
        // 'email'=>'required'
    // ); 
     
     // $validetion=Validator::make($data,$required);
      // if($validetion->fails()){
          // return Redirect::to('contact')->withErrors($validetion)->withInput();  
       // }else{
	      // $save=DB::table('tbl_contact')->insert($data); 					
					 // return Redirect::to('contact');
	   // }

       // $emailcontant=array(
            // 'subject'=>$data['subjcet'],
            // 'message'=>$data['message'],    
        // );

       // Mail::send('emails.contactemail',$emailcontant,function($email){
        // $email->to('tarek@sahajjo.com','tarek')->subject('sdfsd');
         // });

       // return "save success";
       // return View::make('/contact');
        
// }); 







//Route::get('/', function()
//{
//        $username='tarek ahammed monjur';
//        $email='tarek@gmail.com';
//        $password='admin';
//        
//        $data=array();
//        $data['address']='mohakali gulshan';
//        $data['mobile']=01832308565;
//        
//	return View::make('home',$data)->with(array(
//            'name' => $username,
//            'email'=>$email,
//        ));
//     
//     
//        $data=array('colors'=>array('red','white','black'));
//        
//        $data['hello'] = View::make('hello');
//        $data['name']='tarekmonjur';
//        $data['testblade']=View::make('test',$data);
//        return View::make('home',$data);
//    
//          $data=array('name'=>'tarek','email'=>'tarek@yahoo.com');
//          $hello= View::make('hello');
//          $home= View::make('home',$data);
//          return $hello . $home;
//    
//});









//Route::get('abc', function()
//{
//	return "ABC";
//});
//
//Route::post('foo/bar',function()
//{
//  return "this is my first laravel";   
//});


//Route::match(array('GET','POST'),'/', function()
//        {
//            return "hello world";
//        });
//

//Route::any('foo',function()
//   {
//    return "tarek monjur";
//   });

//$url = URL::to('foo');
//
//Route::get('/foo', array('https', function()
//{
//    return 'Must be over HTTPS';
//}));
//Route::pattern('id', '[0-9]+');
//
//Route::get('user/{id}',function($id)
//        {
//    return 'tarek'.$id;
//        });