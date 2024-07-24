<?php

namespace App\Controllers;

use App\Models\MenuModel;

class YourMenuController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id'); // Retrieve user ID from session

        $model = new MenuModel();
        $userMenuItems = $model->where('user_id', $userId)->findAll(); // Fetch only user's menu items

        $menu_items = [];
        foreach ($userMenuItems as $item) {
            $menu_items[$item['category']][] = $item;
        }

        $data['menu_items'] = $menu_items;
        return view('menu/Yourmenu', $data);
    }

    public function addItem()
    {
        $session = session();
        $userId = $session->get('user_id'); // Get user ID from session

        $model = new MenuModel();

        $data = [
            'item_id' => $this->request->getPost('item_id'), // Include item_id from the form
            'user_id' => $userId, // Use logged-in user's ID
            'item_name' => $this->request->getPost('item_name'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
        ];

        

        try {
            $result = $model->insert($data);
            if ($result === false) {
                $errors = $model->errors();
                log_message('error', 'Insertion failed: ' . print_r($errors, true));
                return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Failed to add item', 'errors' => $errors]);
            } else {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Item added successfully']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception caught in addTable: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()]);
        }

    }

    public function deleteItem()
    {
        $model = new MenuModel();
        $item_id = $this->request->getPost('item_id');
        
        if (!is_null($item_id)) {
            if ($model->delete($item_id)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Item deleted successfully.']);
            } else {
                return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Could not delete the item.']);
            }
        } else {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'No item ID provided.']);
        }
    }

    public function getItemDetails()
    {
        $model = new MenuModel();
        $item_id = $this->request->getVar('item_id'); // or getGet('item_id') for GET requests
        
        $item = $model->find($item_id);
        
        if ($item) {
            return $this->response->setJSON(['status' => 'success', 'data' => $item]);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['status' => 'error', 'message' => 'Item not found']);
        }
    }

    public function modifyItem()
    {
        $model = new MenuModel();
        $item_id = $this->request->getPost('item_id');
        
        $data = [
            'item_name' => $this->request->getPost('item_name'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category')
        ];

        if ($model->update($item_id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Item updated successfully']);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Could not update the item']);
        }
    }
}
