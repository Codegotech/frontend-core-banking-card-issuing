<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CardFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
       /*  if (!session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login');
        }else{
			$kyc_status=session()->get('kyc_status');
			if($kyc_status==0){
				return redirect()
                ->to('/dashboard');
			}
		} */
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}

?>