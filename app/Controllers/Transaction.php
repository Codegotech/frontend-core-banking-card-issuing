<?php

/**
 * Description of Transactions Controller
 *
 * @author 
 *
 * @email 
 */

namespace App\Controllers;



class Transaction extends BaseController
{
	protected $helpers = ['form','url','api'];
	
	public function __construct()
	{
		$this->session = session();
		
	}
	public function index()
    {	
		
		 $user_id=$this->session->get('user_id');
		 $data=array();
		 $startdate='';
		 $enddate='';
		 $transaction = array();
		 $params = array();
			isset($_GET['page'])? $page = $_GET['page'] : $page = 1;
		
			$param=array();
			if(is_numeric($page)){
				$param['page'] = $page;
			}else{
				$param['page'] = 1;
			}
	    if($this->request->getMethod() == 'post'){
		
			if($this->request->getVar('startdate') !=''){ 
				$startdate = date('Y-m-d', strtotime($this->request->getVar('startdate')));			
				$this->session->set(array("startdate"=> date('Y-m-d',strtotime($startdate))));	
				$param['startdate'] = $startdate;				
			}
			if($this->request->getVar('enddate') !=''){ 
				$enddate = date('Y-m-d', strtotime($this->request->getVar('enddate')));			
				$this->session->set(array("enddate"=> date('Y-m-d',strtotime($enddate))));	
				$param['enddate'] = $enddate;
			}
			
		}else if(!empty($this->session->get('startdate')) && ($this->session->get('enddate'))){
			$startdate = date('Y-m-d',strtotime($this->session->get('startdate')));
			$enddate = date('Y-m-d',strtotime($this->session->get('enddate')));

			$param['startdate'] = $startdate;
			$param['enddate'] = $enddate;
		
			
		}
		 $response=requestdata('getalltransactions',$param);
		// pr($response);
		 if($response['status']==1)
		 {
			 $transaction=$response;
		 }
		 $data['startdate']=$startdate;
		 $data['enddate']=$enddate;
		 $data['transaction']=$transaction;
		 $data['title']='Wallet Transactions';
		 $data['meta_keywords'] = 'Wallet Transactions';
		 $data['meta_description'] = 'Wallet Transactions';
		 return view('transaction/index', $data);
	}	
	

	function transactions_details($transaction_id)
	{
		 $user_id=$this->session->get('user_id');
		 $params=array();
		 $data=array();
		  $params['unique_id'] = $transaction_id;
		  $response=requestdata('get_trx_detail',$params);
		
		 if($response['status']==1)
		 {
			 $transaction=$response;
		 }
		 $data['transaction']=$transaction;
		  $data['title']='Wallet Transaction Details';
		 $data['meta_keywords'] = 'Wallet Transaction Details';
		 $data['meta_description'] = 'Wallet Transaction Details';
		 return view('transaction/transaction_detail', $data);
		
	}
	
	
	public function prepaid_transaction()
    {	
		
		 $user_id=$this->session->get('user_id');
		 $data=array();

		 $transaction = array();
		 $params = array();
			isset($_GET['page'])? $page = $_GET['page'] : $page = 1;
		
			$param=array();
			if(is_numeric($page)){
				$param['page'] = $page;
			}else{
				$param['page'] = 1;
			}

		 $response=requestdata('prepaid_card_transactions',$params);
		 
		 if($response['status']==1)
		 {
			 $transaction=$response;
		 }
		 $data['transaction']=$transaction;
		 $data['title']='Prepaidcard Transactions';
		 $data['meta_keywords'] = 'Prepaidcard Transactions';
		 $data['meta_description'] = 'Prepaidcard Transactions';
		 return view('transaction/prepaid_card_transactions', $data);
	}	
	
	public function debitcard_transaction()
    {	
		
		 $user_id=$this->session->get('user_id');
		 $data=array();

		 $transaction = array();
		 $param = array();
			isset($_GET['page'])? $page = $_GET['page'] : $page = 1;
		
			$param=array();
			if(is_numeric($page)){
				$param['page'] = $page;
			}else{
				$param['page'] = 1;
			}
		 $param['type'] = "debit";
		 $param['status'] = 1;
		 $response=requestdata('debitcard_transactions',$param);
		
		 if($response['status']==1)
		 {
			 $transaction=$response;
		 }
		 $data['transaction']=$transaction;
		 return view('transaction/debitcard_outgoing_transaction', $data);
	}

	public function debitcard_refunds_completed()
    {	
		
		 $user_id=$this->session->get('user_id');
		 $data=array();

		 $transaction = array();
		 $param = array();
			isset($_GET['page'])? $page = $_GET['page'] : $page = 1;
		
			$param=array();
			if(is_numeric($page)){
				$param['page'] = $page;
			}else{
				$param['page'] = 1;
			}
		 $param['type'] = "refund";
		 $param['status'] = 1;
		 $response=requestdata('debitcard_transactions',$param);
		
		 if($response['status']==1)
		 {
			 $transaction=$response;
		 }
		 $data['transaction']=$transaction;
		 return view('transaction/debitcard_refunds_completed', $data);
	}	
	
	public function debitcard_refunds_pending()
    {	
		
		 $user_id=$this->session->get('user_id');
		 $data=array();

		 $transaction = array();
		 $param = array();
			isset($_GET['page'])? $page = $_GET['page'] : $page = 1;
		
			$param=array();
			if(is_numeric($page)){
				$param['page'] = $page;
			}else{
				$param['page'] = 1;
			}
		 $param['type'] = "refund";
		 $param['status'] = 0;
		 $response=requestdata('debitcard_transactions',$param);
		
		 if($response['status']==1)
		 {
			 $transaction=$response;
		 }
		 $data['transaction']=$transaction;
		 return view('transaction/debitcard_refunds_pending', $data);
	}	
	
	
		function debitcard_transaction_details($unique_id,$trx_type='')
	{
		$user_id=$this->session->get('user_id');
		$params=array();
		$data=array();
		$param['trxid'] = $unique_id;
		$param['trx_type'] = $trx_type;
		$response=requestdata('debitcard_transaction_detail',$param);
		//pr($response);
		if($response['status']==1)
		{
			$transaction=$response;
		}
		$data['transactions']=$transaction;
		return view('transaction/debitcard_transaction_detail', $data);
		
	}
	
	
	function clear(){
		$this->session->remove('startdate');
		$this->session->remove('enddate');

		return redirect()->to('/transactions');
	}
	
}
?>
	