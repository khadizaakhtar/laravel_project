<?php 
class Location extends Eloquent{
	protected $table = "tbl_location";
	public $timestamps = false;

	public function get_location(){
		return Location::get();
	}

	public function add_location($data){
		return Location::insert($data);
	}

	public function delete_location($id){
		return Location::where('location_id',$id)->delete();
	}

	public function get_location_by_id($id){
		return Location::where('location_id',$id)->get();
	}


	public function update_location($id, $data){
		return Location::where('location_id',$id)->update($data);
	}

}