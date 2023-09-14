<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMasyarakat;
use App\Models\ModelPengaduan;
use App\Models\ModelPetugas;
use App\Models\ModelTanggapan;

class ControllerTanggapan extends BaseController
{
    public function __construct()
    {
        $this->ModelPengaduan = new ModelPengaduan();
        $this->ModelMasyarakat = new ModelMasyarakat();
        $this->ModelTanggapan = new ModelTanggapan();
        $this->ModelPetugas = new ModelPetugas();
    }

    public function index()
    {
        $nik = session()->get('nik');
        $data = [
            'judul' => 'Tanggapan',
            'menu' => 'tanggapan',
            'page' => 'masyarakat/tanggapan/v_tanggapan',
            'tanggapan' => $this->ModelTanggapan->AllDataMasyarakat($nik),
            'pengaduan' => $this->ModelPengaduan->AllDataMasyarakat($nik),
            'profile' => $this->ModelMasyarakat->AllData(),
        ];
        return view('masyarakat/v_template', $data);
    }

    public function PetugasIndex()
    {
        $data = [
            'judul' => 'Tanggapan',
            'menu' => 'tanggapan',
            'page' => 'petugas/tanggapan/v_tanggapan',
            'tanggapanPetugas' => $this->ModelTanggapan->AllDataPetugas(),
            'pengaduanPetugas' => $this->ModelPengaduan->AllDataPetugas(),
            'profile' => $this->ModelPetugas->AllData(),
        ];
        return view('petugas/v_template', $data);
    }
    public function InsertData()
    {
        $data = [
            'id_pengaduan' => $this->request->getPost('id_pengaduan'), // Gunakan 'id_pengaduan' dari input tersembunyi
            'tgl_tanggapan' => date('Y-m-d H:i:s'),
            'tanggapan' => $this->request->getPost('tanggapan'),
            'status' => '1',
            'id_petugas' => session()->get('id_petugas'),
        ];

        $dataa = [
            'status' => '1',
        ];


        $this->ModelPengaduan->UpdateStatus($dataa);
        $this->ModelTanggapan->InsertData($data);
        session()->setFlashdata('pesan', 'Tanggapan berhasil ditambahkan');
        return redirect()->to(base_url('ControllerTanggapan/PetugasIndex'));
    }

    public function ApplyData($id_tanggapan)
    {
        $data = [
            'id_tanggapan' => $id_tanggapan,
            'status' => '2',
        ];

        $dataa = [
            'status' => '2',
        ];

        $this->ModelPengaduan->UpdateStatus($dataa);
        $this->ModelTanggapan->ApplyData($data);
        session()->setFlashdata('pesan', 'Laporan Selesai!!');
        return redirect()->to('ControllerTanggapan');
    }
}
