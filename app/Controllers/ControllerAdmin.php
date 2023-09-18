<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMasyarakat;
use App\Models\ModelPetugas;

class ControllerAdmin extends BaseController
{
    public function __construct()
    {
        $this->ModelMasyarakat = new ModelMasyarakat();
        $this->ModelPetugas = new ModelPetugas();
    }

    public function index()
    {
        $data = [
            'judul' => 'Data Admin',
            'menu' => 'admin',
            'page' => 'petugas/user/v_admin',
            'user' => $this->ModelMasyarakat->AllData(),
            'admin' => $this->ModelPetugas->AllData(),
        ];
        return view('petugas/v_template', $data);
    }

    public function InsertData()
    {
        $data = [
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'telp' => $this->request->getPost('telp'),
            'level' => $this->request->getPost('level'),
        ];

        $this->ModelPetugas->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        return redirect()->to('/admin');
    }

    public function UpdateData($id_petugas)
    {
        $data = [
            'id_petugas' => $id_petugas,
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'telp' => $this->request->getPost('telp'),
            'level' => $this->request->getPost('level'),
        ];

        $this->ModelPetugas->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to('/admin');
    }

    public function DeleteData($id_petugas)
    {
        $data = [
            'id_petugas' => $id_petugas,
        ];

        $this->ModelPetugas->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to('/admin');
    }
}
