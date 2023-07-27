<?php

/**
 * Description of Users Controller
 *
 * @author 
 *
 * @email 
 */

namespace App\Controllers;



class Prepaidcard extends BaseController
{
	protected $helpers = ['form','url','api'];
	public function __construct()
	{
		$this->session = session();
        $this->db = db_connect();
	

	}
	public function index()
    {	
	
		 $user_id=$this->session->get('user_id');
		 
		 $card_detail = array();
		 $transaction_history = array();
		 $shipping_cost=0;
		  
		  //calculate shipping_cost
	     $params = array();
		 $params['type'] = 'prepaid';
		 $response = requestdata('get_shipping_cost',$params);		 
		 $shipping_cost = '0.00';
		 $card_order_fee = '0.00';
		 $card_activate_fee = '0.00';
		 if($response['status']==1)
		 {
			 $shipping_cost = $response['shipping_cost'];
			 $card_order_fee = $response['card_order_fee'];
			 $card_activate_fee = $response['card_activate_fee'];
		 }
		
		 //fetch user prepaid card current status
		 $param_detail = array();
		 $response_detail=requestdata('prepaid_card_list',$param_detail);		
		 if($response_detail['status']==1)
		 {
			 $card_detail=$response_detail['card_details'];
			
		 }
		 $data=array();
		 $data['card_order_fee']=$card_order_fee;
		 $data['card_activate_fee']=$card_activate_fee;
		 $data['shipping_cost']=$shipping_cost;
		 $data['card_details']=$card_detail;
		 $data['title']='Prepaid List';
		 $data['meta_keywords'] = 'Prepaid List';
		 $data['meta_description'] = 'Prepaid List';
		 return view('prepaid/index', $data);
	}	
	
	public function ordercard()
    {	
		 $user_id=$this->session->get('user_id');
		 if(!empty($user_id))
		 {
			  
			  $params = array();
			  $params['type'] = 'order';
			  $response=requestdata('prepaid_card_order',$params);
			  if($response['status']==1)
			  {
					$data['status']=1;
					$data['message']=$response['message'];
			  }else{
					$data['status']=0;
					$data['message']=$response['message'];
			  }
		 }else{
			 $data['status']=0;
			$data['message']='Unauthorise access to order card'; 
		 }
		 
		 echo json_encode($data);
	}
	
	public function activatecard()
    {	
		 $user_id=$this->session->get('user_id');
		if($this->request->getMethod() == 'post'){
			 $rules = [
					'card_number'=> 'required|min_length[10]|max_length[16]',
					'cvv'=> 'required|min_length[3]|max_length[4]',
					'expiry_date'=> 'required'
				];
			if ($this->validate($rules)) {

						$card_number=$this->request->getVar('card_number');
						$cvv=$this->request->getVar('cvv');
						$expiry_date=$this->request->getVar('expiry_date');
						$expiry=explode("/",$expiry_date);
						$params['card_number']=$this->request->getVar('card_number');
						$params['cvv']=$this->request->getVar('cvv');
						$params['mm']=$expiry[0];
						$params['yy']=$expiry[1];
						$response=array();
						$response=requestdata('prepaid_card_activate',$params);
						/* $response['status']=1;
						$response['card_pin']=123;
						$response['message']='Your prepaid card has been successfully activated. Pin sent to your registered email.'; */
						//echo '<pre>';print_r($response);die;
						if($response['status']==1)
						{
								$data['status']=1;
								$data['message']=$response['message'];
						}else{
							$data['status']=0;
							$data['message']=$response['message'];
						}
					 
			}else{
					$data['status']=0;
					$data['message']='Please fill all details';
			}
			
		 }else{
			 $data['status']=0;
			$data['message']='Unauthorise access to activate card'; 
		 }
		 
		 echo json_encode($data);
	}
	
	public function lock_card($card_id)
	{
		 $user_id=$this->session->get('user_id');
		if(empty($card_id))
		 {
			 return redirect()->to('/prepaidcard');
		 }
		// echo '<pre>';print_r($prepaid);die;
		 $params=array();
		 $params['card_id']=$card_id;
		 $params['setting_name']='card_lock';
		 $params['setting_value']=0;
		 
		 $response=requestdata('prepaid_card_settings',$params);
		 if($response['status']==1)
		 {
			$this->session->setFlashdata('msg', 'Your card has been locked successfully');
			return redirect()->to('/prepaidcard');
			
		 }else{
			
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/prepaidcard');
		 }
		
	}
	
