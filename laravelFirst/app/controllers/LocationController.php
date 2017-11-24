<?php 
class LocationController extends BaseController{
	public function __construct(Location $location){       
          $this->loc=$location;
          $data=array();
          $this->beforefilter('csrf',array('on'=> 'post'));
      }


    public function location(){
    	$data['loc_active']= "active";
    	$data['form'] = 1;

    	$data['location'] = $this->loc->get_location();
      	return View::make('admin/location',$data);
      }


    public function addlocation()
    {
    	if(Input::has('submit')){
    		$validaion = Validator::make(Input::all(), array('location_name' => 'required', 'postal_code' => 'required'));
    		if($validaion->fails()){
    			return Redirect::to('/location')->withErrors($validaion);
    		}else{
    			$locationData = array(
    					'location_name' => Input::get('location_name'),
    					'postal_code' => Input::get('postal_code'),
                        'location_details' => Input::get('location_details')
    				);

    			$result = $this->loc->add_location($locationData);

    			if($result){
    				Session::flash('location_msg','Location Successfully added');
    				return Redirect::to('/location');
    			}else{
    				Session::flash('location_msg','Location Not added');
    				return Redirect::to('/location');   				
    			}
    		}
    	}

    }


    public function deleteLocation($id){
    	$re = $this->loc->delete_location($id);
    	if($re){
    		Session::flash('location_msg','Location Successfully Delete');
    	}else{
    		Session::flash('location_msg','Location Not Delete');   		
    	}
    	return Redirect::to('/location');

    }


    public function editLocation($id)
    {
    	$data['loc_active']= "active";
    	$data['single_location'] = $this->loc->get_location_by_id($id);
    	$data['location'] = $this->loc->get_location();
    	$data['edit'] = 1;

    	if(Input::has('submit')){
    		$updateData = array(
    				'location_name' => Input::get('location_name'),
    				'postal_code' => Input::get('postal_code'),
                    'location_details' => Input::get('location_details')

    			);
    		$re = $this->loc->update_location(Input::get('id'),$updateData);
    		if($re){
    			Session::flash('location_msg', 'Location Successfully Update');
    		}else{
    			Session::flash('location_msg', 'Location Successfully Update');   			
    		}
    		return Redirect::to('/location');
    	}
    	return View::make('admin/location',$data);
    }




}