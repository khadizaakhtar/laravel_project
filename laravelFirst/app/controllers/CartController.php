<?php 
class CartController extends BaseController{
	public function __construct(CartModel $cart){
		$this->cart= $cart;
		$data = array();
		
	}


public function addCart($id,$qty,$topping){

	if(Request::ajax()){
		$product = $this->cart->get_single_product_add_to_cart($id);
		
		if($topping != ''){
			$tdata = explode(',', $topping); 
			
			$topingData = DB::table('tbl_toppings')->whereIn('topping_id',$tdata)->get();
			$price = 0;
			foreach($topingData as $info){
				$opdata[] = array(
						'topping_name' => $info->topping_name,
						'topping_price' => $info->topping_price
					);
				$price = $price + $info->topping_price;
			}
		}

		if($topping == "null"){
			$opdata = array(
					'topping_name' => '',
					'topping_price' => ''
				);
			$price = 0;
		}

		$Pprice = $product->price+$price;
		//Cart::destroy();
		$itemData= array(
				'id' => $product->product_id,
				'name' => $product->name,
				'qty' => $qty,
				'price' => $Pprice,
				'options' => array('topping' => $opdata, 'topping_id' => $topping, 'image'=> $product->p_image)
			); 

		  Cart::add($itemData);
		  $item = Cart::content();
		 
		  return $item;

	}else{
		return "Food Not add to cart";
	}

}




public function viewCart(){

	$item = Cart::content();
		  return $item;
}



public function deleteCart(){
	if(Request::ajax()){
		  $rowid = Input::get('rowid');
		  Cart::remove($rowid);
		 return $item = Cart::total();
		 //return "fsdf";
	}
}


public function checklogin(){

        $loginData=array(
            'email'=>Input::get('email'),
            'password'=>Input::get('password'),
            );

        $rules=array('email'=>'required','password'=>'required');

        $validation=Validator::make($loginData, $rules);

        if($validation->passes()){
	        if(Auth::userlogin()->attempt($loginData))
	        {
	            return Redirect::to('/delivery');
	        }else{
	            return Redirect::back()->with('loginerror','Sorry Username or password wrong');
	        }
        }else{
            return Redirect::back()->withErrors($validation);
        }
}




public function delivery(){

	if(Input::get('submit')){
		$rules = array(
				'name' => 'required',
				'mobile' => 'required|alpha_num',
				'city' => 'required',
				'area' => 'required',
				'address' => 'required',
				'email' => 'required|email'
			);

		$validation = Validator::make(Input::all(),$rules);

		if($validation->fails()){
			return View::make('delivery')->withErrors($validation);
		}else{
			$delivery = array(
					'userID' => Auth::userlogin()->user()->ID,
					'restaurant_id' => Session::pull('restaurant_id'),
					'name' => Input::get('name'),
					'mobile' => Input::get('mobile'),
					'email' => Input::get('email'),
					'city' => Input::get('city'),
					'area' => Input::get('area'),
					'address' => Input::get('address'),
					'total_price' => Cart::total(),
					'total_qty' => Cart::count(),
				);
			//print_r($delivery);

			$orderid = $this->cart->add_order($delivery);

			if($orderid){
				foreach(Cart::content() as $item){
					$orderProduct[] = array(
							'orderID' => $orderid,
							'product_id' => $item->id,
							'product_name' => $item->name,
							'product_price' => $item->price,	
							'qty' => $item->qty,
							'topping_id' => $item->options->topping_id,
							'p_image' => $item->options->image
						);
				}

				$re = $this->cart->add_order_product($orderProduct);

				if($re){
					Cart::destroy();
					$inv = new Invoice();
					$order['order'] = $inv->get_order_details($orderid);

					Mail::Send('emails.OrderMail',$order,function($mail){
						$mail->from(Input::get('email'), Input::get('name'));
						$mail->to('tarek@sahajjo.com','tarek')->subject('Food Order Message');
					});

					Session::flash('msg','Your Order Successfully Send');
				}else{
					Session::flash('msg', 'Order Successfully not send . please try agin!');	
				}
			}else{
				Session::flash('msg', 'Order Successfully not send . please try agin!');
			}

			return Redirect::to('/order');
		}

	}else{
		return View::make('delivery');			
	}
}









}