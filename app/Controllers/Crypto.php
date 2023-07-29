<?php

/**
 * Description of Users Controller
 *
 * @author Codego
 *
 * @email 
 */

namespace App\Controllers;


class Crypto extends BaseController
{
	protected $helpers = ['form','url','api'];
	
	public function __construct()
	{
		$this->session = session();
        $this->db = db_connect();

	}
	
	public function index()
	{
		$param_curr = array();	
		$coinlist = requestdata('getAllwallet',$param_curr);

		if($coinlist['is_crypto']==0)
		{
			$this->session->setFlashdata('error', $coinlist['message']);
			return redirect()->to('/dashboard');			
		}
		$data = array();
		$data['coinlist'] = $coinlist;			
		 $data['title']='Cryto Wallet';
		 $data['meta_keywords'] = 'Cryto Wallet';
		 $data['meta_description'] = 'Cryto Wallet';
		return view('crypto/index', $data);
		
	}
	
	public function wallet($coin='')
	{		
		$param = array();		
		$param['coin'] = $coin;		
		$coinlist = requestdata('crypto_wallet',$param);
		//echo '<pre>';print_r($coinlist);die;
		if($coinlist['status'] == 0)
		{			
			$this->session->setFlashdata('error',$coinlist['message']);			
			return redirect()->to('/crypto');
		}						
		if(!isset($coinlist['is_crypto']) && $coinlist['is_crypto'] == 0)
		{
			$this->session->setFlashdata('error','You donot have access crypto currency right now. Please contact to admin.');	
			return redirect()->to('/dashboard');			
		}	
		$data = array();	
		$data['coin'] = $coin;	
		$data['coinlist'] = $coinlist;	
				 $data['title']='Cryto Wallet';
		 $data['meta_keywords'] = 'Cryto Wallet';
		 $data['meta_description'] = 'Cryto Wallet';
		return view('crypto/wallet', $data);
		
	}
	
	
	
	
	public function exchange($coin='',$market='')
	{		
		
		$param = array();		
		$param['coin'] = $coin;	
		$coinlist = requestdata('trade_list',$param);
		//echo '<pre>';print_r($coinlist);die;
		$data = array();	
		if($coinlist['is_crypto'] == 0)
		{
			$data = array();
			$data['title'] = 'Trading Exchange';	
			$data['coin'] = strtoupper($coin);	
			$data['page'] = 'No-Access-Trade';	
		}else if($coinlist['status'] == 0)
		{
			isset($coinlist['message'])? $message = $coinlist['message'] : $message = ucfirst($coin).' market pair has not exist';				
			$data = array();
			$data['title'] = 'This market pair has not exist';	
			$data['coin'] = strtoupper($coin);	
			$data['page'] = 'not-found';	
			$data['message'] = $message;
		}else{
				
			$data = array();
			if(!empty($market) && ($market == 'confirm-exchange'))
			{
				$is_confirm_crypto = $this->session->get('is_confirm_crypto');	
				if($is_confirm_crypto != 1)
				{
					$this->session->setFlashdata('error','Before confirming, kindly submit an exchange request.');	
					return redirect()->to('/crypto/exchange/'.$coin);
				}
				$data['page'] = 'confirm-exchange';
			}else if(!empty($market))
			{
				$data['page'] = 'trade-exchange';
			}else{
				$data['page'] = 'exchange';
			}	
			$data['coinlist'] = $coinlist;	
			$data['coin'] = $coin;	
			$data['title'] = 'Trading Exchange';
			
		}	
				 $data['title']='Cryto Wallet';
		 $data['meta_keywords'] = 'Cryto Wallet';
		 $data['meta_description'] = 'Cryto Wallet';
		//echo '<pre>';print_r($data);die;	
		return view('crypto/exchange', $data);
		
	}
	function exchange_post($coin='')
	{						
		if($this->request->getMethod() == 'post')
		{
			if(!empty($_POST['amount']) && !empty($_POST['from_symbol']) && !empty($_POST['to_symbol']))
			{		
				$from_symbol = $_POST['from_symbol'];
				$to_symbol = $_POST['to_symbol'];						
				$amount = $_POST['amount'];
				if($amount > 0)
				{				
					$param = array();								
					$param['from_symbol'] = $from_symbol;
					$param['to_symbol'] = $to_symbol;
					$param['amount'] = $amount;	
					$resultDate = requestdata('exchange_preview',$param);
					//echo '<pre>';print_r($resultDate);die;
					if($resultDate['status'] == 1)
					{										
						$newsession = array();
						$newsession['time'] = time() + 20;										
						
						$newsession['unique_id'] = $resultDate['unique_id'];
						$newsession['amount'] = $resultDate['amount'];
						$newsession['fee'] = $resultDate['fee'];
						$newsession['crypto_amount'] = $resultDate['crypto_amount'];
						$newsession['price'] = $resultDate['price'];
						$newsession['received_amount'] = $resultDate['received_amount'];
						$newsession['type'] = $resultDate['type'];
						$newsession['from_symbol'] = $resultDate['from_symbol'];
						$newsession['to_symbol'] = $resultDate['to_symbol'];
						$newsession['market'] = $resultDate['market'];	
						$newsession['coin'] = $coin;	
						$ses_data = [
							'exchange_crypto' => $newsession,
						];
						$this->session->set($ses_data);
						
						$market = $resultDate['market'];
						return redirect()->to('/crypto/exchange/'.$coin.'/'.$market);
					}else{
						$this->session->setFlashdata('error', $resultDate['message']);	
						return redirect()->to('/crypto/exchange/'.$coin);
					}					
				}else{
					$this->session->setFlashdata('error', 'Amount should be greater than zero.');
					return redirect()->to('/crypto/exchange/'.$coin);					
				}			
			}
		}
	}
	
