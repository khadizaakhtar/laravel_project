<?php 

class InvoiceController extends BaseController{
	public function __construct(Invoice $invoice){       
          $this->inv=$invoice;
          $data=array();

      }


public function invoice(){
	$data['inv_active'] = "active";
	$data['order'] = $this->inv->get_order();
	return View::make('admin/invoice',$data);
}


public function detailsInvoice($id){
	$data['inv_active'] = "active";
	$data['order'] = $this->inv->get_order_details($id);
	$data['active'] = DB::table('tbl_order')->where('orderID',$id)->pluck('active');
	$data['id'] = $id;
	return View::make('admin/detailsInvoice',$data);
}


public function deleteInvoice($id){
	$data['inv_active'] = "active";
	$re = $this->inv->delete_order($id);

	if($re){
		DB::table('tbl_order_product')->where('orderID',$id)->delete();
		Session::flash('msg', 'Successfully Delete');
	}else{
		Session::flash('msg', 'Not Delete');
	}
	return Redirect::to('/invoice');
}


public function downloadPDF($id){

	$data['order'] = $this->inv->get_order_details($id);
	$data['name'] = "tarek";
	$pdf = App::make('dompdf');
	$pdf->setPaper('a4')->setOrientation('landscape');
	$pdf->loadView('admin/pdf',$data);
	return $pdf->download('invoice.pdf');
}


//fontend view
public function Order(){
	$data['active6'] = 'active';
	$data['order'] = $this->inv->get_user_order();
	//var_dump($data['order']);
	return View::make('order',$data);
}


public function viewOrder($id){
	$data['active6'] = 'active';
	$data['order'] = $this->inv->get_order_details($id);
	//var_dump($data['order']);
	return View::make('viewOrder',$data);
}


public function completeOrder($id){
	$re = $this->inv->order_complete($id);
	if($re){
		Session::flash('msg', 'Order Successfully Completed');
		return Redirect::to('/invoice');
	}else{
		Session::flash('msg', 'Order not complete');
		return Redirect::to('/detailsInvoice/'.$id);
	}

}










}

