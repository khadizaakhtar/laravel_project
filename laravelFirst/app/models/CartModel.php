<?php 
class CartModel extends Eloquent{

protected $table = 'tbl_product';
public $timestamps = false;


public function get_single_product_add_to_cart($id){
  return CartModel::where('product_id',$id)->first();
}


public function add_order($data){
	return DB::table('tbl_order')->insertGetId($data);
}


public function add_order_product($data){
	return DB::table('tbl_order_product')->insert($data);
}



}