	function submit_exchange()
	{		
			
		$exchange_crypto = $this->session->get('exchange_crypto');		
		$coin = $exchange_crypto['coin'];
		
		$diff = $exchange_crypto['time'] + 5 - time();
		if($diff <= 0)
		{
			$this->session->setFlashdata('error','Sorry, the request has been expired. Please try again.');
			$this->session->remove('exchange_crypto');	
			redirect()->to('/crypto/exchange/'.$coin);				
		}
		if(!empty($exchange_crypto['amount']))
		{
					
			$to_symbol = $exchange_crypto['to_symbol'];
			$from_symbol = $exchange_crypto['from_symbol'];
			$type = $exchange_crypto['type'];
			$amount = $exchange_crypto['amount'];
			$unique_id = $exchange_crypto['unique_id'];
			
			$param = array();
			$param['unique_id'] = $exchange_crypto['unique_id'];
			$param['price'] = $exchange_crypto['price'];
			$param['from_symbol'] = $from_symbol;
			$param['to_symbol'] = $to_symbol;			
			$param['amount'] = $amount;				
			$param['type'] = $type;		
			$result = requestdata('submit_exchange',$param);
			
			if($result['status'] == 1)
			{				
				$ses_data = [
					'is_confirm_crypto' => 1,
				];
				$this->session->set($ses_data);
				$this->session->setFlashdata('success',$result['message']);	
				return redirect()->to('/crypto/exchange/'.$coin.'/confirm-exchange');
			}else{
				$this->session->setFlashdata('error',$result['message']);
			}			
		}		
		$this->session->remove('exchange_crypto');	
        return redirect()->to('/crypto/exchange/'.$coin);
	}
	
	function cancel_exchnage()
	{		
		$exchange_crypto = $this->session->get('exchange_crypto');		
		$coin = $exchange_crypto['coin'];			
		$this->session->remove('exchange_crypto');	
		$this->session->setFlashdata('error','Canceled Transaction.');		
        return redirect()->to('/crypto/exchange/'.$coin);
	}
	
