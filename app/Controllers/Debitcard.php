<?php

/**
 * Description of Users Controller
 *
 * @author 
 *
 * @email 
 */

namespace App\Controllers;



class Debitcard extends BaseController
{
	protected $helpers = ['form','url','api'];
	
	public function __construct()
	{
		$this->session = session();
		
	}
	public function index()
    {	
		 
		 $card_detail = array();
		 $transaction_history = array();		
		 $total_balance = 0;		  
		 $shipping_cost = '0.00';
		 $card_order_fee = '0.00';
		 $card_activate_fee = '0.00';
		 //calculate shipping_cost
	     $params = array();
		 $params['type'] = 'debitcard';
		 $response  =requestdata('get_shipping_cost',$params);
		 if($response['status']==1)
		 {
			 $shipping_cost = $response['shipping_cost'];
			 $card_order_fee = $response['card_order_fee'];
			 $card_activate_fee = $response['card_activate_fee'];
		 }
		
		 //fetch user debitcard current status
		 $param_detail = array();
		 $response_detail=requestdata('debitcard_list',$param_detail);
		 //echo '<pre>';print_r($response_detail);die;
		 if($response_detail['status']==1)
		 {
			 $card_detail=$response_detail['card_details'];
			 $total_balance=$response_detail['total_balance'];
			
		 }
		 $data=array();
		 $data['card_order_fee']=$card_order_fee;
		 $data['card_activate_fee']=$card_activate_fee;
		 $data['shipping_cost']=$shipping_cost;
		 $data['total_balance']=$total_balance;
		 $data['card_details']=$card_detail;
		 $data['title']='Debitcards List';
		 $data['meta_keywords'] = 'Debitcards';
		 $data['meta_description'] = 'Debitcards';
		 return view('debitcard/index', $data);
	}	
	
