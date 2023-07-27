<?php

/**
 * Description of Users Controller
 *
 * @author Codego
 *
 * @email 
 */

namespace App\Controllers;


class User extends BaseController
{
	protected $helpers = ['form','url','api'];
	
	public function __construct()
	{
		$this->session = session();
        $this->db = db_connect();

	}
	

	 //Signup Page
	 public function signup()
    {
		
		if($this->request->getMethod() == 'post'){
			
			 $rules = [
				'email' => 'required|min_length[4]|max_length[100]|valid_email',
				'g-recaptcha-response' => 'required',
			 ];
			 if ($this->validate($rules)) {
				 
				 	$secret=GOOGLE_SECRET_KEY;

					$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->request->getVar('g-recaptcha-response'));
					$captcha_status = json_decode($verifyResponse,true);
					
					if(!empty($captcha_status["success"]) &&  ($captcha_status['hostname'] == GOOGLE_HOST)){
						$params = [
						'email'     => $this->request->getVar('email'),
						];
						//call sandbox api to start signup with email
						$response=publicrequestdata('signup_email',$params);
						
						if($response['status']==1)
						{
							$ses_data = [
								'signupemail' => $this->request->getVar('email'),
							];
							$this->session->set($ses_data);
							$this->session->setFlashdata('success', $response['message']);
							return redirect()->to('/verify-email');
						
						}else{
							$this->session->setFlashdata('error', $response['message']);
							return redirect()->to('/signup');
						}
					}else{
							$this->session->setFlashdata('error', 'Captcha failed,Please try again!');
							return redirect()->to('/signup');
					}
			 }else {
				$validation=validation_list_errors();
				$this->session->setFlashdata('error', $validation);
				return redirect()->to('/signup');
			}
		}
		$data = array();
		$data['page']="Signup";
		$data['title']='Sandbox Signup';
		$data['meta_keywords'] = 'Sandbox Signup';
		$data['meta_description'] = 'Sandbox Signup';
        return view('user/signup',array('data' => $data));
    }
	
	 //Verify Email
	 public function verifyemail()
    {
	
		$signupemail=$this->session->get('signupemail');
		if(empty($signupemail))
		{
			return redirect()->to('/signup');
		}
		if($this->request->getMethod() == 'post'){
			 $rules = [
				'code' => 'required|min_length[4]|max_length[6]',
				'g-recaptcha-response' => 'required',
			 ];
			 if ($this->validate($rules)) {
					$secret=GOOGLE_SECRET_KEY;

					$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->request->getVar('g-recaptcha-response'));
					$captcha_status = json_decode($verifyResponse,true);
					if(!empty($captcha_status["success"]) &&  ($captcha_status['hostname'] == GOOGLE_HOST)){
						$params = [
						'activation_code'     => $this->request->getVar('code'),
						'email'     => $signupemail,
						];
						//call sandbox api to verify signup email
						$response=publicrequestdata('signup_verify_email',$params);
						if($response['status']==1)
						{
							$this->session->setFlashdata('success', $response['message']);
							return redirect()->to('/register');
							
						}else{
							$this->session->setFlashdata('error', $response['message']);
							return redirect()->to('/verify-email');
						}
					}else{
						$this->session->setFlashdata('error', 'Captcha failed,Please try again!');
						return redirect()->to('/verify-email');
					}
			 }else {
				$validation=validation_list_errors();
				$this->session->setFlashdata('error', $validation);
				return redirect()->to('/verify-email');
			}
		}
		$data = array();
		$data['page']="Verify Email";
		$data['title']='Sandbox Signup Verify Email';
		$data['meta_keywords'] = 'Sandbox Signup Verify Email';
		$data['meta_description'] = 'Sandbox Signup Verify Email';
        return view('user/verifyemail',array('data' => $data));
    }
	
	//Full Register Page
    public function index()
    {
		$signupemail=$this->session->get('signupemail');
		if(empty($signupemail))
		{
			return redirect()->to('/signup');
		}
		
		//fetch country,nationality,income source from sandbox api
		$nationality=array();
		$countries=array();
		$income_source=array();
		$params=array();
		$response=publicrequestdata('nationality',$params);
		$response_income=publicrequestdata('income_source',$params);
		if($response['status']==1)
		{
			$nationality=$response['countries'];
			$countries=$response['countries'];
		}
		 if($response_income['status']==1)
		{
			$income_source=$response_income['income_source'];
			
		}
		
		$data = array();
		$data['email']=$signupemail;
		$data['countries']=$nationality;
		$data['nationality']=$nationality;
		$data['income_sources']=$income_source; 
		$data['page']="Signup";
		$data['title']='Sandbox Signup Page';
		$data['meta_keywords'] = 'Sandbox Signup Page';
		$data['meta_description'] = 'Sandbox Signup Page';
        return view('user/register',array('data' => $data));
    }
	
    //Signup Page
    public function registerAuth()
    {
		
		$signupemail=$this->session->get('signupemail');
		if(empty($signupemail))
		{
			return redirect()->to('/signup');
		}
		 if($this->request->getMethod() == 'post'){
			
			 $rules = [
				'name'          => 'required|min_length[3]|max_length[50]',
				'phone'          => 'required|min_length[6]|max_length[50]',
				'surname'          => 'required|min_length[2]|max_length[50]',
				'password'      => 'required|min_length[4]|max_length[50]',
				'confirmpassword'  => 'matches[password]'
			];
			if ($this->validate($rules)) {

				$password=$this->request->getVar('password');
				$phonecode=$this->request->getVar('phonecode');
				$phonestr=explode('#',$phonecode);
				$phone=$this->request->getVar('phone');
				$phone_number=$phonestr[0].'-'.$phone;
				$country=$phonestr[1];
				
				
				 $params = [
					'name'     => $this->request->getVar('name'),
					'surname'     => $this->request->getVar('surname'),
					'password'    => $password,
					'email'    => $signupemail,
					'country_id'    => $this->request->getVar('country_id'),
					'country'    => $country,
					'country_of_residence'    => $this->request->getVar('country_of_residence'),
					'nationality'    => $this->request->getVar('nationality'),
					'gender'    => $this->request->getVar('gender'),
					'country_pay_tax'    => $this->request->getVar('country_pay_tax'),
					'tax_personal_number'    => $this->request->getVar('tax_personal_number'),
					'country_of_residence'    => $this->request->getVar('country_of_residence'),
					'work_country'    => $this->request->getVar('work_country'),
					'income_soruce'    => $this->request->getVar('income_soruce'),
					'political_person'    => $this->request->getVar('political_person'),
					'city'    => $this->request->getVar('city'),
					'zipcode'    => $this->request->getVar('zipcode'),
					'address'    => $this->request->getVar('address'),
					'is_same'    => $this->request->getVar('is_same'),
					'dob'    => date('Y-m-d',strtotime($this->request->getVar('dob'))),
					'mobile'    => $phone
				];
				//call api to create user on sandbox api
				$response=publicrequestdata('signup',$params);
				//pr($response);
				if($response['status']==1)
				{

					$this->session->setFlashdata('success',$response['message']);
					return redirect()->to('/login');
				}else{
					$this->session->setFlashdata('error', $response['message']);
					return redirect()->to('/register');
				}
				
			} else {
				$validation=validation_list_errors();
				$this->session->setFlashdata('error', $validation);
				return redirect()->to('/register');
			}
		}else{
			$this->session->setFlashdata('error', 'please fill all the fields.');
			return redirect()->to('/register');
		}
    }
    // login form
    public function login()
    {
        $data = array();
        helper(['form']);
        return view('user/login', $data);
    }

    // check login auth
    public function loginAuth()
    {
		 if($this->request->getMethod() == 'post'){
			$rules = [
				'email'=> 'required|min_length[4]|max_length[100]|valid_email',
				'password'      => 'required|min_length[4]|max_length[50]',
				'g-recaptcha-response' => 'required',
			];
			if ($this->validate($rules)) 
			{				
				$secret=GOOGLE_SECRET_KEY;
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->request->getVar('g-recaptcha-response'));
				$captcha_status = json_decode($verifyResponse,true);
				if(!empty($captcha_status["success"]) &&  ($captcha_status['hostname'] == GOOGLE_HOST)){
					$email = $this->request->getVar('email');
					$password = $this->request->getVar('password');
					$params = array();
					$params['email']=$email;
					$params['password']=$password;
					$response = publicrequestdata('login_user',$params);
					//pr($response);
					if($response['status']==1)
					{
						$ses_data = [
							'user_id' => $response['user_id'],
							'token' => $response['token'],
						];
						$this->session->set($ses_data);
						$this->session->setFlashdata('success',$response['message']);
						return redirect()->to('/otp');
					}else{
						$this->session->setFlashdata('error', $response['message']);
						return redirect()->to('/login');
					}				
				}else{
					$this->session->setFlashdata('error', 'Captcha failed,Please try again!');
					return redirect()->to('/login');
				} 
			}else{
				$validation=validation_list_errors();
				$this->session->setFlashdata('error', $validation);
				return redirect()->to('/login');
			}
			
		}else{
			 $this->session->setFlashdata('error', 'Email does not exist.');
				return redirect()->to('/login');
		}
    }
	
		 //Verify Email
	 public function otp()
    {
		
		$user_id=$this->session->get('user_id');
		if(empty($user_id))
		{
			return redirect()->to('/login');
		}
	
		if($this->request->getMethod() == 'post')
		{
			 $rules = [
				'code' => 'required|min_length[4]|max_length[6]',
				//'g-recaptcha-response' => 'required',
			 ];
			 if ($this->validate($rules))
			 {				
				$secret=GOOGLE_SECRET_KEY;
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->request->getVar('g-recaptcha-response'));
				$captcha_status = json_decode($verifyResponse,true);			
				if(!empty($captcha_status["success"]) &&  ($captcha_status['hostname'] == GOOGLE_HOST)){				
					$params = [
						'logincode'     => (int)$this->request->getVar('code'),
					];
					//call sandbox api to verify login OTP
					$response=requestdata('login_verify',$params);
					
					if($response['status']==1)
					{
						$ses_data = [
							'is_logged' => 1,
						];
						$this->session->set($ses_data);
						$this->session->setFlashdata('success', $response['message']);
						return redirect()->to('/dashboard');
						
					}else{
						$this->session->setFlashdata('error', $response['message']);
						return redirect()->to('/login');
					}
				}else{
					$this->session->setFlashdata('error', 'Captcha failed,Please try again!');
					return redirect()->to('/login');
				} 
			 }else{
				$validation=validation_list_errors();
				$this->session->setFlashdata('error', $validation);
				return redirect()->to('/otp');
			}
		}
		$data = array();
		$data['page']="Verify Login OTP";
		$data['title']='Verify Login OTP';
		$data['meta_keywords'] = 'Verify Login OTP';
		$data['meta_description'] = 'Verify Login OTP';
        return view('user/otp',array('data' => $data));
    }
	

    // user dashboard
    public function dashboard()
    {
		
        $data = array();
        $params = array();
        $countries = array();
		$params = array();
		$statuses=array();		
		//check kyc status from sandbox api
		$response=requestdata('check_kyc_status',$params);
		
		if($response['status']==1)
		{			
			foreach($response['kyc_status'] as $kyc_status)
			{
				$kycsts['document_name']=$kyc_status['document_name'];
				$kycsts['status']=$kyc_status['status'];
				$statuses[]=$kycsts;
			}
		}		
		//fetch data dashboard data from sandbox api
		$result_wallets=requestdata('wallets',$params);		
		$data['wallets'] = $result_wallets;		
		$data['cashback_enable'] = $result_wallets['cashback_enable'];		
		$data['cashback_amount'] = $result_wallets['cashback_amount'];		
		$data['kyc_status']=$response;		
		$data['countries']=$countries;
		$data['statuses']=$statuses;
		$data['balance']=0;
		$data['title']='Sandbox Dashboard';
		$data['meta_keywords'] = 'Sandbox Dashboard';
		$data['meta_description'] = 'Sandbox Dashboard';
        return view('user/dashboard', $data);
    }
	
	
	public function wallet_detail($type='main')
	{
		$param_curr = array();	
		$param_curr['type_wallet'] = $type;
		$result = requestdata('wallet_detail',$param_curr);
		if(!isset($result['status']))
		{
			$this->session->setFlashdata('error','Something missing.');
			return redirect()->to('/login');
		}			
		$param_curr = array();	
		$result_country = requestdata('wire_deposit_country',$param_curr);
		
		$wire_currencies = array();	
		
		if($result_country['status']==1)
		{
			$wire_currencies=$result_country['currencies'];
		}
		
		
		$data = array();	
		$data['wire_currencies'] = $wire_currencies;
		$data['title'] = 'Wallet Detail';	
		if($result['status']==1)
		{
			if(isset($result['card']) && !empty($result['card']))
			{
				$data['card'] = $result['card'];	
				$data['transactions'] = $result['card']['transactions'];	
			}else{
				$data['wallet'] = $result['wallet'];	
				$data['transactions'] = $result['wallet']['transactions'];	
			}				
		}
		
		$data['title']='Sandbox Wallet Detail';
		$data['meta_keywords'] = 'Sandbox Wallet Detail';
		$data['meta_description'] = 'Sandbox Wallet Detail';
		return view('user/wallet_detail', $data);
		
	}
	
	
	function wiredeposit()
	{				
		$user_id=$this->session->get('id');
		if($this->request->getMethod() == 'post')
		{		
			$amount=$this->request->getVar('amount');
			$country=$this->request->getVar('country');
			$wire_currency=$this->request->getVar('wire_currency');			
			if($amount > 0)
			{
				$param=array();
				$param['user_id'] = $user_id;
				$param['amount'] = $amount;
				$param['country'] = $country;
				$param['currency'] = $wire_currency;
				$result = requestdata('wire_deposit',$param);	
				if($result['status'] == 1)
				{
					$data['status'] = 1;
					$data['reference'] = $result['reference'];
					$data['bankname'] = $result['bank']['bankname'];
					$data['account'] = $result['bank']['account'];
					$data['memo'] = $result['bank']['memo'];
					$data['account_holder'] = $result['bank']['account_holder'];
				}else{
					$data['status'] = 0;
					isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
					$data['message'] = $msg;
				}
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
	
	function movebalancedebittomain()
	{				
		$user_id=$this->session->get('id');
		if($this->request->getMethod() == 'post')
		{		
			$amount=$this->request->getVar('amount');				
			if($amount > 0)
			{
				$param = array();
				$param['amount'] = $amount;				
				$result = requestdata('movebalancedebittomain',$param);	
				if($result['status'] == 1)
				{
					$data['status'] = 1;	
					isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
					$data['message'] = $msg;	
				}else{
					$data['status'] = 0;
					isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
					$data['message'] = $msg;
				}
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
	function movebalancedebit()
	{				
		$user_id=$this->session->get('id');
		if($this->request->getMethod() == 'post')
		{		
			$amount=$this->request->getVar('amount');				
			if($amount > 0)
			{
				$param = array();
				$param['amount'] = $amount;				
				$result = requestdata('movebalancedebit',$param);	
				if($result['status'] == 1)
				{
					$data['status'] = 1;	
					isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
					$data['message'] = $msg;	
				}else{
					$data['status'] = 0;
					isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
					$data['message'] = $msg;
				}
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
	function confirmmovebalance()
	{				
		$user_id=$this->session->get('id');
		if($this->request->getMethod() == 'post')
		{		
			$confirm_code=$this->request->getVar('confirm_code');				
			$status=$this->request->getVar('status');				
			if(!empty($confirm_code))
			{
				$param = array();				
				$param['confirm_code'] = $confirm_code;				
				$param['status'] = $status;				
				$result = requestdata('confirmmovebalance',$param);	
				if($result['status'] == 1)
				{
					$data['status'] = 1;	
					isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
					$data['message'] = $msg;	
				}else{
					$data['status'] = 0;
					isset($result['message'])? $msg = $result['message'] : $msg = 'Try again.';
					$data['message'] = $msg;
				}
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
	

	// user profile page
    public function profile()
    {
		
        $data = array();
        $params = array();
        $profile = array();
      
		$name=$this->session->get('name');
		$user_id=$this->session->get('id');
		
		//fetch account details from sandbox api
		$response=requestdata('account_detail',$params);
		//echo '<pre>';print_r($response);die;
		if($response['status']==1)
		{
			$profile=$response['account'];
		}
		
		$data['profile']=$profile;
		$data['title']='Sandbox Profile';
		$data['meta_keywords'] = 'Sandbox Profile';
		$data['meta_description'] = 'Sandbox Profile';
        return view('user/profile', $data);
    }
	
	// update kyc document (in case of document rejected)
    public function updatekyc($kyc_doc)
    {
		if(empty($kyc_doc))
		{
			$this->session->setFlashdata('msg', 'Unauthorised access!!!');
			return redirect()->to('/dashboard');
		}
		$params=array();
		$documents=array();
		
		
		//fetch document list from sandbox api
		$response=requestdata('documents_list',$params);
		if($response['status']==1)
		{
			
			foreach($response['documents'] as $document)
			{
				
				$doc_id=$document['id'];
				$doc_name=$document['name'];
				$documents[$doc_name]=$doc_id;
				
			}
			
		}
		 if($this->request->getMethod() == 'post'){
			 $document_id = $this->request->getVar('document_id');
			 $document_type = $this->request->getVar('document_type');
			 $document_number = $this->request->getVar('document_number');
			 
			 //Upload ID Proof
			 if(!empty($_FILES['front_proof']['name']))
			 {
				 $params=array();
					
				 $params['document_id'] = $document_id;
				 //$params['document_type'] = $document_type;
				 $params['document_number'] = $document_number;
				 $params['document'] = 'front_proof';
				 $filedata['front_proof']=$_FILES['front_proof'];
				 $filedata['back_proof']=$_FILES['back_proof'];
				 
				 //call sandbox api to upload document for id proof
				 $response=requestimagedata('upload_id_proof',$params,$filedata);

				 if($response['status']==1)
				 {
					
					$this->session->setFlashdata('msg',$response['message']);
					return redirect()->to('/dashboard');
				 }else{
					 $this->session->setFlashdata('msg', $response['message']);
				      return redirect()->to('/dashboard');
				 }
				 
			 }
			 
			 //Upload Address Proof
			 if(!empty($_FILES['address_proof']['name']))
			 {
					 $params=array();
					 $params['document']='adress_proof';
					 $params['document_id'] = $document_id;
					 $filedata=$_FILES['address_proof'];
					 //call sandbox api to upload document for address proof
					 $response=requestimagedata('address_proof',$params,$filedata);
					
					 if($response['status']==1)
					 {
						
						$this->session->setFlashdata('msg',$response['message']);
						return redirect()->to('/dashboard');
					 }else{
						 $this->session->setFlashdata('msg', $response['message']);
						return redirect()->to('/dashboard');
					 }
			 }
			

		 }
		
        $data = array();
		$data['documents']=$documents;
		
		$data['kyc_document']=$kyc_doc;
        helper(['form']);
		$data['title']='Update KYC Documents';
		$data['meta_keywords'] = 'Update KYC Documents';
		$data['meta_description'] = 'Update KYC Documents';
        return view('user/updatekyc', $data);
    }
	
	// upload kyc documents
    public function uploadkyc()
    {
		$user_id=$this->session->get('id');
		$params=array();
		$documents=array();
		$kyc_array=array();
		
		//fetch document list from sandbox api
		$response=requestdata('documents_list',$params);
		if($response['status']==1)
		{
			$documents=$response['documents'];
		
		}
		//check kyc status from sandbox api
		$response=requestdata('check_kyc_status',$params);
		//pr($response);
		if($response['status']==1)
		{
			
			foreach($response['kyc_status'] as $kyc_status)
			{

				$kycsts['document_name']=$kyc_status['document_name'];
				$kycsts['status']=$kyc_status['status'];
				$statuses[]=$kycsts;
			}
			
			$kyc_count=count($statuses);
			if($kyc_count==2)
			{
				$this->session->setFlashdata('msg', 'Documents has been already submitted');
				return redirect()->to('/dashboard');
			}
			/* $kyc_array=array();
			foreach($userkyc as $kyc)
			{
				$document_id=$kyc['document_id'];
				$kyc_array[$document_id]=$kyc['status'];
				
			} */
		}else if($response['status']==0 && !empty($response['updated']))
		{
			$kyc_array=$response['updated'];
		}
	
			
			
		
		 if($this->request->getMethod() == 'post'){
			 $document_id = $this->request->getVar('document_id');
			 $document_type = $this->request->getVar('document_type');
			 $document_number = $this->request->getVar('document_number');
			
			 //Upload ID proof
			 if(!empty($_FILES['front_proof']['name']))
			 {
				 $params=array();
					
				 $params['document_id'] = $document_id;
				 //$params['document_type'] = $document_type;
				 $params['document_number'] = $document_number;
				 $params['document'] = 'front_proof';
				 $filedata['front_proof']=$_FILES['front_proof'];
				 $filedata['back_proof']=$_FILES['back_proof'];
				  //call sandbox api to upload document for id proof
				 $response=requestimagedata('upload_id_proof',$params,$filedata);
				 //echo '<pre>';print_r($response);die;
				 if($response['status']==1)
				 {

					$this->session->setFlashdata('msg',$response['message']);
					return redirect()->to('/uploadkyc');
				 }else{
					 $this->session->setFlashdata('msg', $response['message']);
					return redirect()->to('/uploadkyc');
				 }
				 
			 }
			 
			 //Upload Address proof
			 if(!empty($_FILES['address_proof']['name']))
			 {
					$params=array();
					$params['document']='adress_proof';
					 $params['document_id'] = $document_id;
					 $filedata=$_FILES['address_proof'];
					  //call sandbox api to upload document for address proof
					 $response=requestimagedata('address_proof',$params,$filedata);
					 
					 if($response['status']==1)
					 {
						$this->session->setFlashdata('msg',$response['message']);
						return redirect()->to('/uploadkyc');
					 }else{
						 $this->session->setFlashdata('msg', $response['message']);
						return redirect()->to('/uploadkyc');
					 }
			 }
			

		 }
		
        $data = array();
		$data['documents']=$documents;
		$data['kyc_array']=$kyc_array;
        helper(['form']);
		$data['title']='Upload KYC Documents';
		$data['meta_keywords'] = 'Upload KYC Documents';
		$data['meta_description'] = 'Upload KYC Documents';
        return view('user/uploadkyc', $data);
    }


    public function logout()
    {
       
        $this->session->destroy();
        return redirect()->to('/login');
    }
	
	// forgot password
    public function forgot_password()
    {
        $data = array();
        helper(['form']);

		 if($this->request->getMethod() == 'post'){
			 $rules = [
				'email'=> 'required|min_length[4]|max_length[100]|valid_email',
				'g-recaptcha-response' => 'required',
			];
			if ($this->validate($rules)) {
				$secret=GOOGLE_SECRET_KEY;

					$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->request->getVar('g-recaptcha-response'));
					$captcha_status = json_decode($verifyResponse,true);
					if(!empty($captcha_status["success"]) &&  ($captcha_status['hostname'] == GOOGLE_HOST)){
						$params=array();
						$email = $this->request->getVar('email');
						$params['email']=$email;
						$response=publicrequestdata('forgot_password',$params);
						//pr($response);
						 if($response['status']==1)
						 {
								$ses_data = [
									'forgot_email' => $email,
								];
							$this->session->set($ses_data);
							$this->session->setFlashdata('msg',$response['message']);
							return redirect()->to('/verify-forgot-password');
						 }else{
							 $this->session->setFlashdata('msg', $response['message']);
							 return redirect()->to('/forgot-password');
						 }
					}else{
						$this->session->setFlashdata('error', 'Captcha failed,Please try again!');
						return redirect()->to('/forgot-password');
					}
			}else{
				$this->session->setFlashdata('msg','Please enter the valid email address');
				return redirect()->to('/forgot-password');
			}
		 }
        return view('user/forgot_password', $data);
    }
	
	//verify forgot password OTP
	public function verify_forgot_password()
    {
		$forgot_email=$this->session->get('forgot_email');
		if(empty($forgot_email))
		{
			return redirect()->to('/forgot-password');
		}
       if($this->request->getMethod() == 'post'){
		   $rules = [
				'code'=> 'required|min_length[4]|max_length[100]',
				'g-recaptcha-response' => 'required',
			];
			if ($this->validate($rules)) {
				$secret=GOOGLE_SECRET_KEY;

				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->request->getVar('g-recaptcha-response'));
				$captcha_status = json_decode($verifyResponse,true);
				if(!empty($captcha_status["success"]) &&  ($captcha_status['hostname'] == GOOGLE_HOST)){
					$params=array();
					$code = $this->request->getVar('code');
					$params['email']=$forgot_email;
					$params['otp']=$code;
					$response=publicrequestdata('forgot_password_verify',$params);
					 $this->session->remove('forgot_email');
					 if($response['status']==1)
					 {
						$this->session->setFlashdata('msg',$response['message']);
						return redirect()->to('/login');
					 }else{
						 $this->session->setFlashdata('msg', $response['message']);
						 return redirect()->to('/forgot-password');
					 }
				 }else{
					 $this->session->setFlashdata('error', 'Captcha failed,Please try again!');
					 return redirect()->to('/forgot-password');
				 }
			}else{
				$this->session->setFlashdata('msg','Please enter the OTP');
				return redirect()->to('/forgot-password');
			}
	   }
	   $data=array();
	    return view('user/verify_forgot_password', $data);
    }
	


}

?>