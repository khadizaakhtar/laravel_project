<?php 

Class Product extends Eloquent{
	
	protected $table= 'tbl_product';

	public function insert_product($insertData){
		$save=DB::table('tbl_product')->insert($insertData);
		return $save;
	}

	public function get_product($id){
		$tb=DB::table('tbl_product')->where('owner_id',Auth::ownerlogin()->user()->ID);

		if($id !=''){ $tb->where('product_id',$id); }
		if($id==''){ $tb->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id');}
		$result=$tb->get();
		return $result;
	}

	public function delete_product($id){
		$result=Product::where('product_id',$id)->delete();
		return $result;
	}

	public function update_product($id, $data){
		$result=DB::table('tbl_product')->where('product_id', $id)->update($data);
		return $result;
	}

	public function get_category(){
		return DB::table('tbl_category')->get();
	}

}