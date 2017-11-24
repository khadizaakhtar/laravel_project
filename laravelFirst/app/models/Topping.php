<?php 
/**
* 
*/
class Topping extends Eloquent{
	protected $table = "tbl_toppings";
	public $timestamps = false;

	public function get_topping(){
		return Topping::get();
	}

	public function add_topping($data){
		return Topping::insert($data);
	}

	public function delete_topping($id){
		return Topping::where('topping_id',$id)->delete();
	}

	public function get_topping_by_id($id){
		return Topping::where('topping_id',$id)->get();
	}


	public function update_topping($id, $data){
		return Topping::where('topping_id',$id)->update($data);
	}


}

?>