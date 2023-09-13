<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMasyarakat extends Model
{
    public function AllData()
    {
        return $this->db->table('masyarakat')->get()->getResultArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('masyarakat')->where('id', $data['id'])->update($data);
    }

    public function Save_Register($data)
    {
        $this->db->table('masyarakat')->insert($data);
    }

    public function LoginUser($username, $password)
    {
        return $this->db->table('masyarakat')
            ->where([
                'username' => $username,
                'password' => $password,
            ])->get()->getRowArray();
    }
}