	public function confirm_exchange()
	{				
		if($this->request->getMethod() == 'post')
		{		
			$confirm_code=$this->request->getVar('confirm_code');				
			$status=$this->request->getVar('status');				
			if(!empty($confirm_code))
			{
				$param = array();				
				$param['confirm_code'] = $confirm_code;				
				$param['status'] = $status;				
				$result = requestdata('confirm_exchange',$param);
				if($result['status'] > 0)
				{
					$this->session->remove('is_confirm_crypto');
				}					
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
			}else{
				$data['status'] = 0;
				$data['message'] = 'confirm code is required';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
		
	}
	
	function getTrxcoin($coin='')	
	{	
		$param = array();	
		$param['coin'] = $coin;	
		$result = requestdata('getTrxcoin',$param);	
		
		if($result['status'] == 0)
		{
			$result['trx'] = array();
		}
		echo json_encode($result);
	}
	
	function getTrx()
	{		
		$param_curr = array();	
		$result = requestdata('getLatestTrx',$param_curr);			; 
		echo json_encode($result);
		die();
	}
	
	function move_crypto_debit()
	{						
		if($this->request->getMethod() == 'post')
		{	
			$coin=$this->request->getVar('coin');				
			$debit_crypto_amount=$this->request->getVar('debit_crypto_amount');	
			if($debit_crypto_amount > 0)
			{
				$param = array();
				$param['coin'] = $coin;		
				$param['debit_crypto_amount'] = $debit_crypto_amount;	
				$result = requestdata('move_crypto_debit',$param);	
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
			}else{
				$data['status'] = 0;
				$data['message'] = 'Amount should be more than zero.';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
	}
	
	function confirm_move_crypto_debit()
	{						
		if($this->request->getMethod() == 'post')
		{		
			$confirm_code=$this->request->getVar('debit_confirm_code');				
			$status=$this->request->getVar('status');				
			if(!empty($confirm_code))
			{
				$param = array();				
				$param['confirm_code'] = $confirm_code;				
				$param['status'] = $status;				
				$result = requestdata('confirm_move_crypto_debit',$param);
				
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
				
			}else{
				$data['status'] = 0;
				$data['message'] = 'confirm code is required';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
	}
	
	
	function move_debit_crypto()
	{						
		if($this->request->getMethod() == 'post')
		{	
			$coin=$this->request->getVar('coin');				
			$debit_crypto_amount=$this->request->getVar('debit_main_crypto_amount');	
			if($debit_crypto_amount > 0)
			{
				$param = array();
				$param['coin'] = $coin;		
				$param['debit_crypto_amount'] = $debit_crypto_amount;	
				$result = requestdata('move_debit_crypto',$param);	
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
			}else{
				$data['status'] = 0;
				$data['message'] = 'Amount should be more than zero.';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
	}
	
	function confirm_move_debit_crypto()
	{						
		if($this->request->getMethod() == 'post')
		{		
			$confirm_code=$this->request->getVar('debit_main_confirm_code');				
			$status=$this->request->getVar('status');				
			if(!empty($confirm_code))
			{
				$param = array();				
				$param['confirm_code'] = $confirm_code;				
				$param['status'] = $status;				
				$result = requestdata('confirm_move_debit_crypto',$param);
				
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
				
			}else{
				$data['status'] = 0;
				$data['message'] = 'confirm code is required';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
	}
	

	
	function withdrawtrx()
	{						
		if($this->request->getMethod() == 'post')
		{		
			$network = '';
			if(isset($_POST['network']))
			{
				$network = $this->request->getVar('network');	
			}				
			$coin=$this->request->getVar('coin');				
			$crypto_amount=$this->request->getVar('crypto_amount');				
			$receiver_address=$this->request->getVar('receiver_address');				
			if($crypto_amount > 0)
			{
				$param = array();
				$param['coin'] = $coin;	
				$param['network'] = $network;		
				$param['crypto_amount'] = $crypto_amount;				
				$param['receiver_address'] = $receiver_address;				
				$result = requestdata('withdrawtrx',$param);	
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
			}else{
				$data['status'] = 0;
				$data['message'] = 'Amount should be more than zero.';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
	}
	
	function confirm_withdrawtrx()
	{						
		if($this->request->getMethod() == 'post')
		{		
			$confirm_code=$this->request->getVar('confirm_code');				
			$status=$this->request->getVar('status');				
			if(!empty($confirm_code))
			{
				$param = array();				
				$param['confirm_code'] = $confirm_code;				
				$param['status'] = $status;				
				$result = requestdata('confirm_withdrawtrx',$param);
				
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
				
			}else{
				$data['status'] = 0;
				$data['message'] = 'confirm code is required';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
	}
	
	function withdraw_euro()
	{						
		if($this->request->getMethod() == 'post')
		{		
				
			$amount=$this->request->getVar('send_amount');				
			if($amount > 0)
			{
				$param = array();
				$param['amount'] = $amount;								
				$result = requestdata('withdraw_euro',$param);	
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
			}else{
				$data['status'] = 0;
				$data['message'] = 'Amount should be more than zero.';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
	}
	function confirm_withdraw_euro()
	{						
		if($this->request->getMethod() == 'post')
		{		
			$confirm_code=$this->request->getVar('confirm_code');				
			$status=$this->request->getVar('status');	
			if(!empty($confirm_code))
			{
				$param = array();				
				$param['confirm_code'] = $confirm_code;				
				$param['status'] = $status;				
							
				$result = requestdata('confirm_withdraw_euro',$param);	
				isset($result['status'])? $data['status'] = $result['status']: $data['status'] =0;	
				isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
				$data['message'] = $msg;
			}else{
				$data['status'] = 0;
				$data['message'] = 'confirm code is required';
			}
		}else{
			$data['status'] = 0;
			$data['message'] = 'All field are required.';
		}
		echo json_encode($data);
	}
}

?>