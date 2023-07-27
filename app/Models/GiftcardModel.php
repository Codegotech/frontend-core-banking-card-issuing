<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class GiftcardModel extends Model{
    protected $table = 'giftcards';
    
    protected $allowedFields = [
        'user_id',
        'email',
        'amount',
        'access_code',
        'user_id',
        'created',
        'giftcard_id',
        'is_read',
        'status',
    ];
}