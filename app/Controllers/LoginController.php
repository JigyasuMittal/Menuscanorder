<?php

namespace App\Controllers;

use App\Models\RestaurantOwnerModel;

class LoginController extends BaseController
{
    public function index()
    {        return view('login');

       

    }

    public function authenticate()
    {
        $model = new RestaurantOwnerModel();
    
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $userId = $this->request->getPost('user_id');
    
        $user = $model->where('email', $email)->where('user_id', $userId)->first();
    
        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['user_id'],
                'isLoggedIn' => true
            ]);
    
            return redirect()->to('../'); 
        } else {
            session()->setFlashdata('error', 'User ID, email or password is incorrect.');
            return redirect()->back(); 
        }
    }
    
    public function logout()
    {
        session()->destroy();  
        return redirect()->to('../login');  
    }
}
