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
    public function InsertData($id_pengaduan)
    {
        $data = [
            'id_pengaduan' => $id_pengaduan,
            'tgl_tanggapan' => date('Y-m-d H:i:s'),
            'tanggapan' => $this->request->getPost('tanggapan'),
            'id_petugas' => session()->get('id_petugas'),
            'status' => '1',
        ];

        $dataa = [
            'id_pengaduan' => $id_pengaduan,
            'status' => '1',
        ];

        $this->ModelPengaduan->UpdateStatus($dataa);
        $this->ModelTanggapan->InsertData($data);
        session()->setFlashdata('pesan', 'Tanggapan berhasil ditambahkan');
        return redirect()->to(base_url('/tanggapan-admin'));
    }

    public function ApplyData($id_tanggapan)
    {
        $data = [
            'id_tanggapan' => $id_tanggapan,
            'status' => '2',
        ];

        $dataa = [
            'id_pengaduan' => $this->request->getGet('id_pengaduan'),
            'status' => '2',
        ];

        $this->ModelPengaduan->UpdateStatus($dataa);
        $this->ModelTanggapan->ApplyData($data);
        session()->setFlashdata('pesan', 'Laporan Selesai!!');
        return redirect()->to('/tanggapan-admin');
    }

    public function DeleteData($id_tanggapan)
    {
        $data = [
            'id_tanggapan' => $id_tanggapan,
        ];

        $dataa = [
            'id_pengaduan' => $this->request->getGet('id_pengaduan'),
        ];

        $this->ModelPengaduan->DeleteDataa($dataa);
        $this->ModelTanggapan->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to('/tanggapan');
    }

    public function GenerateLaporan($id_tanggapan)
    {
        $data = [
            'id_tanggapan' => $id_tanggapan,
            'tanggapanPetugas' => $this->ModelTanggapan->GenerateLaporan($id_tanggapan),
        ];
        return view('petugas/tanggapan/v_cetak', $data);
    }
}
