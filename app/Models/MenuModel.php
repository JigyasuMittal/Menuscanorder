<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'item_id';
    protected $allowedFields = ['item_id', 'user_id', 'item_name', 'price', 'description', 'category'];
}
