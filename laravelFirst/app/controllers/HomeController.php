<?php
/**
* Author : TAREK AHAMMED
* Conmany : THE RSSOFTWARE
*/
class HomeController extends BaseController {
    
      public function __construct(User $user, Site $site){       
          $this->user=$user;
          $this->site = $site;
          $this->beforefilter('csrf',array('on'=> 'post'));
          
      }

    public function contact() {

        //$data=Input::all();
        $data = array();
        $data['user_id'] = Auth::userlogin()->id();
        $data['name'] = Input::get('name');
        $data['email'] = Input::get('email');
        $data['mobile'] = Input::get('mobile');
        $data['message'] = Input::get('message');

        //var_dump($data);

        $required = array(
            'name' => 'required|min:5',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'message' => 'required',
        );
        if ($data) {
            $validetion = Validator::make($data, $required);
            if ($validetion->fails()) {
                return Redirect::to('contact')->withErrors($validetion)->withInput();
            } else {

                Mail::send('emails.contactMail', array('msg' => Input::get('message'),'name' => Input::get('name'),'mobile' => Input::get('mobile')), function($mail){
                    $mail->from(Input::get('email'), Input::get('name'));
                    $mail->to('tarek@sahajjo.com','tarekmonjur')->subject('Contact Information');
                });
                /*$save = DB::table('tbl_contact')->insert($data);*/

                $User= new User();
                $save=$User->saveData($data);

                /*$save=with(new User)->saveData($data);*/

                if ($save) {
                    Session::flash('message', 'save data');
                    return Redirect::to('contact');
                } else {
                    Session::flash('message', 'data not save');
                    return Redirect::to('contact');
                }
            }
        }
        return View::make('contact');
    }


    // public function viewContact(){
    //     $data=array();
    //     $data['active5']='active';
    //     $data['info']=with(new User)->selectContact();
     
    //     return View::make('view')->with($data);
    // }


    // public function deleteContact($id){
    //      $delete=with(new User)->deleteContactById($id);
    //      if($delete){
    //            Session::flash('message','Successfully Delete!');
    //      }else{
    //            Session::flash('message','Delete not Success');
    //      }
    //      return Redirect::to('view');
    // }


    // public function editContact($id){
    //     $data=array();
    //     $data['info']=$this->user->selectContactById($id);
    //     return View::make('edit')->with($data);
    // }


    // public function updateContact(){
    //     $data=array();
    //     $id=$data['id']=Input::get('id');
    //     $data['name']=Input::get('name');
    //     $data['email']=Input::get('email');
    //     $data['mobile']=Input::get('mobile');
    //     $data['message']=Input::get('message');

    //     $required=array(
    //             'name'=>'required|min:5|max:20',
    //             'email'=>'required|email',
    //             'mobile'=>'required|numeric'
    //         );

    //     $validation=Validator::make($data, $required);
    //     if($validation->fails())
    //     {
    //      return Redirect::to('editContact/'.$id)->withErrors($validation)->withInput();
    //     }
    //     else
    //     {
    //         $update=$this->user->updateContact($data);
    //         if($update)
    //         {
    //          Session::flash('message','Information Successfully Update!');
    //         }
    //         else
    //         {
    //          Session::flash('message','Information not Update!');
    //         }
    //         return Redirect::to('view');
    //     }
  
