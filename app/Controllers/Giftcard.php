<?php

/**
 * Description of Users Controller
 *
 * @author 
 *
 * @email 
 */

namespace App\Controllers;


class Giftcard extends BaseController
{
	protected $helpers = ['form','url','api'];
	
	//fetch list of giftcards
    public function index()
    {
		$user_id=$this->session->get('user_id');
		$giftcards = array();
		$params = array();
		$response=requestdata('getByUserGiftcard',$params);
		//pr($response);
		if($response['status']==1)
		{
			$giftcards=$response['cards'];
		}
		$data = array();
		 $data['title']='Giftcard List';
		 $data['meta_keywords'] = 'Giftcard List';
		 $data['meta_description'] = 'Giftcard List';
		$data['giftcards']=$giftcards; 
		$data['page']="Giftcard List";
        return view('giftcard/list',$data);
    }
	
	public function creategiftcard()
    {
       if($this->request->getMethod() == 'post'){
		   if($this->request->getVar('submit')=='submit')
		   {
				 $rules = [
					'name'=> 'required|min_length[3]|max_length[100]',
					'email'=> 'required|min_length[4]|max_length[100]|valid_email',
					'amount'=> 'required'
				];
				if ($this->validate($rules)) {
					$amount=$this->request->getVar('amount');
					
					$params=array();
					$response=requestdata('virtual_giftcard_fee',$params);
					if($response['status']==1)
					{
						$data['issue_virtual_gift_card_fee']=ltrim($response['issue_virtual_gift_card_fee'], '€');
						$data['loadcard_fee_fixed']=ltrim($response['loadcard_fee_fixed'], '€');
						$data['loadcard_fee_percentage']=rtrim($response['loadcard_fee_percentage'], '%');
						$totalpercent=($data['loadcard_fee_percentage']*$amount)/100;
						$total_amount=$amount+$totalpercent+$data['issue_virtual_gift_card_fee']+$data['loadcard_fee_fixed'];
						$data['total_amount']=$total_amount;
						$data['status']=1;
						
					}else{
						$data['status']=0;
						$data['status']='Invalid request details';
					}
		
					$params=array();
					$params['email']=$this->request->getVar('email');
					$params['amount']=$this->request->getVar('amount');
					$data['status']=1;
					
				}else{
					$data['status']=0;
					$data['message']='Please fill all details';
				}
		   }else if($this->request->getVar('send')=='send')
		   {
					$params=array();
					$params['email']=$this->request->getVar('email');
					$params['amount']=$this->request->getVar('amount');
					$params['name']=$this->request->getVar('name');
					$response=requestdata('generate_virtual_card',$params);
					
					if($response['status']==1)
					{
						$requestid=$response['requestid'];
						$ses_data = [
							'giftcard_requestid' => $requestid,
						];
						$this->session->set($ses_data);
						$data['status']=2;
					}else{
						$data['status']=0;
						$data['message']=$response['message'];
					}
					
			  
		   }
		   
	   }else{
		   $data['status']=0;
		   $data['status']='Invalid request';
	   }
      echo json_encode($data);die;
    }
	
	public function confirmgiftcard()
    {
		if($this->request->getMethod() == 'post'){
			 $rules = [
					'confirm_code'=> 'required',
					'status'=> 'required'
				];
				if ($this->validate($rules)) {
					$giftcard_requestid=$this->session->get('giftcard_requestid');
					$params=array();
					$params['confirm_code']=$this->request->getVar('confirm_code');
					$params['status']=$this->request->getVar('status');
					$params['requestid']=$giftcard_requestid;

					$response=requestdata('confirm_generate_virtual_card',$params);
					
					if($response['status']==1)
					{
						$this->session->remove('giftcard_requestid');
						$data['status']=1;
						$data['message']=$response['message'];
					}else{
						$data['status']=0;
						$data['message']=$response['message'];
					}
			}else{
				$data['status']=0;
				$data['status']='Please fill all details';
			}
		}else{
		   $data['status']=0;
		   $data['status']='Invalid request';
	    }
		echo json_encode($data);die;
	}
	

	
	

	
}
?>