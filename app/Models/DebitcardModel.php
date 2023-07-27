<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class DebitcardModel extends Model{
    protected $table = 'debit_cards';
    
    protected $allowedFields = [
        'user_id',
        'card_id',
        'created',
        'pin',
        'is_lock',
        'status',
    ];
}