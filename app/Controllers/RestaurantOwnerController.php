<?php

namespace App\Controllers;

use App\Models\RestaurantOwnerModel;

class RestaurantOwnerController extends BaseController
{
    public function signup()
    {
        return view('signup');
    }

    public function store()
    {
        $model = new RestaurantOwnerModel();
    
        $userId = $this->request->getPost('user_id');
        $email = $this->request->getPost('email');
    
        // Check if user ID or email already exists
        if ($model->where('user_id', $userId)->first() || $model->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('error', 'User ID or Email already exists. Please use another.');
        }
    
        $data = [
            'user_id' => $userId,
            'name' => $this->request->getPost('name'),
            'email' => $email,
            'contact' => $this->request->getPost('contact'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
    
        if ($model->save($data)) {
            return redirect()->to('/login');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }
    
}
