<?php 

class AdminController extends BaseController{

public function __construct(Admin $admin){       
          $this->admin=$admin;
          $data=array();
          $this->beforefilter('csrf',array('on'=> 'post'));
      }


	public function index(){
		if(Auth::adminlogin()->check()){
			return Redirect::to('deshboard');
		}else{
		return View::make('admin/login');			
		}
	}


	public function login(){
		$loginData=array('username'=> Input::get('username'), 'password'=>Input::get('password'));

		$rules=array('username'=>'required','password'=>'required');
		  $validation=Validator::make($loginData, $rules);

		if($validation->fails()){
			return Redirect::back()->withErrors($validation);
		}else{
			$activation = DB::table('tbl_admin')->where('username',Input::get('username'))->first();
			
			if($activation){
				if($activation->activation == 1 && $activation->type == 'admin'){
					if(Auth::adminlogin()->attempt($loginData)){
				  		return Redirect::to('/deshboard');
					}else{
						Session::flash('login_error','Sorry username and password wrong');
						return Redirect::back();
					}
				}else{
					if($activation->activation == 1){
						if(Auth::ownerlogin()->attempt($loginData)){
							return Redirect::to('/deshboard');
						}else{
							Session::flash('login_error','Sorry username and password wrong');
							return Redirect::back();
						}
					}else{
						
						$msg = "Your Account is Disable ! Please Contact Admin <a href=".URL::to('/contact').">click here</a>";
						Session::flash('login_error',$msg);
						return Redirect::back();
					}
				}
			}else{
				Session::flash('login_error','Sorry username and password wrong');
				return Redirect::back();
			}
		}
	}


	public function home(){	
		return View::make('admin/index');
	}


	public function logout(){
		Auth::adminlogin()->logout();
		Auth::ownerlogin()->logout();
		return Redirect::to('/admin');
	}


	public function createAdmin()
	{
		$rules=array(
			'firstname'=>'required',
			'lastname' => 'required',
			'username' => 'required|unique:tbl_admin,username',
			'email' => 'required|email|unique:tbl_admin,email',
			'retype_email' => 'required|same:email',
			'password' => 'required',
			'retype_password' => 'required|same:password',
			);
		
		if(Input::get('submit')){
			$validation=Validator::make(Input::all(),$rules);
			if($validation->fails()){
		    return View::make('admin/createAdmin')->withErrors($validation);		
			}
	   	 	else{
	   	 		 if(Input::hasfile('image'))
                {
                    $image=Input::file('image');
                    $image->getClientOriginalName();
                    $destination_path='images/';
                    $image_name=str_random(6) . '.jpg';               
                    $upload=$image->move($destination_path,$image_name);
                    //Image::make($upload=$image->getRealPath())->resize(200, 200)->save('public/img.jpg');

                }else{
                	$image_name = '';
                }
	    	$InputData=array(
	    		'type' => 'admin',
				'firstname' => Input::get('firstname'),
				'lastname' => Input::get('lastname'),
				'username' => Input::get('username'),
				'email' => Input::get('email'),
				'password' => Hash::make(Input::get('password')),
				'image' => $image_name,
				'activation' => 1
			);
			 $save=$this->admin->saveData($InputData);
			 if($save){
			 	Session::flash('message','Successfully Create Admin!');
			 }else{
			 	Session::flash('message','Admin not Create');
			 }
			 return View::make('admin/createAdmin');

			}
		}else{
		 return View::make('admin/createAdmin');
		}

	}


	public function profile(){		

		if(Auth::adminlogin()->user()){
			$adminID=Auth::adminlogin()->User()->ID;
		}else{
			$adminID=Auth::ownerlogin()->User()->ID;			
		}	

		$adminData=$this->admin->getAdmin_by_id($adminID);

		$rules = array(
				'firstname' => 'required',
				'lastname' => 'required',
				'username' => 'required|unique:tbl_admin,username,'.$adminID,
				'email' => 'required|unique:tbl_admin,email,'.$adminID,
				
			);
		if(Input::get('submit')){
			$validation = Validator::make(Input::all(),$rules);
		if($validation->fails()){
				return View::make('admin/adminProfile')->with('adminData',$adminData)->withErrors($validation);
		}else{
		if(Input::get('submit'))
		{
			$profileData = array(
					'firstname' => Input::get('firstname'),
					'lastname' => Input::get('lastname'),
					'username' => Input::get('username'),
					'email' => Input::get('email'),					
				);

			if(Input::get('password') !=''){
				$profileData['password'] = Hash::make(Input::get('password'));
			}

			if(Input::file('image') !='')
			{
			$image = Input::file('image');
			$imageName = time().'.'.$image->getClientOriginalExtension();
			$uploadPath = 'images/'.$imageName;
			Image::make($image->getRealPath())->resize(400,350)->save($uploadPath);

			$profileData['image'] = $imageName;
			}

			$result = $this->admin->update_profile($adminID, $profileData); 
			if($result){
				Session::flash('msg', 'Your Account Successfully Updated');
				return Redirect::to('/profile');
			}
		}
		}
		}

		return View::make('admin/adminProfile')->with('adminData',$adminData);
	}


	public function forget(){
		if(Input::get('submit'))
		{

			$validation=Validator::make(Input::all(),array('email'=>'required'));

			if($validation->passes())
			{
				 $email=Input::get('email');

				 $code=$this->admin->get_forget_data($email);

				if(count($code)>0)
				{
					 $url=URL::to('/password_reset',$code);
					  
					 $mailcontent=array(
	 						'subject' => "Password reset",
	 						'message' => "Hi, please contact this tarekmonjur@gmail.com for any problem.",
	 						'link' => $url,
					 );

					 Mail::send('emails.forgetmail',$mailcontent, function($mail){	
					 	$mail->from('tarek@sahajjo.com','tarek');			 	
					 	$mail->to(Input::get('email'),'test')->subject('Admin panel password Reset');
					 });

					 Session::flash('forget','Your Message Successfully Send, Please check you Mail!');
					 return View::make('admin/forget');

				}else{
                    return Redirect::back()->with('forget_error', 'This email not valid');
				}

			}else{
				return View::make('admin/forget')->withErrors($validation);				
			}

		}else{
			return View::make('admin/forget');			
		}

	}



	public function password_reset($code){

		if(Input::get('submit'))
		{
			$password=Hash::make(Input::get('password'));
			$reset=$this->admin->reset_password($password,Session::get('token'));

			if($reset)
			{
				Session::flash('reset_msg','your password Successfully Reset, please login');
				return View::make('admin/login');
			}else{
				Session::flash('reset_msg','your password not Reset');
			}

		}else{
			Session::put('token',$code);
			return View::make('admin/reset');
		}

	}



	public function woner(){
		$data['won_active'] = "active";
		$data['woner'] = Admin::join('tbl_restaurant','tbl_restaurant.owner_id', '=', 'tbl_admin.ID')->where('type','')->get();
		return View::make('admin/woner',$data);
	}



	public function owneractive($active,$id){
		$data['won_active'] = "active";
		Admin::where('ID',$id)->update(array('activation' => $active));
		DB::table('tbl_restaurant')->where('owner_id',$id)->update(array('activation'=>$active));
		return Redirect::to('/owner');
	}







}