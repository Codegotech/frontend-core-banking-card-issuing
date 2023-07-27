<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class PrepaidModel extends Model{
    protected $table = 'prepaid_cards';
    
    protected $allowedFields = [
        'user_id',
        'card_id',
        'created',
        'pin',
        'is_lock',
        'status',
    ];
}