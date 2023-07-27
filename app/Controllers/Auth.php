<?php

/**
 * Description of Auth Controller
 *
 * @author Codego
 *
 * @email 
 */

namespace App\Controllers;



class Auth extends BaseController
{
	protected $helpers = ['form','url','api'];
	
	
	//Generate auth token which will be used to call sandbox apis
	function index()
	{

				//call sandbox api to generate auth token to call sandbox apis
				$response=authenticate();
				if(!empty($response))
				{

					$auth=json_decode($response,true);
					if($auth['status']==1)
					{
						$token=$auth['auth_token'];
						echo 'Please copy this authtoken and define in your constant file as AUTHTOKEN <br><br>'.$token;die;
					}else{
						echo $auth['message'];
						die;
					}
					
					
					
				}
		
		
	}
	

}
?>