<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMasyarakat;
use App\Models\ModelPengaduan;

class ControllerPengaduan extends BaseController
{
    public function __construct()
    {
        $this->ModelPengaduan = new ModelPengaduan();
        $this->ModelMasyarakat = new ModelMasyarakat();
    }

    public function index()
    {
        $nik = session()->get('nik');
        $data = [
            'judul' => 'Pengaduan',
            'menu' => 'pengaduan',
            'page' => 'masyarakat/pengaduan/v_pengaduan',
            'pengaduan' => $this->ModelPengaduan->AllDataMasyarakat($nik),
        ];
        return view('masyarakat/v_template', $data);
    }

    public function PetugasIndex()
    {
        $data = [
            'judul' => 'Pengaduan',
            'menu' => 'pengaduan',
            'page' => 'petugas/pengaduan/v_pengaduan',
            'pengaduanPetugas' => $this->ModelPengaduan->AllDataPetugas(),
        ];
        return view('petugas/v_template', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih {field} terlebih dahulu.',
                    'max_size' => '{field} terlalu besar. Maksimum 1 MB.',
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'mime_in' => 'Format {field} harus berupa JPEG, JPG, atau PNG.',
                ]
            ],
        ])) {
            $file = $this->request->getFile('foto');

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads', $newName);

                $data = [
                    'nik' => $this->request->getPost('nik'),
                    'isi_laporan' => $this->request->getPost('isi_laporan'),
                    'foto' => $newName,
                    'status' => '0',
                ];
                $this->ModelPengaduan->InsertData($data);
                session()->setFlashdata('pesan', 'Upload Laporan Berhasil');
                return redirect()->to(base_url('/pengaduan'));
            } else {
                return redirect()->to(base_url('/pengaduan'))->with('errors', ['Gambar tidak dapat diunggah.']);
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/pengaduan'))->withInput();
        }
    }

    public function UpdateData($id_pengaduan)
    {
        $file = $this->request->getFile('foto');

        // Mengambil data lama berdasarkan ID pengaduan
        $dataLama = $this->ModelPengaduan->getDataById($id_pengaduan);

        if ($file !== null && $file->isValid() && !$file->hasMoved()) {
            // Menghapus foto lama jika ada
            if ($dataLama && !empty($dataLama['foto'])) {
                unlink('uploads/' . $dataLama['foto']);
            }

            // Mengunggah foto baru
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);

            $data = [
                'id_pengaduan' => $id_pengaduan,
                'nik' => $this->request->getPost('nik'),
                'isi_laporan' => $this->request->getPost('isi_laporan'),
                'foto' => $newName,
                'status' => '0',
            ];
            $this->ModelPengaduan->UpdateData($data);
            session()->setFlashdata('pesan', 'Edit Laporan Berhasil');
            return redirect()->to(base_url('/pengaduan'));
        } else {
            // Jika tidak ada file yang diunggah, pertahankan foto yang sudah ada
            $data = [
                'id_pengaduan' => $id_pengaduan,
                'nik' => $this->request->getPost('nik'),
                'isi_laporan' => $this->request->getPost('isi_laporan'),
                'status' => '0',
            ];
            $this->ModelPengaduan->UpdateData($data);
            session()->setFlashdata('pesan', 'Edit Laporan Berhasil');
            return redirect()->to(base_url('/pengaduan'));
        }
    }

    public function DeleteData($id_pengaduan)
    {
        $data = [
            'id_pengaduan' => $id_pengaduan,
        ];

        $this->ModelPengaduan->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to('/pengaduan');
    }
}
