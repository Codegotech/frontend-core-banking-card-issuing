<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model{
    protected $table = 'users';
    
    protected $allowedFields = [
        'user_id',
        'name',
        'surname',
        'email',
        'phone_number',
        'country_of_residence',
        'nationality',
        'work_country',
        'income_soruce',
        'country_pay_tax',
        'gender',
        'tax_personal_number',
        'political_person',
        'status',
        'dob',
        'address',
        'zipcode',
        'city',
        'password',
        'created_at'
    ];
}