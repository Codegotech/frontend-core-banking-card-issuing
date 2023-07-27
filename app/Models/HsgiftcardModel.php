<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class HsgiftcardModel extends Model{
    protected $table = 'hs_giftcards';
    
    protected $allowedFields = [
        'user_id',
        'email',
        'amount',
        'phone',
        'access_code',
        'user_id',
        'created',
        'giftcard_id',
        'is_read',
        'status',
    ];
}