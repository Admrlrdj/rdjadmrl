<?php

namespace App\Controllers;

use App\Models\ModelMasyarakat;
use App\Models\ModelPetugas;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelMasyarakat = new ModelMasyarakat();
        $this->ModelPetugas = new ModelPetugas();
    }

    public function index()
    {
        return view('v_login');
    }

    public function Register()
    {
        return view('v_register');
    }

    public function CekLogin()
    {
        if (
            $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Masih Kosong!!'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Masih Kosong!!'
                    ]
                ],
            ])
        ) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelMasyarakat->LoginUser($username, $password);
            $cek_login_petugas = $this->ModelPetugas->LoginPetugas($username, $password);
            if ($cek_login) {
                session()->set('id', $cek_login['id']);
                session()->set('nik', $cek_login['nik']);
                session()->set('nama', $cek_login['nama']);
                session()->set('username', $cek_login['username']);
                session()->set('password', $cek_login['password']);
                session()->set('telp', $cek_login['telp']);
                return redirect()->to(base_url('/profile'));
            } elseif ($cek_login_petugas) {
                session()->set('id_petugas', $cek_login_petugas['id_petugas']);
                session()->set('nama_petugas', $cek_login_petugas['nama_petugas']);
                session()->set('username', $cek_login_petugas['username']);
                session()->set('password', $cek_login_petugas['password']);
                session()->set('telp', $cek_login_petugas['telp']);
                session()->set('level', $cek_login_petugas['level']);
                if ($cek_login_petugas['level'] == 'admin') {
                    return redirect()->to(base_url('/profile-admin'));
                } else {
                    return redirect()->to(base_url('/profile-admin'));
                }
            } else {
                session()->setFlashdata('gagal', 'Username atau Password Salah!!');
                return redirect()->to(base_url(''));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url(''))->withInput('validation', \Config\Services::validation());
        }
    }

    public function SaveRegister()
    {
        if ($this->validate([
            'nik' => [
                'label' => 'NIK',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!'
                ]
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!'
                ]
            ],
            'repassword' => [
                'label' => 'Retype Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} Wajid Diisi!!',
                    'matches' => '{field} Tidak Sama dengan Password!!'
                ]
            ],
            'telp' => [
                'label' => 'No. Telepon',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!'
                ]
            ],
        ])) {
            $data = [
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'telp' => $this->request->getPost('telp')
            ];
            $this->ModelMasyarakat->Save_Register($data);
            session()->setFlashdata('pesan', 'Registrasi Berhasil');
            return redirect()->to(base_url(''));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/register'));
        }
    }

    public function Logout()
    {
        session()->remove('id');
        session()->remove('nik');
        session()->remove('nama');
        session()->remove('username');
        session()->remove('password');
        session()->remove('telp');
        session()->setFlashdata('pesan', 'Berhasil Logout');
        return redirect()->to(base_url(''));
    }
}
