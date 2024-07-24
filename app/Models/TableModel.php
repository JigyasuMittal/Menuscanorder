<?php namespace App\Models;

use CodeIgniter\Model;

class TableModel extends Model
{
    protected $table = 'tables';
    protected $primaryKey = 'table_id';
    protected $allowedFields = ['table_id', 'status', 'user_id','qr_code'];

    public function insertTable($data)
    {
        return $this->insert($data);
    }

    // Method to get all tables
    public function getTables()
    {
        return $this->findAll();
    }

}
