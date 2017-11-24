<?php 

class ProductController extends BaseController{
	public function __construct(Product $product){       
          $this->product=$product;
          $data=array();
          $this->beforefilter('csrf',array('on'=> 'post'));
      }



    public function product(){
    	$data['pro_active'] = 'active';
		$data['product'] = $this->product->get_product('');
		$data['category'] = $this->product->get_category();
		return View::make('admin/product',$data);
	}



	public function addproduct(){
    	$data['pro_active']='active';
    	$data['category']=$this->product->get_category();
		if(Input::get('submit')){

			$rules=array(
					'name'=>'required',
					'category' => 'required',
					'price' => 'required|numeric',
					'image' => 'required'
				);

			$validation=Validator::make(Input::all(),$rules);

			if($validation->fails()){
				return View::make('admin/addproduct',$data)->withErrors($validation);
			}else{
				$image = Input::file('image');
	            $filename  = time() . '.' . $image->getClientOriginalExtension();
	            $path = 'images/product/' . $filename;
	            Image::make($image->getRealPath())->resize(600, 400)->save($path);

	            $path = 'images/product/thumbs/' . $filename;
	            Image::make($image->getRealPath())->resize(210, 150)->save($path);
				
				$insertData=array(
					'category_id' => Input::get('category'),
					'owner_id' => Auth::ownerlogin()->user()->ID,
					'name' => Input::get('name'),
					'price' => Input::get('price'),
					'p_image' => $filename
					);
				$result=$this->product->insert_product($insertData);
				if($result){
					Session::flash('product_msg','Product Successfully Added');
					return Redirect::to('/product');
				}
			}
		}
		return View::make('admin/addProduct',$data);
	}


	public function deleteProduct($id){
		$result=$this->product->delete_product($id);
		if($result){
			Session::flash('product_msg','Product Successfully Deleted');
			return Redirect::back();
		}
	}


	public function editProduct($id){
    	$data['pro_active']='active';
		$data['product']=$this->product->get_product($id);
    	$data['category']=$this->product->get_category('');
		
		if(Input::get('submit'))
		{
			$productData=array(
					'category_id' => Input::get('category_id'),
					'name' => Input::get('name'),
					'price' => Input::get('price')					
				);

			if(Input::file('image') != '' && Input::file('image')){
				$image = Input::file('image');
				$imageName = time().'.'.$image->getClientOriginalExtension();

				$Uploadpath = 'images/product/'.$imageName;
				Image::make($image->getRealPath())->resize(600,400)->save($Uploadpath);

				$Uploadpath = 'images/product/thumbs/'.$imageName;
				Image::make($image->getRealPath())->resize(210,150)->save($Uploadpath);
				
				$productData['p_image']=$imageName;
			}
					
			$result = $this->product->update_product(Input::get('id'), $productData);

			if($result){
				Session::flash('product_msg','Product Successfully Update');
				return Redirect::to('/product');
			}else{
				Session::flash('product_msg','Product Not Update');
				return Redirect::to('/editProduct/'.Input::get('id'));
			}
		}
		return View::make('admin/editProduct',$data);
	}



}      