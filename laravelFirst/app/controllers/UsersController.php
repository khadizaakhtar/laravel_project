<?php 
/**
* 
*/
class UsersController extends BaseController{
	public function __construct(){
		$data = array();
	}
	

	public function users(){
		$data['use_active'] = "active";
		$data['users'] = DB::table('tbl_user')->select('ID','firstname','lastname','email','user_mobile','user_address','image')->get();
		return View::make('admin/viewUsers',$data);
	}


	public function usersDelete($id){
		$re = DB::table('tbl_users')->where('ID',$id)->delete();
		if($re){
			Session::flash('msg', 'Users Successfully Delete');
		}else{
			Session::flash('msg', 'Users Not Delete');
		}
		return Redirect::to('/users');
	}




}



?>