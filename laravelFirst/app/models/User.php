<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface{

use UserTrait, RemindableTrait;
public  $timestamps = false;
protected $primaryKey = 'ID';
protected $table = 'tbl_user';
protected $hidden = array('password','');



	public function saveData($data)
	{
	  $save=DB::table('tbl_contact')->insert($data); 
          return  $save;
	}	


   // public function selectContact()
   //  {
   //  	$select=DB::table('tbl_contact')->where('user_id', Auth::userlogin()->id())->get();
   //  	return $select;
   //  }


   //  public function deleteContactById($id){
   //       $delete=DB::table('tbl_contact')->where('id',$id)->delete();
   //       return $delete;
   //  }


   //  public function selectContactById($id){
   //      $select=DB::table('tbl_contact')->where('id',$id)->get();
   //      return $select;
   //  }


   //  public function updateContact($data){
   //      $update=DB::table('tbl_contact')->where('id', $data['id'])->update($data);
   //      return $update;
   //  }


    public function signupUser($data){
      $insert=DB::table('tbl_user')->insert($data);
      return $insert;
    }


    public function get_user_by_id(){
      $id = Auth::userlogin()->user()->ID;
      return User::where('ID',$id)->get();
    }


    public function update_user($data){
      $id = Auth::userlogin()->user()->ID;
      return User::where('ID', $id)->update($data);
    }


    public function loginuser($loginData){
       $pickpassword=DB::table('tbl_user')->where('username' , $loginData['username'])->pluck('password');
       $password=$loginData['password'];

      if(!$pickpassword){
         Session::flash('loginerror','User Name not found');
      }else{
         $checkpassword=Hash::check($password, $pickpassword);
        if($checkpassword){
           Session::flash('loginerror','you are success');
            $userData=DB::table('tbl_user')->where('username', $loginData['username'])->get();
            return $userData;
        }else{
           Session::flash('loginerror','password not match');
        }
      }
    }
    

    public function get_forget_data($email){     
      $token=User::where('email',$email)->pluck('remember_token');
      return $token;
    }

    public function reset_password($password,$token){
    $reset=User::where('remember_token',$token)->update(array('password'=> $password));
    return $reset;
  }














}
