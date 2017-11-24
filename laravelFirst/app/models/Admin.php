<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Admin extends Eloquent implements UserInterface, RemindableInterface{

	use UserTrait, RemindableTrait;
	public  $timestamps = false;
	protected $primaryKey = 'ID';
	protected $table = 'tbl_admin';
	protected $hidden = array('password','');
	

    public function saveData($data)
	{
	  $save=DB::table('tbl_admin')->insertGetId($data); 
          return  $save;
	}


	public function getAdmin_by_id($adminID){
		$adminData=DB::table('tbl_admin')->where('ID',$adminID)->get();
		return $adminData;
	}


	public function get_forget_data($email){
		$token=DB::table('tbl_admin')->where('email',$email)->pluck('remember_token');
		return $token;
	}


	public function reset_password($password,$token){
		$reset=DB::table('tbl_admin')->where('remember_token',$token)->update(array('password'=> $password));
		return $reset;
	}


	public function update_profile($id, $data){
		return Admin::where('ID',$id)->update($data);
	}


}