	public function unlock_card($card_id)
	{
		 $user_id=$this->session->get('user_id');
		 if(empty($card_id))
		 {
			 return redirect()->to('/prepaidcard');
		 }
		 $params=array();
		 $params['card_id']=$card_id;
		 $params['setting_name']='card_lock';
		 $params['setting_value']=1;
		 $response=requestdata('prepaid_card_settings',$params);
		 if($response['status']==1)
		 {
			$this->session->setFlashdata('msg', 'Your card has been unlocked successfully');
			return redirect()->to('/prepaidcard');		
		 }else{
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/prepaidcard');
		 }
		
	}
	
	public function reset_pin($card_id)
	{
		 $user_id=$this->session->get('user_id');
		 if(empty($card_id))
		 {
			 return redirect()->to('/prepaidcard');
		 }
		
		 $params=array();
		 $params['card_id']=$card_id;
		 $response=requestdata('reset_card_pin',$params);
		 if($response['status']==1)
		 {
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/prepaidcard');
		 }else{
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/prepaidcard');
		 }
		
	}
	
		public function block_card($card_id)
	{
		 $user_id=$this->session->get('user_id');
		 if(empty($card_id))
		 {
			 return redirect()->to('/prepaidcard');
		 }
		 
		 $params=array();
		 $params['card_id']=$card_id;
		 $response=requestdata('replace_stolen_card',$params);

		 if($response['status']==1)
		 {
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/prepaidcard');
		 }else{
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/prepaidcard');
		 }
		
	}
	
	public function loadcard()
    {	
		 $user_id=$this->session->get('user_id');
		  $data = array();
		
		 if(!empty($user_id))
		 {
			  $amount=$this->request->getVar('amount');
			  $card_id=$this->request->getVar('card_id');
			 
			  if($amount>0)
			  {
				 
				  if(isset($_POST['submit']) && $_POST['submit']=='submit')
				  {
					    $params = array();
						$params['amount'] = $amount;
						$params['card_id'] = $card_id;
						
						$response=requestdata('prepaid_load_balance_card',$params);
						
						/* $response = array();
						$response['status']=1;
						$response['message']='Your request has been successfully sent. Please check your emai and confirmed the load card request'; */
						
						if($response['status']==1)
						{

							$data['status']=2;
							$data['message']=$response['message'];
						}else{
							$data['status']=0;
							$data['message']=$response['message'];
						} 
				  } else if(isset($_POST['confirm']) && $_POST['confirm']=='confirm')
				  {

						$params = array();
						$amount=$this->request->getVar('amount');
						$confirm_code=$this->request->getVar('confirm_code');
						$params['confirm_code'] = $confirm_code;
						$params['status'] = $this->request->getVar('status');
						$params['card_id'] = $card_id;
						
						$response=requestdata('confirm_prepaid_load_card',$params);
						
						if($response['status']==1)
						{

							$data['status']=1;
							$data['message']=$response['message'];
						}else{
							$data['status']=0;
							$data['message']=$response['message'];
						} 
				  }
				
			  }else{
						$data['status']=0;
						$data['message']='please enter amount'; 
				  }
			
		 }else{
			 $data['status']=0;
			$data['message']='Unauthorise access to load card'; 
		 }
		 
		 echo json_encode($data);
	}
	
	public function transactions($card_id)
    {	
		 $user_id=$this->session->get('user_id');
		 $data=array();
		 
		 if(empty($card_id))
		 {
			 return redirect()->to('/prepaidcard');
		 }
		 
		
		 //fetch user prepaidcard transactions
		 $transactions = array();
		 $param_detail = array();
		 $param_detail['card_id'] = $card_id;
		 $response=requestdata('prepaid_card_transaction',$param_detail);
		// pr($response);
		 if($response['status']==1)
		 {
			 $transactions=$response;
			
		 }else{
			 return redirect()->to('/prepaidcard');
		 }
		 $data['transaction']=$transactions;
		 $data['title']='Prepaid Transactions';
		 $data['meta_keywords'] = 'Prepaid Transactions';
		 $data['meta_description'] = 'Prepaid Transactions';
		 return view('prepaid/transactions', $data);
	}
}
?>