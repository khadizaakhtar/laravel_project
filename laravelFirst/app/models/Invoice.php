<?php 

Class Invoice extends Eloquent{
	
	protected $table= 'tbl_order';
	public $timestamps = false;
	


	public function get_order(){

		$q = Invoice::join('tbl_user','tbl_user.ID','=','tbl_order.userID')
					->join('tbl_restaurant', 'tbl_restaurant.restaurant_id','=','tbl_order.restaurant_id')
					//->select('tbl_order.orderID', 'tbl_order.name', 'tbl_order.mobile', 'tbl_order.email', 'tbl_order' 'tbl_user.firstname', 'tbl_user.lastname', '','tbl_restaurant.address as res_address')
					->select('orderID','name','mobile','firstname','lastname','tbl_order.email','city','area','tbl_order.address as address','total_qty','total_price','restaurant_name','tbl_restaurant.address as res_address');
					if(Auth::ownerlogin()->user()){
						$ownerid = Auth::ownerlogin()->user()->ID;
						$q->where('tbl_restaurant.owner_id',$ownerid); 
					}
			return $q->get();

	}

	public function delete_order($id){
		return Invoice::where('orderID', $id)->delete();

	}


	public function get_user_order(){
		$userid = Auth::userlogin()->user()->ID;
		return Invoice::where('tbl_user.ID', $userid)
					->join('tbl_user','tbl_user.ID','=','tbl_order.userID')
					->join('tbl_restaurant', 'tbl_restaurant.restaurant_id','=','tbl_order.restaurant_id')
					//->select('tbl_order.orderID', 'tbl_order.name', 'tbl_order.mobile', 'tbl_order.email', 'tbl_order' 'tbl_user.firstname', 'tbl_user.lastname', '','tbl_restaurant.address as res_address')
					->select('orderID','name','mobile','firstname','lastname','tbl_order.email','city','area','tbl_order.address as address','total_qty','total_price','restaurant_name','tbl_restaurant.address as res_address')
					->get();
	}


	public function get_order_details($id){
		return DB::table('tbl_order_product')
				// ->join('tbl_order', 'tbl_order_product.orderID', '=', 'tbl_order.orderID')
				// ->join('tbl_product', 'tbl_order_product.product_id', '=', 'tbl_product.product_id')
				->where('orderID',$id)
				->get();
	}


	public function order_complete($id){
		return Invoice::where('orderID', $id)->update(array('active' => 1));
	}




}