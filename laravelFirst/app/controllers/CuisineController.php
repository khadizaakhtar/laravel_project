<?php 
/**
* Author : TAREK MONJUR
* Conmany : THE RSSOFTWARE
*/
class CuisineController extends BaseController
{
	
	function __construct(Cuisine $cuisine)
	{
		$this->cui = $cuisine;
		$data = array();
	}

	public function cuisine(){
    	$data['cui_active']= "active";
    	$data['form'] = 1;

    	$data['cuisine'] = $this->cui->get_cuisine();
      	return View::make('admin/cuisine',$data);
      }


    public function addcuisine()
    {
    	if(Input::has('submit')){
    		$validaion = Validator::make(Input::all(), array('cuisine_name' => 'required'));
    		if($validaion->fails()){
    			return Redirect::to('/cuisine')->withErrors($validaion);
    		}else{
    			$cuisineData = array(
    					'cuisine_name' => Input::get('cuisine_name'),
    				);

    			$result = $this->cui->add_cuisine($cuisineData);

    			if($result){
    				Session::flash('msg','Cuisine Successfully added');
    				return Redirect::to('/cuisine');
    			}else{
    				Session::flash('msg','Cuisine Not added');
    				return Redirect::to('/cuisine');   				
    			}
    		}
    	}

    }


    public function deletecuisine($id){
    	$re = $this->cui->delete_cuisine($id);
    	if($re){
    		Session::flash('msg','Cuisine Successfully Delete');
    	}else{
    		Session::flash('msg','Cuisine Not Delete');   		
    	}
    	return Redirect::to('/cuisine');

    }


    public function editcuisine($id)
    {
    	$data['cui_active']= "active";
    	$data['single_cuisine'] = $this->cui->get_cuisine_by_id($id);
    	$data['cuisine'] = $this->cui->get_cuisine();
    	$data['edit'] = 1;

    	if(Input::has('submit')){
    		$updateData = array(
    				'cuisine_name' => Input::get('cuisine_name')
    			);
    		$re = $this->cui->update_cuisine(Input::get('id'),$updateData);
    		if($re){
    			Session::flash('msg', 'Cuisine Successfully Update');
    		}else{
    			Session::flash('msg', 'Cuisine Successfully Update');   			
    		}
    		return Redirect::to('/cuisine');
    	}
    	return View::make('admin/cuisine',$data);
    }




}


?>