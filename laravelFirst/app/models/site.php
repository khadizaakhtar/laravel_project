<?php

class Site extends Eloquent{

	public function get_category($rid){
		return DB::table('tbl_restaurant')
					->where('tbl_restaurant.restaurant_id', $rid)
					->join('tbl_res_category', 'tbl_restaurant.restaurant_id', '=', 'tbl_res_category.restaurant_id')
					->join('tbl_category', function($join){
						$join->on('tbl_category.category_id', '=', 'tbl_res_category.category_id')
							 ->orOn('tbl_category.type', '=', 'tbl_res_category.category_id');	
					})
					->get();
	}


	public function get_product($cid,$oid){
	 	 $tb = DB::table('tbl_product')
	 	 		->join('tbl_category', function($join){
	 	 			$join->on('tbl_product.category_id', '=', 'tbl_category.category_id')
	 	 				 ->orOn('tbl_product.category_id', '=', 'tbl_category.type');	
	 	 		});

	 	 		

	 	 		if($cid !=''){	
	 	 			//$sql = '( where tbl_product.category_id = '.$cid.' or tbl_category.type = '.$cid.' )';
					// $tb->raw($sql);
		 	 		$tb->where(function($q) use ($cid){
						$q->where('tbl_product.category_id',$cid)
						->orWhere('type',$cid);
					});

				}

				
				$tb->where(function($q) use ($oid) {
					$q->where('tbl_product.owner_id',$oid);
				});
	 	 		
		 	 	$tb->groupBy('tbl_product.category_id');
				return $tb->get();

	}


	public function search_restaurant($cid, $lid){
		 $db = DB::table('tbl_restaurant')
					->where('tbl_restaurant.location_id',$lid)
					->where('tbl_restaurant.activation',1)
					->join('tbl_location','tbl_restaurant.location_id', '=', 'tbl_location.location_id')
					->join('tbl_res_cuisine', 'tbl_restaurant.restaurant_id', '=', 'tbl_res_cuisine.restaurant_id');
					if($cid != ''){
						$db->where('tbl_res_cuisine.cuisineID',$cid);						
					}
				return	$db->groupBy('tbl_res_cuisine.restaurant_id')
					->get();
	}


	public function get_responsor_restaurant(){
		return  $db = DB::table('tbl_restaurant')
					->where('tbl_restaurant.sponsor','yes')
					->where('tbl_restaurant.activation',1)
					->get();
	}



	public function get_restaruant_by_id($rid){
		return DB::table('tbl_restaurant')->where('restaurant_id',$rid)->first();


	}








}

?>