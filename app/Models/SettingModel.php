<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class SettingModel extends Model{
    protected $table = 'settings';
    
    protected $allowedFields = [
        'id',
        'auth_token',
        'created'
    ];
}