<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserwalletModel extends Model{
    protected $table = 'user_wallet';
    
    protected $allowedFields = [
        'user_id',
        'balance',

    ];
	
	
	function updatebalance($user_id,$amount,$type)
	{
		$db = \Config\Database::connect();
				$this->builder = $db->table('user_wallet'); 
				$this->builder->select('balance,id');
				$this->builder->where('user_id', $user_id);
				$result = $this->builder->get();
				$userwallet=$result->getRow();
			
				if(!empty($userwallet))
				{
					if($type=='credit')
					{
						$total_balance=$userwallet->balance+$amount;
					}else{
						$total_balance=$userwallet->balance-$amount;
					}
					$this->builder->set('balance', $total_balance);
					$this->builder->where('id', $userwallet->id);
					$this->builder->update();
				}
				
	}
}