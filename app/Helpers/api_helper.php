<?php 
	
	function to_decimal($value, $places=8)
	{		
		$value = number_format($value, $places, '.','');		
		return $value;
	}	
	//function to generate auth_token for authentication
	function authenticate()
	{
		$method="authenticaion";		
		$client_key=CLIENT_KEY;
		$secret_key=SECRET_KEY;
		$api_key=API_KEY;
		$whitelable_id=WHITELABEL_ID;		
		$headers = array(
			'clientkey: ' . $client_key,
			'secretkey: ' . $secret_key,
		);		
		$data['apikey']=$api_key;
		$data['whitelabel_id']=$whitelable_id;

		$url = API_URL.$method;	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);	
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch); 
		$error = curl_error($ch);		
		curl_close($ch);
		if ($error) 
		{
			echo "cURL Error: " . $error;
		} else {
			return $result;
		}
	}
	
	function publicrequestdata($method,$data)
	{		
		$api_key=API_KEY;
		$whitelable_id=WHITELABEL_ID;		
		
		$authtoken=AUTHTOKEN;
		$headers = array(
			'authtoken: ' . $authtoken
		);	
		$data['apikey']=$api_key;
		$data['whitelabel_id']=$whitelable_id;
		
		$url = API_URL.$method;		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);	
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch); 
		$error = curl_error($ch);		
		curl_close($ch);
		$res=array();	
		
		if(is_null($result))
		{			
			echo '<h2 style="text-align:center;">Website on maintenance mode</h2>';
			die();
		}else{		
			$res = json_decode($result,true);
			if(isset($res['status']) && ($res['status'] == 100))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login');	
				die();
			}else if(isset($res['status']) && ($res['status'] == 101))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login'); 
				die();	
			}else if(isset($res['status']) && ($res['status'] == 102))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);
				session_destroy();	
				header('Location: '.base_url().'login');
				die();	
			}else if(isset($res['status']) && ($res['status'] == 200))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login');
				die();	
			}else{
				return $res;
			}
		}
	}

   //function to call sandbox api functions
	function requestdata($method,$data)
	{		
		$api_key=API_KEY;
		$whitelable_id=WHITELABEL_ID;		
		
		$authtoken=AUTHTOKEN;
		$headers = array(
			'authtoken: ' . $authtoken
		);		
		$session = session();
		$user_id = $session->get('user_id');
		$token = $session->get('token');	
		if(!empty($user_id) && !empty($token))
		{
			$data['user_id'] = $user_id;
			$token = $session->get('token');
			$data['token']=$token;
		}else{			
			$session = session();	
			$session->setFlashdata('msg','Unauthorized Access');	
			session_destroy();	
			header('Location: '.base_url().'login');	
			die();
		}
		$data['apikey']=$api_key;
		$data['whitelabel_id']=$whitelable_id;
		
		$url = API_URL.$method;		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);	
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch); 
		$error = curl_error($ch);		
		curl_close($ch);
		$res=array();		

		if(is_null($result))
		{			
			echo '<h2 style="text-align:center;">Website on maintenance mode</h2>';
			die();
		}else{		
			$res = json_decode($result,true);
			if(isset($res['status']) && ($res['status'] == 100))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login');	
				die();
			}else if(isset($res['status']) && ($res['status'] == 101))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login'); 
				die();	
			}else if(isset($res['status']) && ($res['status'] == 102))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);
				session_destroy();	
				header('Location: '.base_url().'login');
				die();	
			}else if(isset($res['status']) && ($res['status'] == 200))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login');
				die();	
			}else{
				return $res;
			}
		}
	}

	function requestimagedata($method,$data,$filedata)
	{
		$authtoken=AUTHTOKEN;
		$api_key=API_KEY;
		$whitelable_id=WHITELABEL_ID;			
		$headers = array(
			'authtoken: ' . $authtoken
		);
		$session = session();
		$user_id = $session->get('user_id');
		$token = $session->get('token');	
		if(!empty($user_id) && !empty($token))
		{
			$data['user_id'] = $user_id;
			$token = $session->get('token');
			$data['token']=$token;
		}else{			
			$session = session();	
			$session->setFlashdata('msg','Unauthorized Access');	
			session_destroy();	
			header('Location: '.base_url().'login');	
			die();
		}
		$data['apikey']=$api_key;
		$data['whitelabel_id']=$whitelable_id;
		if($data['document']=='front_proof')
		{
			$frontfile = new CURLFILE($filedata['front_proof']['tmp_name'],$filedata['front_proof']['type'],$filedata['front_proof']['name']);
			$data['front_proof']=$frontfile;
			if(!empty($filedata['back_proof']['name']))
			{
				$backfile = new CURLFILE($filedata['back_proof']['tmp_name'],$filedata['back_proof']['type'],$filedata['back_proof']['name']);
				$data['back_proof']=$backfile;
			}
		}else{
			$cfile = new CURLFILE($filedata['tmp_name'],$filedata['type'],$filedata['name']);
			$data['address_proof']=$cfile;
		}
		
		
		$url = API_URL.$method;		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);	
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 			
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch); 
		$error = curl_error($ch);
		curl_close($ch);
		$res = json_decode($result,true);
		if(is_null($res))
		{
			echo '<h2 style="text-align:center;">Website on maintenance mode</h2>';
			die();
		}else{				
			$res = json_decode($result,true);
			if(isset($res['status']) && ($res['status'] == 100))
			{	
				$res = json_decode($result,true);
			if(isset($res['status']) && ($res['status'] == 100))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login');	
				die();
			}else if(isset($res['status']) && ($res['status'] == 101))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login'); 
				die();	
			}else if(isset($res['status']) && ($res['status'] == 102))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);
				session_destroy();	
				header('Location: '.base_url().'login');
				die();	
			}else if(isset($res['status']) && ($res['status'] == 200))
			{		
				$session = session();	
				$session->setFlashdata('msg', $res['message']);	
				session_destroy();	
				header('Location: '.base_url().'login');
				die();	
			}else{
				return $res;
			}
			}else{
				return $res;
			}
		}
	}


	function floatvalue($val)
	{
		$val = str_replace(",","*",$val);
		$val = str_replace(".",",",$val);
		$val = str_replace("*",".",$val);
	   return $val;
	}
?>