	public function ordercard()
    {	
		 $user_id=$this->session->get('user_id');
		 if(!empty($user_id))
		 {
			  
			  $params = array();
			  $params['type'] = 'order';			 
			  $response = requestdata('debitcard_card_order',$params);
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
		$user_id=$this->session->get('id');
		if($this->request->getMethod() == 'post'){
			 $rules = [
				'card_number'=> 'required|min_length[10]|max_length[16]',
				'cvv'=> 'required|min_length[3]|max_length[4]',
				'expiry_date'=> 'required'
			];
			if($this->validate($rules)) 
			{
				$card_number=$this->request->getVar('card_number');
				$cvv=$this->request->getVar('cvv');
				$expiry_date=$this->request->getVar('expiry_date');
				$expiry=explode("/",$expiry_date);
				$params['card_number']=$this->request->getVar('card_number');
				$params['cvv']=$this->request->getVar('cvv');
				$params['mm']=$expiry[0];
				$params['yy']=$expiry[1];
				//pr($params);
				$response  =array();
				$response = requestdata('debitcard_activate',$params);				
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
		 $user_id=$this->session->get('id');
		if(empty($card_id))
		 {
			 return redirect()->to('/debitcard');
		 }
		
		 $params=array();
		 $params['card_id']=$card_id;
		 $params['setting_name']='card_lock';
		 $params['setting_value']=0;
		 $response=requestdata('debitcard_settings',$params);
		 if($response['status']==1)
		 {
			$this->session->setFlashdata('msg', 'Your debitcard has been locked successfully');
			return redirect()->to('/debitcard');
			
		 }else{
			
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/debitcard');
		 }
		
	}
	
	public function unlock_card($card_id)
	{
		 $user_id=$this->session->get('id');
		if(empty($card_id))
		 {
			 return redirect()->to('/debitcard');
		 }
		 $params=array();
		 $params['card_id']=$card_id;
		 $params['setting_name']='card_lock';
		 $params['setting_value']=1;
		 $response=requestdata('debitcard_settings',$params);
		 if($response['status']==1)
		 {
			$this->session->setFlashdata('msg', 'Your card has been unlocked successfully');
			return redirect()->to('/debitcard');
		 }else{
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/debitcard');
		 }
		
	}
	
	public function reset_pin($card_id)
	{
		$user_id=$this->session->get('id');
		if(empty($card_id))
		 {
			 return redirect()->to('/debitcard');
		 }
		 $params=array();
		 $params['card_id']=$card_id;
		 $response=requestdata('reset_card_pin',$params);
		 if($response['status']==1)
		 {
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/debitcard');
		 }else{
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/debitcard');
		 }
		
	}
	
	public function block_card($card_id)
	{
		 $user_id=$this->session->get('id');
		if(empty($card_id))
		 {
			 return redirect()->to('/debitcard');
		 }
		 $params=array();
		 $params['card_id']=$card_id;
		 $response=requestdata('replace_stolen_card',$params);

		 if($response['status']==1)
		 {
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/debitcard');
		 }else{
			$this->session->setFlashdata('msg', $response['message']);
			return redirect()->to('/debitcard');
		 }
		
	}
	
	public function loadcard()
    {	
		 $user_id=$this->session->get('id');
		
		 if(!empty($user_id))
		 {
			$amount=$this->request->getVar('amount');
			$card_id=$this->request->getVar('card_id');
			if($amount>0)
			{
				$params = array();
				$params['amount'] = $amount;
				$params['card_id'] = $card_id;
				$response=requestdata('prepaid_load_balance_card',$params);

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
		 $transactions=array();
		 
		 if(empty($card_id))
		 {
			 return redirect()->to('/debitcard');
		 }
		 
		 //fetch user debitcard transactions
		 $param_detail = array();
		 $param_detail['card_id'] = $card_id;
		 $response_detail=requestdata('debitcard_trx',$param_detail);
		
		 if($response_detail['status']==1)
		 {
			 $transactions=$response_detail['data'];
			
		 }else{
			  return redirect()->to('/debitcard');
		 }
	

		 $data['transactions']=$transactions;
		 $data['title']='Debitcard Transactions';
		 $data['meta_keywords'] = 'Debitcard Transactions';
		 $data['meta_description'] = 'Debitcard Transactions';
		 return view('debitcard/transactions', $data);
	}


	public function portfolio()
    {	
		 
		 $data = array();
		 $debitcard = array();
		
	     $params = array();
		 $response  =requestdata('portfolio',$params);
		//echo '<pre>';print_r($response);die;
		 if($response['status']==1)
		 {
			 $debitcard = $response;

		 }

		 $data['debitcard']=$debitcard;
		 $data['title']='Debitcard Portfolio';
		 $data['meta_keywords'] = 'Debitcards Portfolio';
		 $data['meta_description'] = 'Debitcards Portfolio';
		 return view('debitcard/portfolio', $data);
	}	
	
	public function settings()
    {	
		
		 $data = array();
		 $coins = array();
		
	     $params = array();
		 $response  =requestdata('coinlist',$params);
		
		 if($response['status']==1)
		 {
			 $coins = $response['coin'];

		 }
		 if($this->request->getMethod() == 'post'){
			  $rules = [
				'coins'=> 'required',
			];
			if($this->validate($rules)) 
			{
				$coinsdata=$this->request->getVar('coins');
				$coin=implode(",", $coinsdata);
				//pr($params);
				$params  =array();
				$params['coins']  =$coin;
				$response = requestdata('select_coin_by_user',$params);				
				if($response['status']==1)
				{				
					$this->session->setFlashdata('success', $response['message']);
					return redirect()->to('/debitcard-portfolio');
				}else{
					$this->session->setFlashdata('error', $response['message']);
					return redirect()->to('/debitcard-settings');
				}		
			}else{
				$this->session->setFlashdata('error', 'Please select currency');
				return redirect()->to('/debitcard-settings');
			}
			 
		 }
		 $data['coins']=$coins;
		 $data['title']='Debitcard Settings';
		 $data['meta_keywords'] = 'Debitcards Settings';
		 $data['meta_description'] = 'Debitcards Settings';
		 return view('debitcard/settings', $data);
	}	
	
		public function sort()
    {	
		 
		 $data = array();
		 $debitcard = array();
		
	     $params = array();
		 $response  =requestdata('portfolio',$params);
		//echo '<pre>';print_r($response);die;
		 if($response['status']==1)
		 {
			 $debitcard = $response;

		 }
		  if($this->request->getMethod() == 'post'){
			  $sorted=$this->request->getVar('sorted');
			  if(!empty($sorted))
			  {
					$params  =array();
					$params['coins']  =rtrim($sorted, ',');
					$response = requestdata('sort_portfolio',$params);				
					if($response['status']==1)
					{				
						$this->session->setFlashdata('success', $response['message']);
						return redirect()->to('/debitcard-portfolio');
					}else{
						$this->session->setFlashdata('error', $response['message']);
						return redirect()->to('/debitcard-sort');
					}	
			  }else{
				  $this->session->setFlashdata('error', 'sort the currency list');
					return redirect()->to('/debitcard-sort');
			  }
			  echo '<pre>';print_r($_POST);die;
		  }
		 $data['debitcard']=$debitcard;
		 $data['title']='Debitcard Portfolio';
		 $data['meta_keywords'] = 'Debitcards Portfolio';
		 $data['meta_description'] = 'Debitcards Portfolio';
		 return view('debitcard/sort', $data);
	}		
}
?>