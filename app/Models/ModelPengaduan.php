<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengaduan extends Model
{
    public function AllDataMasyarakat($nik)
    {
        $db = $this->db->table('pengaduan');
        $db->select('pengaduan.id_pengaduan');
        $db->select('pengaduan.tgl_pengaduan');
        $db->select('pengaduan.nik');
        $db->select('pengaduan.isi_laporan');
        $db->select('masyarakat.nama');
        $db->select('pengaduan.foto');
        $db->select('pengaduan.status');
        $db->join('masyarakat', 'masyarakat.nik = pengaduan.nik', 'left'); // Join tabel masyarakat
        $db->where(['pengaduan.nik' => $nik]);
        return $db->get()->getResultArray();
    }

    public function AllDataPetugas()
    {
        $db = $this->db->table('pengaduan');
        $db->select('pengaduan.id_pengaduan');
        $db->select('pengaduan.tgl_pengaduan');
        $db->select('pengaduan.nik');
        $db->select('pengaduan.isi_laporan');
        $db->select('masyarakat.nama');
        $db->select('pengaduan.foto');
        $db->select('pengaduan.status');
        $db->join('masyarakat', 'masyarakat.nik = pengaduan.nik', 'left'); // Join tabel masyarakat
        return $db->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('pengaduan')->insert($data);
    }

    public function UpdateStatus($dataa)
    {
        $this->db->table('pengaduan')->update($dataa);
    }

    public function UpdateData($data)
    {
        $this->db->table('pengaduan')->where('id_pengaduan', $data['id_pengaduan'])->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('pengaduan')->where('id_pengaduan', $data['id_pengaduan'])->delete($data);
    }
}
