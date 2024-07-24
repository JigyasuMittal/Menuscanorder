<?php namespace App\Controllers;

use App\Models\OrderModel;

class OrderController extends BaseController
{
    public function placeOrder()
    {
       // $session = session();
      //  $userId = $session->get('user_id'); // Get user ID from session
        $userId = $this->request->getGet('user_id'); // Retrieve the user_id from the query parameter

        log_message('info', 'User ID in placeOrder: ' . $userId); // Log the user ID for debugging

        $jsonData = $this->request->getJSON();
        log_message('info', 'Order Details: ' . json_encode($jsonData)); // Log order details for debugging

        $orderModel = new OrderModel();
        $result = $orderModel->insertOrder($jsonData->table_id, $jsonData->items, $jsonData->instructions, $userId);

        if ($result) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Order placed successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to place order']);
        }
    }

    public function getOrderStatus()
    {
       // $session = session();
      //  $userId = $session->get('user_id'); // Get user ID from session
        $userId = $this->request->getGet('user_id'); // Retrieve the user_id from the query parameter

        $tableId = $this->request->getVar('table_id');

        log_message('info', 'User ID in getOrderStatus: ' . $userId); // Log the user ID for debugging
        log_message('info', 'Table ID in getOrderStatus: ' . $tableId); // Log the table ID for debugging

        $orderModel = new OrderModel();
        $orders = $orderModel->where('table_id', $tableId)
                             ->where('user_id', $userId)
                             ->findAll();

        if ($orders) {
            return $this->response->setJSON(['status' => 'success', 'orders' => $orders]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No orders found']);
        }
    }
}
