<?php namespace App\Controllers;

use App\Models\OrderModel;

class KitchenController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id'); // Retrieve the user ID from the session
        
        $orderModel = new OrderModel();
        $allOrders = $orderModel->where('user_id', $userId)->findAll(); // Fetch orders for the logged-in user

        $tables = []; // Initialize an empty array to store orders grouped by table_id
        foreach ($allOrders as $order) {
            $tables[$order['table_id']][] = $order; // Group orders by table_id
        }

        return view('kitchen_view', ['tables' => $tables]);
    }

    public function updateStatus()
    {
        $session = session();
        $userId = $session->get('user_id');
        $orderId = $this->request->getPost('order_id');
        $status = $this->request->getPost('status');
        
        $orderModel = new OrderModel();
        $order = $orderModel->where('order_id', $orderId)
                            ->where('user_id', $userId)
                            ->first();
    
        if ($order) {
            $result = $orderModel->update($orderId, ['status' => $status]);
            if ($result) {
                return $this->response->setJSON(['success' => true]);
            } else {
                log_message('error', 'Failed to update order status for Order ID: ' . $orderId);
                return $this->response->setJSON(['success' => false, 'message' => 'Database update failed']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized or non-existent order']);
        }
    }
    
    
    public function bumpTable()
    {
        $session = session();
        $userId = $session->get('user_id'); // Retrieve the user ID from the session
        $tableId = $this->request->getPost('table_id');
        
        $orderModel = new OrderModel();
    
        $orders = $orderModel->where('table_id', $tableId)
                             ->where('user_id', $userId)
                             ->findAll();
    
        if (!empty($orders)) {
            if ($orderModel->where('table_id', $tableId)->where('user_id', $userId)->delete()) {
                return $this->response->setJSON(['success' => true, 'message' => 'All orders for table cleared']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to clear orders for table']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'No orders found or unauthorized action']);
        }
    }
    
    
}
