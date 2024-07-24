<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantOwnerModel extends Model
{
    protected $table = 'restaurant';
    protected $allowedFields = ['user_id','name', 'email', 'contact', 'password'];
    

    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
