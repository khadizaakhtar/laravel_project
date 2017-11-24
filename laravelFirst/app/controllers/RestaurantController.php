<?php

class RestaurantController extends BaseController{
	public function __construct(Restaurant $restaurant, Admin $admin){
		$this->res = $restaurant;
		$this->admin = $admin;
		$data = array();
        $this->beforefilter('csrf',array('on'=> 'post'));
		
	}

	public function restaurant(){
		$data['res_active'] = 'active';
		$data['restaurant'] = $this->res->get_restaurant();
		return View::make('admin/restaurant',$data);
	}


	public function addrestaurant()
	{
		$data['res_active'] = 'active';
		$loc = new Location();
		$data['location'] = $loc->get_location();
		$cat = new Category();
		$data['category'] = $cat->get_maincategory('');
		$data['cusine'] = with(new Cuisine)->get_cuisine();

		if(Input::has('submit')){
			$validation = Validator::make(Input::all(), array(
					'name' => 'required',
					'location' => 'required',
					'cuisine' => 'required',
					'rating' => 'required',
					'category' => 'required',
					'sponsor' => 'required',
					'address' => 'required',
					'rimage' => 'required',

					'firstname'=>'required',
					'lastname' => 'required',
					'username' => 'required|unique:tbl_admin,username',
					'email' => 'required|email|unique:tbl_admin,email',
					'retype_email' => 'required|same:email',
					'password' => 'required',
					'retype_password' => 'required|same:password',
					'pimage' => 'required',

				));

			if($validation->fails()){
				return View::make('admin/addrestaurant',$data)->withErrors($validation);
			}else{	
				// print_r(Input::all());
				// exit;			
					//owner image upload
					$image=Input::file('pimage');
                    $image->getClientOriginalName();
                    $destination_path='images/';
                    $image_name=str_random(6) . '.jpg';               
                    $upload=$image->move($destination_path,$image_name);              

				//owner data
				$InputData=array(
					'firstname' => Input::get('firstname'),
					'lastname' => Input::get('lastname'),
					'username' => Input::get('username'),
					'email' => Input::get('email'),
					'password' => Hash::make(Input::get('password')),
					'image' => $image_name
				);

				$ownerid = $this->admin->saveData($InputData);

				if($ownerid){
				//restaurant image upload
				$image = Input::file('rimage');
				$imageName = time().'.'.$image->getClientOriginalExtension();
				$path = 'images/restaurant/'.$imageName;
				Image::make($image->getRealPath())->resize('400','300')->save($path);

				$path = 'images/restaurant/thumbs/'.$imageName;
				Image::make($image->getRealPath())->resize('210','150')->save($path);

				 //restaurant data    
				$saveData = array(
						'owner_id' => $ownerid,
						'restaurant_name' => Input::get('name'),
						'location_id' => Input::get('location'),
						'rating' => Input::get('rating'),
						'sponsor' => Input::get('sponsor'),						
						'offer' => Input::get('offer'),											
						'address' => Input::get('address'),
						'r_image' => $imageName,
						'activation' => 0
					);

				$result = $this->res->add_restaurant($saveData);
				}

				if($result && $ownerid){

					$category = Input::get('category');
					foreach ($category as $key => $value) {
						$categoryData[] = array(
							'restaurant_id' => $result,
							 'category_id' => $value
							); 
					}

					$cuisine = Input::get('cuisine');
					foreach($cuisine as $key => $val){
						$cuisineData[] = array(
							'restaurant_id' => $result,
							'cuisineID' => $val
							);
					}

					$this->res->add_restaurant_category($categoryData);
					$this->res->add_restaurant_cuisine($cuisineData);

					Session::flash('restaurant_msg', 'Restaurant Successfully Added and contact admin for active your account');
					return Redirect::to('/addrestaurant');
				}else{
					Session::flash('restaurant_msg', 'Restaurant Not Add' );
					return Redirect::to('/addrestaurant');
				}

			}
		}
 		return View::make('admin/addrestaurant',$data);
	}


	public function deleterestaurant($id){
		$re = $this->res->delete_restaurant($id);
		$re_category = $this->res->delete_res_category($id);
		$re_cuisine = $this->res->delete_res_cuisine($id);
		if($re){
			Session::flash('restaurant_msg', 'Restaurant Successfully Delete');
		}else{
			Session::flash('restaurant_msg', 'Restaurant Not Delete');		
		}
		return Redirect::to('/restaurant');
	}



