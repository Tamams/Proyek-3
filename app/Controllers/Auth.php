<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            $session->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);
            
            // Logika pengalihan berdasarkan peran (role)
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}