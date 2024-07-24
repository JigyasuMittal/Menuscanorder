<?php

namespace App\Controllers;

use App\Models\TableModel;

class TableController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id'); // Retrieve user ID from session

        $model = new TableModel();
        $userTables = $model->where('user_id', $userId)->findAll(); // Fetch only user's tables
        $data['tables'] = $userTables;
        return view('table', $data);
    }
    public function addTable()
    {
        $session = session();
        $userId = $session->get('user_id'); // Get user ID from session
    
        $model = new TableModel();
    
        $tableNumber = $this->request->getPost('table_number');
    
        $url = "https://infs3202-22eef1ad.uqcloud.net/menuscanorder/menudisplay?table=" . $tableNumber . "&user_id=" . $userId;
        $qrCodeURL = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($url);
    
        $data = [
            'table_id' => $tableNumber,
            'user_id'  => $userId, // Use logged-in user's ID
            'qr_code'  => $qrCodeURL
        ];
    
        try {
            $result = $model->insert($data);
            if ($result === false) {
                $errors = $model->errors();
                log_message('error', 'Insertion failed: ' . print_r($errors, true));
                return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Failed to add table', 'errors' => $errors]);
            } else {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Table added successfully', 'qr_code' => $qrCodeURL]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception caught in addTable: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()]);
        }
    }
    
    

}