    // }



public function signup()
    {
        $data=array();
        $active['active6']='active';


 // $rules = array(
 //    'firstname'=>'required|alpha|min:2',
 //    'lastname'=>'required|alpha|min:2',
 //    'email'=>'required|email|unique:users',
 //    'password'=>'required|alpha_num|between:6,12|confirmed',
 //    'password_confirmation'=>'required|alpha_num|between:6,12'
 //    );

        if(Input::get('submit'))
        {
            $validation=Validator::make(Input::all(), array(
                                                        'firstname' => 'required|alpha',
                                                        'lastname' => 'required|alpha',
                                                        'user_name' => 'required|unique:tbl_user,username|min:5|max:16',
                                                        'mobile' => 'required',
                                                        'email' => 'required|unique:tbl_user',
                                                        'reemail' => 'required|same:email',
                                                        'Password' => 'required|confirmed',
                                                        'Password_confirmation' => 'required',
                                                        'address' => 'required',
                                                        'image' => 'required'
                                                        ));
        
            if($validation->fails()){
                return View::make('signup',$active)->withErrors($validation)->withInput(Input::all());
            }
            else
            {
                $data['firstname'] = Input::get('firstname');
                $data['lastname'] = Input::get('lastname');
                $data['username'] = Input::get('user_name');
                $data['user_mobile'] = Input::get('mobile');
                $data['email'] = Input::get('email');
                $password = Input::get('Password');
                $data['password'] = Hash::make($password);
                $data['user_address'] = Input::get('address');

                if(Input::hasfile('image'))
                {
                     $image=Input::file('image');
                     $imageName = time().'.'.$image->getClientOriginalExtension();
                     $uploadPath = 'images/'.$imageName;
                     $upload = Image::make($image->getRealPath())->resize(400,350)->save($uploadPath);

                    if($upload){
                    $data['image']=$imageName;
                    }
                }

                $save=$this->user->signupUser($data);

                if($save)
                {
                Session::flash('message','Successfully Sign Up!');
                }
                else
                {
                Session::flash('message','Sign up not Successfully');
                }

                return View::make('signup',$active);
            }
        }
        else
        {
        return View::make('signup',$active);
        }
    }





public function login()
    {

        $loginData=array(
            'username'=>Input::get('username'),
            'password'=>Input::get('password'),
            );
// print_r(Auth::attempt($loginData));
// exit();

        $rules=array('username'=>'required','password'=>'required');

        $validation=Validator::make($loginData, $rules);

        if($validation->passes()){
        if(Auth::userlogin()->attempt($loginData))
        {
            return Redirect::to('/');
        }else{
            return Redirect::back()->with('loginerror','Username/password wrong');
        }
        }else{
            return Redirect::back()->withErrors($validation);
        }
    
        // $validation=Validator::make(Input::all(),array('username'=>'required','password'=>'required'));
        // if($validation->fails()){
        //     return Redirect::back()->withErrors($validation);
        // }else{
        //     $userData=array();
        //     $userData=$this->user->loginuser(Input::all());
        //     if($userData){       
        //         Session::push('user',$userData);
        //         return Redirect::to('/');
        //     }else{
        //         return Redirect::back();
        //     }
        // }

    }


    public function logout(){
       Auth::userlogin()->logout();
       // Session::flush();
        return Redirect::to('/');
    
    }


    public function search_restaurant(){
        $cid=Input::get('cuisine');
        $lid=Input::get('location');

        $data['cuisine'] = with(new Cuisine)->get_cuisine();
        $data['cuid'] =$cid;

        if(Input::get('find')){
          $validation = Validator::make(Input::all(),array('location' => 'required'));  
        
            if($validation->fails()){
                return Redirect::to('/')->withErrors($validation);
            }
        }

        if($lid){
        $location = DB::table('tbl_location')->where('location_id',$lid)->first();
        Session::put('location', $location->location_name); 
        Session::put('location_id', $location->location_id);       
        }

       // $data['hungry'] = DB::table('tbl_')
        $data['restaurant'] = $this->site->search_restaurant($cid,$lid);
        $data['response'] = $this->site->get_responsor_restaurant();
        return View::make('restaurant',$data);
    }



    public function cuisine_restaurant($cid){
      $data['cuid'] =$cid;  
      $lid = Session::get('location_id');
      $data['cuisine'] = with(new Cuisine)->get_cuisine();

      $data['restaurant'] = $this->site->search_restaurant($cid,$lid);
      $data['response'] = $this->site->get_responsor_restaurant();

      return View::make('restaurant',$data);
    }



