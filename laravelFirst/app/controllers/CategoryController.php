<?php
class CategoryController extends BaseController{
    public function __construct(Category $category){       
          $this->cat=$category;
          $data=array();
          $this->beforefilter('csrf',array('on'=> 'post'));
          
      }


   public function category(){
   		$data['cat_active']= "active";
	   	$data['category']=$this->cat->get_category('');
	   	return View::make('admin/category',$data);
   } 


    public function addcategory(){
   		$data['cat_active']= "active";
    	$data['allcategory'] = $this->cat->get_maincategory();
   		
   		if(Input::get('submit'))
   		{
   			$validation=Validator::make(Input::all(),array('category_name' => 'required', 'image' => 'required'));

   			if($validation->fails())
   			{
   				return View::make('admin/addcategory',$data)->withErrors($validation);
   			}else{

   				$image = Input::file('image');
   				$imageName = time().'.'.$image->getClientOriginalExtension();
   				$path = 'images/category/'.$imageName;
   				Image::make($image->getRealPath())->resize(600,400)->save($path);

   				$path = 'images/category/thumbs/'. $imageName;
   				Image::make($image->getRealPath())->resize(210,150)->save($path);

   				$catData=array(
   						'category_name' => Input::get('category_name'),
   						'type' => Input::get('type'),
   						'c_image' => $imageName
   					);
   				$result=$this->cat->add_category($catData);

   				if($result){
   					Session::flash('cat_msg', 'Category Successfully Added');
   					return Redirect::to('/category');
   				}
   			}
   		}
   		return View::make('admin/addcategory',$data);
    }


    public function deleteCategory($id){
    	$result=$this->cat->delete_category($id);
    	if($result){
    		Session::flash('cat_msg','Category Successfully Delete');
    		return Redirect::to('/category');
    	}
    }


    public function editCategory($id)
    {
        $data['cat_active']= "active";
      	$data['category'] = $this->cat->get_category($id);
      	$data['allcategory'] = $this->cat->get_category('');

        if(Input::get('submit'))
        {
          $validation = Validator::make(Input::all(),array('category_name' => 'required'));

            if($validation->fails()){
              return Redirect::to('/editCategory/'.Input::get('id'))->withErrors($validation);;
            }
            else
            {
                 $editData['category_name'] = Input::get('category_name');
                 $editData['type'] = Input::get('type');

                  if(Input::file('image') !='')
                  {
                  $image = Input::file('image');
                  $imageName = time().'.'.$image->getClientOriginalExtension();
                  $path = 'images/category/'.$imageName;
                  Image::make($image->getRealPath())->resize(600,400)->save($path);

                  $path = 'images/category/thumbs/'.$imageName;
                  Image::make($image->getRealPath())->resize(210,150)->save($path);

                  $editData['c_image'] = $imageName;
                 }

                  $result = $this->cat->update_category($editData,Input::get('id'));
                  
                  if($result){
                    Session::flash('cat_msg','Category Successfully Update');
                    return Redirect::to('/category');
                  }else{
                    Session::flash('cat_msg','Category Not Update');
                    return Redirect::to('/editCategory/'.Input::get('id'));
                  }
            }
        }

    	 return View::make('admin/editcategory',$data);
    }





}  