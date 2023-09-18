<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMasyarakat;
use App\Models\ModelPetugas;

class ControllerUser extends BaseController
{
    public function __construct()
    {
        $this->ModelMasyarakat = new ModelMasyarakat();
        $this->ModelPetugas = new ModelPetugas();
    }

    public function index()
    {
        $data = [
            'judul' => 'Data User',
            'menu' => 'user',
            'page' => 'petugas/user/v_user',
            'user' => $this->ModelMasyarakat->AllData(),
            'petugas' => $this->ModelPetugas->AllData(),
        ];
        return view('petugas/v_template', $data);
    }

    public function UpdateData($id)
    {
        $data = [
            'id' => $id,
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'telp' => $this->request->getPost('telp'),
        ];

        $this->ModelMasyarakat->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to('ControllerUser');
    }

    public function DeleteData($id)
    {
        $data = [
            'id' => $id,
        ];

        $this->ModelMasyarakat->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to('ControllerUser');
    }
}