    public function foods($rid){
        $data['category'] = $this->site->get_category($rid);

        $restaurant_id = Request::segment(2);
        Session::put('restaurant_id',Request::segment(2));

        $data['rid'] = $rid;
        $cid= Request::segment(3);
        $data['cid'] = $cid;

        $oid = DB::table('tbl_restaurant')->where('restaurant_id',$restaurant_id)->pluck('owner_id');
        $data['product'] = $this->site->get_product($cid,$oid);
        $data['restaurant'] = $this->site->get_restaruant_by_id($rid);

        return View::make('foods',$data);

    }


    public function setting(){
        $data=array();
        $data['user'] = $this->user->get_user_by_id();
        $data['set_active']='active';
        $id = Auth::userlogin()->user()->ID;
        if(Input::get('submit'))
        {
            $validation=Validator::make(Input::all(), array(
                                                        'firstname' => 'required|alpha',
                                                        'lastname' => 'required|alpha',
                                                        'user_name' => 'required|min:5|max:16|unique:tbl_user,username,'.$id,
                                                        'mobile' => 'required',
                                                        'email' => 'required|unique:tbl_user,email,'.$id,
                                                        'reemail' => 'required|same:email',
                                                        'address' => 'required'
                                                        ));
        
            if($validation->fails()){
                return View::make('setting',$data)->withErrors($validation)->withInput(Input::all());
            }
            else
            {
                $updateData['firstname']=Input::get('firstname');
                $updateData['lastname']=Input::get('lastname');
                $updateData['username']=Input::get('user_name');
                $updateData['user_mobile']=Input::get('mobile');
                $updateData['email']=Input::get('email');
                $password=Input::get('Password');
                if($password){
                $updateData['password']=Hash::make($password);                   
                }
                $updateData['user_address'] = Input::get('address');


                if(Input::hasfile('image'))
                {
                     $image=Input::file('image');
                     $imageName = time().'.'.$image->getClientOriginalExtension();
                     $uploadPath = 'images/'.$imageName;
                     $upload = Image::make($image->getRealPath())->resize(400,350)->save($uploadPath);
                    
                    if($upload){
                    $updateData['image']=$imageName;
                    }
                }

                $save=$this->user->update_user($updateData);

                if($save)
                {
                Session::flash('message','Account Successfully  Update!');
                }
                else
                {
                Session::flash('message','Account Not Update');
                }

                return Redirect::to('/setting');
            }
        }
        else
        {
        return View::make('setting',$data);
        }


    }


    public function forgetpassword(){
        if(Input::get('submit'))
        {

            $validation=Validator::make(Input::all(),array('email'=>'required'));

            if($validation->passes())
            {
                 $email=Input::get('email');

                 $code=$this->user->get_forget_data($email);

                if(count($code)>0)
                {
                     $url=URL::to('/reset',$code);
                      
                     $mailcontent=array(
                            'subject' => "Password reset",
                            'message' => "Hi, please contact this tarekmonjur@gmail.com for any problem.",
                            'link' => $url,
                     );

                     Mail::send('emails.forgetmail',$mailcontent, function($mail){  
                        $mail->from('tarek@sahajjo.com','tarek');               
                        $mail->to(Input::get('email'),'test')->subject('User password Reset');
                     });

                     Session::flash('forget','Your Message Successfully Send, Please check you Mail!');
                     return View::make('forget');

                }else{
                    return Redirect::back()->with('msg', 'This email not valid');
                }

            }else{
                return View::make('forget')->withErrors($validation);             
            }

        }else{
            return View::make('forget');          
        }

    }


public function reset($code){

        if(Input::get('submit'))
        {
            $password=Hash::make(Input::get('password'));
            $reset=$this->user->reset_password($password,Session::get('token'));

            if($reset)
            {
                Session::flash('reset_msg','your password Successfully Reset, please login');
                return Redirect::to('/');
            }else{
                Session::flash('reset_msg','your password not Reset');
            }

        }else{
            Session::put('token',$code);
            return View::make('reset');
        }

    }












}
