<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel, $email;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        if (session('username')) {
            return redirect()->to(previous_url());
        }
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function login()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username atau Email belum diisi!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password belum diisi!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/Auth'))->withInput()->with('validation', $validation->getErrors());
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = $this->userModel->getUser($username);
        if ($user) {
            if ($password == $user['password']) {
                $data = [
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                session()->set($data);

                return redirect()->to(base_url('/Home'));
            } else {
                session()->setFlashdata('gagal', 'Password Salah!');

                return redirect()->to(base_url('/Auth'));
            }
        } else {
            session()->setFlashdata('gagal', 'User tidak terdaftar pada sistem!');

            return redirect()->to(base_url('/Auth'));
        }
        return redirect()->to(base_url('/Auth'));
    }

    public function forgetPassword()
    {
        $data = [
            'title' => 'Lupa Password',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/forget-password', $data);
    }

    public function submitPassword()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Username belum diisi!',
                    'valid_email' => 'Email tidak valid!',
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/Auth/forgetPassword'))->withInput()->with('validation', $validation->getErrors());
        }
        $email = $this->request->getVar('email');
        $user = $this->userModel->getUserbyEmail($email);
        if ($user) {
            $id = $user['user_id'];
            $token = base64_encode(random_bytes(32));
            $title = '<h3>Reset Password SISFO</h3>
        Silahkan Klik link berikut untuk melakukan verifikasi selanjutnya : 
            <a href="' . base_url() . '/Auth/resetPassword?email=' . $email . '&token=' . urlencode($token) . '">Reset Password</a>';
            $message = "Notifikasi Reset Password SISFO";
            $to = $email;

            $this->userModel->insertToken($id, $token);

            $this->email->setFrom('arya.wahyu502@gmail.com', 'aryawahyu');
            $this->email->setTo($to);
            $this->email->setSubject($message);
            $this->email->setMessage($title);
            if ($this->email->send()) {
                session()->setFlashdata('berhasil', 'Reset Password berhasil! Silahkan cek email anda yang didaftarkan pada sistem');
            } else {
                session()->setFlashdata('gagal', 'Gagal mengirim notifikasi ke email!');
            }
            return redirect()->to(base_url('/Auth'));
        } else {
            session()->setFlashdata('gagal', 'User dengan email ' . $email . ' tidak terdaftar pada sistem!');
            return redirect()->to(base_url('/Auth/forgetPassword'));
        }
    }

    public function resetPassword()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $user = $this->userModel->getUserbyEmail($email);

        if ($user) {
            $user_token = $this->userModel->getToken($token);
            if ($user_token) {
                if ($user_token['is_active'] == 1) {
                    session()->setFlashdata('gagal', 'Reset password gagal! Token sudah diaktifkan');

                    return redirect()->to(base_url('/Auth'));
                } else {
                    session()->set('email', $email);
                    session()->set('username', $user['username']);
                    return redirect()->to(base_url('/Auth/changePassword'));
                }
            } else {
                session()->setFlashdata('gagal', 'Reset password gagal! Token salah');

                return redirect()->to(base_url('/Auth'));
            }
        } else {
            session()->setFlashdata('gagal', 'Reset password gagal! Email salah');

            return redirect()->to(base_url('/Auth'));
        }
    }

    public function changePassword()
    {
        if (!session('email') || !session('username')) {
            return redirect()->to(base_url('/Auth'));
        }

        $data = [
            'title' => 'Ganti Password',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/change-password', $data);
    }

    public function confirmPassword()
    {
        if (!$this->validate([
            'password1' => [
                'rules' => 'required|matches[password2]',
                'errors' => [
                    'required' => 'Password 1 belum diisi!',
                    'matches' => 'Password tidak sama!'
                ]
            ], 'password2' => [
                'rules' => 'required|matches[password1]',
                'errors' => [
                    'required' => 'Password 2 belum diisi!',
                    'matches' => 'Password tidak sama!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/Auth/changePassword'))->withInput()->with('validation', $validation->getErrors());
        }
        $user = $this->userModel->getUserbyEmail(session('email'));

        $this->userModel->updatePassword($user['user_id'], $this->request->getVar('password1'));
        $this->userModel->updateToken($user['user_id']);

        session()->setFlashdata('berhasil', 'Password berhasil diganti!');
        unset($_SESSION['email'],
        $_SESSION['username']);
        return redirect()->to(base_url('/Auth'));
    }

    public function logout()
    {
        unset($_SESSION['user_id'],
        $_SESSION['username'],
        $_SESSION['email'],
        $_SESSION['role_id']);

        return redirect()->to(base_url('/Auth'));
    }
}
