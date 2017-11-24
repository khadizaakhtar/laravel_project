<?php 
class Category extends Eloquent{
	protected $table= "tbl_category";
	public  $timestamps = false;
	

	public function add_category($data){
		return $result = Category::insert($data);
	}

	public function delete_category($id){
		return Category::where('category_id',$id)->delete();
	}

	public function get_category($id){
		if($id !=''){
			return	Category::where('category_id',$id)->get();
		}else{
			return Category::get();
		}
	}

	public function update_category($data, $id){
		return Category::where('category_id',$id)->update($data);
	}

	public function get_maincategory(){
		return Category::where('type',0)->get();
	}


}