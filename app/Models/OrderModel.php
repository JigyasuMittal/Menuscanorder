<?php namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';  // Change this to the actual primary key column name
    protected $allowedFields = ['table_id', 'item_name', 'qty', 'customer_instruction', 'status','user_id'];
    public function insertOrder($tableId, $items, $instructions,$userid)
    {
        $this->db->transStart();
        foreach ($items as $item => $details) {
            $data = [
                'table_id' => $tableId,
                'item_name' => $item,
                'qty' => $details->qty,
                'customer_instruction' => $instructions,
                'user_id'=> $userid
            ];
            $this->insert($data);
        }
        $this->db->transComplete();

        return $this->db->transStatus();
    }
    public function getOrders()
    {
        return $this->findAll();
    }
    public function getOrdersByTable($tableId)
    {
        return $this->where('table_id', $tableId)->findAll();
    }
    public function deleteOrdersByTable($tableId)
    {
        return $this->where('table_id', $tableId)->delete();
    }
    
}
