<?php 
/**
* 
*/
class cms extends Eloquent{

 protected $table = "tbl_cms";
 public $timestamps = false;



 public function get_cms(){
 	return cms::get();
 }


 public function get_cms_by_id($id){
 	return cms::where('content_id',$id)->get();
 }


 public function delete_cms($id){
 	return cms::where('content_id',$id)->delete();
 }


 public function update_cms($data, $id){
 	return cms::where('content_id', $id)->update($data);
 }







}


?>