	public function editrestaurant($id)
	{
		$data['res_active'] = 'active';
		$loc = new Location();
		$data['location'] = $loc->get_location();
		$cat = new Category();
		$data['category'] = $cat->get_maincategory('');//get main category data from tbl_category
		$data['restaurant'] = $this->res->get_restaurant_by_id($id); //get edit restaurant data from tbl_restauratn
		$data['restaurant_category'] = $this->res->get_restaurant_category($id); //get edit restaurant category use joining 
		$data['cuisine'] = with(new Cuisine)->get_cuisine();
		$data['restaurant_cuisine'] = $this->res->get_restaurant_cuisine($id);

				//restaurant category for view inarray
				$reG = $this->res->get_restaurant_category_by_id($id); //get restaurant category only tbl_res_category

				$getData ='';
				foreach($reG as $value){
					$getData[]= $value->category_id;
				}
		    	$data['get_cat'] = $getData; // for in array of view page	

		    	//restaurant cuisine for view inarray
				$res_cuisine = $this->res->get_restaurant_cuisine_by_id($id); //get restaurant cuisine only tbl_res_category
				
				$get_cui='';
				foreach($res_cuisine as $val){
					$get_cui[] = $val->cuisineID;
				}
				$data['get_cui'] = $get_cui;

		if(Input::has('submit'))
		{
			$validation = Validator::make(Input::all(), array(
					'name' => 'required',
					'location' => 'required',
					'rating' => 'required',
					'address' => 'required'

				));

			if($validation->fails()){
				return Redirect::to('/editrestaurant/'.Input::get('id'))->withErrors($validation);
			}else{

				if(Input::hasfile('image'))
				{
					$image = Input::file('image');
					$imageName = time().'.'. $image->getClientOriginalExtension();
					$path = base_path('images/restaurant/'.$imageName);
					Image::make($image->getRealPath())->resize(400,300)->save($path);

					$path = base_path('images/restaurant/thumbs/'.$imageName);
					Image::make($image->getRealPath())->resize(210,150)->save($path);

				 
				    $editData = array(
						'restaurant_name' => Input::get('name'),
						'location_id' => Input::get('location'),
						'rating' => Input::get('rating'),
						'sponsor' => Input::get('sponsor'),
						'offer' => Input::get('offer'),																							
						'address' => Input::get('address'),
						'r_image' => $imageName
					); 
				}else{
					$editData = array(
						'restaurant_name' => Input::get('name'),
						'location_id' => Input::get('location'),
						'rating' => Input::get('rating'),
						'sponsor' => Input::get('sponsor'),
						'offer' => Input::get('offer'),																							
						'address' => Input::get('address')

					);
				}

				

				$reR = $this->res->update_restaurant(Input::get('id'),$editData);

				$reG = $this->res->get_restaurant_category_by_id(Input::get('id'));
				$getData ='';//get edit data from database 
				foreach($reG as $value){
					$getData[] = array(
							'restaurant_id' => $value->restaurant_id,
							 'category_id' => $value->category_id
						); 
				}
				
				if($category = Input::get('category')){
						foreach($category as $key=>$value)
						{
							$categoryData[] = array(
									'restaurant_id' => Input::get('id'),
									'category_id' => $value
								);													
						}
				}else{
					$categoryData='';
				}				
// print_r($getData);
// echo "<br>";
// echo "<br>";
// echo "<br>";
// print_r($categoryData);
// //exit();
// echo "<br>";
// echo "<br>";

				//cuisine from input
				$res_cuisine = $this->res->get_restaurant_cuisine_by_id(Input::get('id'));
				$get_cui = '';
				foreach($res_cuisine as $val){
					$get_cui[] = array(
							'restaurant_id' => $val->restaurant_id,
							'cuisineID' => $val->cuisineID
						);
				}	

				$inputCuisine = Input::get('cuisine');
				if($inputCuisine){
					foreach($inputCuisine as $key=>$val){
						$cuisineData[] = array(
								'restaurant_id' => Input::get('id'),
								'cuisineID' => $val
							);
					}
				}else{
					$cuisineData = '';
				}

// print_r($get_cui);
// echo "<br>";
// echo "<br>";
// echo "<br>";
// print_r($cuisineData);
// exit();

				if($get_cui == $cuisineData){
					$reC = '';
				}else{
					$reC = $this->res->delete_res_cuisine(Input::get('id'));
					if($cuisineData){
						$reC = $this->res->add_restaurant_cuisine($cuisineData);																	
					}
				}


				//for restaurant category
				if($getData == $categoryData){
					$reI='';
				}else{
					$reI = $this->res->delete_restaurant_category(Input::get('id'));
					if($categoryData){
						$reI = $this->res->add_restaurant_category($categoryData);		
					}
				}

					if($reR || $reI || $reC){
						Session::flash('restaurant_msg', 'Restaurant Successfully Update');
						return Redirect::to('/restaurant');
					}else{
						Session::flash('restaurant_msg', 'Restaurant Not Update');
						return Redirect::to('/editrestaurant/'.Input::get('id'));
					}
				
			}
		}

		return View::make('admin/editrestaurant',$data);
	}








}