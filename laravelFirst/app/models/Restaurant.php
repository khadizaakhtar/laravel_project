<?php 
class Restaurant extends Eloquent{
    protected $table = 'tbl_restaurant';
    public $timestamps = false;


	public function get_restaurant(){		

		$q = Restaurant::join('tbl_location','tbl_restaurant.location_id', '=', 'tbl_location.location_id');
			if(Auth::ownerlogin()->user()){
				$id = Auth::ownerlogin()->user()->ID;
				$q->where('tbl_restaurant.owner_id',$id);
			}
						
					//->join('tbl_res_category','tbl_restaurant.restaurant_id', '=', 'tbl_res_category.restaurant_id')
					//->join('tbl_category', 'tbl_res_category.category_id', '=', 'tbl_category.category_id')
				return 	$q->get();
	}


	public function get_restaurant_category($id){
		return Restaurant::where('tbl_restaurant.restaurant_id',$id)
							->join('tbl_res_category', 'tbl_restaurant.restaurant_id', '=', 'tbl_res_category.restaurant_id')
							->join('tbl_category', 'tbl_res_category.category_id', '=', 'tbl_category.category_id')
					
							->get();
	}


	public function get_restaurant_cuisine($id){
		return Restaurant::where('tbl_restaurant.restaurant_id',$id)
		   					->join('tbl_res_cuisine', 'tbl_restaurant.restaurant_id', '=', 'tbl_res_cuisine.restaurant_id')
		   					->join('tbl_cuisine','tbl_res_cuisine.cuisineID', '=', 'tbl_cuisine.cuisineID')
		   					->get();
	}


	public function get_restaurant_category_by_id($id){
		return DB::table('tbl_res_category')->where('restaurant_id',$id)->get();
	}


	public function get_restaurant_cuisine_by_id($id){
		return DB::table('tbl_res_cuisine')->where('restaurant_id', $id)->get();
	}


	public function get_restaurant_by_id($id){
		
		$q = Restaurant::where('restaurant_id',$id)
							->join('tbl_location','tbl_restaurant.location_id', '=', 'tbl_location.location_id');
			if(Auth::ownerlogin()->user()){
				$oid = Auth::ownerlogin()->user()->ID;
				$q->where('tbl_restaurant.owner_id',$oid);
			}
					return 	$q->get();
	}


	public function add_restaurant($data){
		return Restaurant::insertGetId($data);
	}


	public function delete_restaurant($id){
		return Restaurant::where('restaurant_id' , $id)->delete();
	}


	public function delete_res_category($id){
		return DB::table('tbl_res_category')->where('restaurant_id',$id)->delete();
	}


	public function delete_res_cuisine($id){
		return DB::table('tbl_res_cuisine')->where('restaurant_id',$id)->delete();
	}


	public function update_restaurant($id,$data){
		return Restaurant::where('restaurant_id',$id)->update($data);
	}


	public function add_restaurant_category($data){
		return DB::table('tbl_res_category')->insert($data);
	}


	public function add_restaurant_cuisine($data){
		return DB::table('tbl_res_cuisine')->insert($data);
	}


	public function delete_restaurant_category($id){
		 return  DB::table('tbl_res_category')->where('restaurant_id',$id)->delete();		
	}


	








}