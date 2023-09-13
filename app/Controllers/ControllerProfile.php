<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMasyarakat;
use App\Models\ModelPetugas;

class ControllerProfile extends BaseController
{
    public function __construct()
    {
        $this->ModelMasyarakat = new ModelMasyarakat();
        $this->ModelPetugas = new ModelPetugas();
    }

    public function index()
    {
        $data = [
            'judul' => 'Profile',
            'menu' => 'profile',
            'page' => 'masyarakat/profile/v_profile',
            'profile' => $this->ModelMasyarakat->AllData(),
        ];
        return view('masyarakat/v_template', $data);
    }

    public function PetugasProfile()
    {
        $data = [
            'judul' => 'Profile',
            'menu' => 'profile',
            'page' => 'petugas/profile/v_profile',
            'profile' => $this->ModelPetugas->AllData(),
        ];
        return view('petugas/v_template', $data);
    }

    public function UpdateProfile($id)
    {
        if ($this->validate([
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
                'id' => $id,
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'telp' => $this->request->getPost('telp'),
            ];

            $this->ModelMasyarakat->UpdateData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
            return redirect()->to('ControllerProfile');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('ControllerProfil'));
        }
    }
}
