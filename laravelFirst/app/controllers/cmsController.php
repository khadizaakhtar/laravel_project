<?php 
/**
* 
*/
class cmsController extends BaseController
{
	
	function __construct(cms $cms)
	{
		$this->cms = $cms;
		$data = array();
	}


	public function cms(){
		$data['cms_active'] = "active";
		$data['cms'] = $this->cms->get_cms();
		return View::make('admin/cms',$data);
	}


	public function cmsDelete($id){
		$data['cms_active'] = "active";
		$re = $this->cms->delete_cms($id);
		if($re){
			Session::flash('msg', 'Successfully Deleted');
		}else{
			Session::flash('msg', 'CMS not Deleted');
		}
		return Redirect::to('/cms');

	}



	public function cmsEdit($id){
		$data['cms_active'] = "active";
		$data['single_cms'] = $this->cms->get_cms_by_id($id);

		if(Input::get('submit')){
			$updateData = array(
					'content_title' => Input::get('content_title'),
					'content_description' => Input::get('content_description')
				);

			$re = $this->cms->update_cms($updateData, Input::get('id'));

			if($re){
				Session::flash('msg', 'Successfully Update');
			}else{
				Session::flash('msg', 'Not Update');
			}
			return Redirect::to('/cms');

		}else{
			return View::make('admin/cmsEdit',$data);
		}

		
	}













}



?>