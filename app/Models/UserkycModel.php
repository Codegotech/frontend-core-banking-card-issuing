<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserkycModel extends Model{
    protected $table = 'user_kyc';
    
    protected $allowedFields = [
        'user_id',
        'document_id',
        'document_name',
        'document_type',
        'status',
        'created',
        'document_number'
    ];
	
	public function updateKycStatus(int $user_id, string $document_name, string $status) {
				$db = \Config\Database::connect();
				$this->builder = $db->table('user_kyc'); 
				$this->builder->select('id');
				$this->builder->where('document_name', $document_name);
				$this->builder->where('user_id', $user_id);
				$result = $this->builder->get();
				$kyc_status_info=$result->getRow();
				if(!empty($kyc_status_info))
				{
					$this->builder->set('status', $status);
					$this->builder->where('id', $kyc_status_info->id);
					$this->builder->update();
					//echo $db->getLastQuery();
				}
				return $kyc_status_info->id;

	}
}