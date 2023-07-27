<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserwalletlogsModel extends Model{
    protected $table = 'user_wallet_logs';
    
    protected $allowedFields = [
        'user_id',
        'amount',
        'description',
        'transaction_id',
        'created'
    ];
}