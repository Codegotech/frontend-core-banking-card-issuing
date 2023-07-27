<?php

/**
 * Description of Beneficiary Controller
 *
 * @author 
 *
 * @email 
 */

namespace App\Controllers;



class Beneficiary extends BaseController
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
		 $beneficiaries = array();
		  
		  //fetch beneficiary
	     $params = array();
		 $response=requestdata('list_beneficiary',$params);
		// pr($response);
		 if($response['status']==1)
		 {
			 $beneficiaries=$response['data'];
		 }
		 $data['beneficiaries']=$beneficiaries;
		 $data['title']='Beneficiary List';
		 $data['meta_keywords'] = 'Beneficiary List';
		 $data['meta_description'] = 'Beneficiary List';

		 return view('beneficiary/list', $data);
	}	
	
	public function add()
    {	
	
		if($this->request->getMethod() == 'post'){
			$rules = [
				'email'         => 'required|min_length[4]|max_length[100]|valid_email',
			 ];
			 if ($this->validate($rules)) {
				$params=array();
				 $params = [
					'email'     => $this->request->getVar('email'),
					];
					//call sandbox api to create beneficiary
					$response=requestdata('add_internal_beneficiary',$params);
					//pr($response);
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
				  $data['message']='please enter email address';
			  }
			 $email=$this->request->getVar('email');
		}else{
			$data['status']=0;
			$data['message']='please enter email address'; 
		}
		 echo json_encode($data);
	}	
	
	public function delete($beneficiary_id)
    {	
		
		 $user_id=$this->session->get('user_id');
		if(empty($beneficiary_id))
		 {
			 return redirect()->to('/beneficiaries');
		 }

		//call sandbox api to delete beneficiary
	     $params = [
					'unique_id'     => $beneficiary_id,
					];
		 $response=requestdata('delete_beneficiary',$params);
		   if($response['status']==1)
			{
				$this->session->setFlashdata('success', $response['message']);
				return redirect()->to('/beneficiaries');	
			}else{
				$this->session->setFlashdata('error', $response['message']);
				return redirect()->to('/beneficiaries');
			}

	}
	
	
	public function sendmoney()
    {	

		 $user_id=$this->session->get('user_id');
		  $data = array();
	
		 if(!empty($user_id))
		 {
			  $amount=$this->request->getVar('amount');
			  $beneficiary_id=$this->request->getVar('beneficiary_id');
			 
			  if($amount>0 && !empty($beneficiary_id))
			  {
				 
				  if(isset($_POST['submit']) && $_POST['submit']=='submit')
				  {
					    $params = array();
						$params['amount'] = $amount;
						$params['beneficiary_id'] = $beneficiary_id;
						
						$response=requestdata('send_to_beneficiary',$params);
					
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
						$beneficiary_id=$this->request->getVar('beneficiary_id');
						$confirm_code=$this->request->getVar('confirm_code');
						$params['beneficiary_id'] = $beneficiary_id;
						$params['status'] = $this->request->getVar('status');
						$params['confirm_code'] = $confirm_code;
						
						$response=requestdata('confirm_transaction',$params);
						pr($response);
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
			$data['message']='Unauthorise access to send money'; 
		 }
		 
		 echo json_encode($data);
	}
	
}

?>