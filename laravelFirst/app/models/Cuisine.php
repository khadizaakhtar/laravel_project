<?php 
/**
* Author : TAREK MONJUR
* Conmany : THE RSSOFTWARE
*/
class Cuisine extends Eloquent
{
	
	protected $table = "tbl_cuisine";
	public $timestamps = false;

	public function get_cuisine(){
		return Cuisine::get();
	}

	public function add_cuisine($data){
		return Cuisine::insert($data);
	}

	public function delete_cuisine($id){
		return Cuisine::where('cuisineID',$id)->delete();
	}

	public function get_cuisine_by_id($id){
		return Cuisine::where('cuisineID',$id)->get();
	}


	public function update_cuisine($id, $data){
		return Cuisine::where('cuisineID',$id)->update($data);
	}




}


?>