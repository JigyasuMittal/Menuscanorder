<?php namespace App\Controllers;

use App\Models\MenuModel;

class MenuDisplayController extends BaseController
{
    public function displayMenu()
    {
        $tableId = $this->request->getGet('table');
        $userId = $this->request->getGet('user_id'); // Retrieve the user_id from the query parameter
      //  log_message('info', 'Table IDddd: ' . $tableId . ', User ID: ' . $userId);
    
        $menuModel = new MenuModel();
        $allItems = $menuModel->where('user_id', $userId)->findAll(); // Fetch only items that belong to the specific user
    
        $menu_items = [];
        foreach ($allItems as $item) {
            $menu_items[$item['category']][] = $item;
        }
    
        return view('menudisplay', [
            'menu_items' => $menu_items,
            'tableId' => $tableId,
            'userId' => $userId // Add this line
        ]);
    }
    
}
