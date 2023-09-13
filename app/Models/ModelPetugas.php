<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPetugas extends Model
{
    public function AllData()
    {
        return $this->db->table('petugas')->get()->getResultArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('petugas')->where('id_petugas', $data['id_petugas'])->update($data);
    }

    public function LoginPetugas($username, $password)
    {
        return $this->db->table('petugas')
            ->where([
                'username' => $username,
                'password' => $password,
            ])->get()->getRowArray();
    }
}
