<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTanggapan extends Model
{
    public function AllDataMasyarakat($nik)
    {
        $db = $this->db->table('tanggapan');
        $db->select('tanggapan.id_tanggapan, tanggapan.id_pengaduan, pengaduan.tgl_pengaduan, tanggapan.tgl_tanggapan, pengaduan.nik, masyarakat.nama, pengaduan.foto, pengaduan.isi_laporan, tanggapan.tanggapan, tanggapan.id_petugas, petugas.nama_petugas, pengaduan.status');
        $db->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan', 'left');
        $db->join('petugas', 'petugas.id_petugas = tanggapan.id_petugas', 'left');
        $db->join('masyarakat', 'masyarakat.nik = pengaduan.nik', 'left');
        $db->where(['pengaduan.nik' => $nik]);
        return $db->get()->getResultArray();
    }

    public function AllDataPetugas()
    {
        $db = $this->db->table('tanggapan');
        $db->select('tanggapan.id_tanggapan, tanggapan.id_pengaduan, pengaduan.tgl_pengaduan, tanggapan.tgl_tanggapan, pengaduan.nik, masyarakat.nama, pengaduan.foto, pengaduan.isi_laporan, tanggapan.tanggapan, tanggapan.id_petugas, petugas.nama_petugas, pengaduan.status');
        $db->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan', 'left');
        $db->join('petugas', 'petugas.id_petugas = tanggapan.id_petugas', 'left');
        $db->join('masyarakat', 'masyarakat.nik = pengaduan.nik', 'left');
        return $db->get()->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tanggapan')->insert($data);
    }
}