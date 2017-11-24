<?php 
/**
*  
*/
class ToppingController extends BaseController{
	
	function __construct(Topping $topping)
	{
		$this->top = $topping;
		$data = array();
	}


	public function topping(){
		$data['top_active']= "active";
    	$data['form'] = 1;

    	$data['topping'] = $this->top->get_topping();
      	return View::make('admin/topping',$data);
	}

	  public function addTopping()
    {
    	if(Input::has('submit')){
    		$validaion = Validator::make(Input::all(), array('topping_name' => 'required', 'topping_price' => 'required'));
    		if($validaion->fails()){
    			return Redirect::to('/topping')->withErrors($validaion);
    		}else{
    			$toppingData = array(
    					'topping_name' => Input::get('topping_name'),
    					'topping_price' => Input::get('topping_price')
    				);

    			$result = $this->top->add_topping($toppingData);

    			if($result){
    				Session::flash('msg','Topping Successfully added');
    				return Redirect::to('/topping');
    			}else{
    				Session::flash('msg','Topping Not added');
    				return Redirect::to('/topping');   				
    			}
    		}
    	}

    }


    public function deleteTopping($id){
    	$re = $this->top->delete_topping($id);
    	if($re){
    		Session::flash('msg','Topping Successfully Delete');
    	}else{
    		Session::flash('msg','Topping Not Delete');   		
    	}
    	return Redirect::to('/topping');

    }


    public function editTopping($id)
    {
    	$data['top_active']= "active";
    	$data['single_topping'] = $this->top->get_topping_by_id($id);
    	$data['topping'] = $this->top->get_topping();
    	$data['edit'] = 1;

    	if(Input::has('submit')){
    		$toppingData = array(
    					'topping_name' => Input::get('topping_name'),
    					'topping_price' => Input::get('topping_price')
    				);
    		$re = $this->top->update_topping(Input::get('id'),$toppingData);
    		if($re){
    			Session::flash('msg', 'Topping Successfully Update');
    		}else{
    			Session::flash('msg', 'Topping Successfully Update');   			
    		}
    		return Redirect::to('/topping');
    	}
    	return View::make('admin/topping',$data);
    }


}




?>