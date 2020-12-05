<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $userTimestamps = true;
    protected $allowedFields = ['username', 'email', 'password', 'role_id', 'waktu_dibuat'];

    public function getUser($username)
    {
        return $this->db->table('user')
            ->where('username', $username)
            ->get()->getRowArray();
    }

    public function countUser()
    {
        return $this->countAllResults();
    }

    public function getUserbyEmail($email)
    {
        return $this->db->table('user')
            ->where('email', $email)
            ->get()->getRowArray();
    }

    public function updatePassword($id, $password)
    {
        $data = [
            'password' => $password
        ];

        return $this->db->table('user')
            ->where('user_id', $id)
            ->update($data);
    }

    public function insertToken($id, $token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_token');

        $data = [
            'user_id' => $id,
            'token' => $token,
            'is_active' => 0,
            'created_at' => Time::now()
        ];
        return $builder->insert($data);
    }

    public function getToken($token)
    {
        $db = \Config\Database::connect();

        return $db->table('user_token')
            ->where('token', $token)
            ->get()->getRowArray();
    }

    public function updateToken($id)
    {
        $data = [
            'is_active' => 1
        ];

        $db = \Config\Database::connect();
        return $db->table('user_token')
            ->where('user_id', $id)
            ->update($data);
    }
}
// {
//     protected $table = 'user';
//     protected $useTimestamps = true;
//     protected $allowedFields = ['nama', 'slug_nama', 'nip', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'no_telp', 'username', 'email', 'password', 'role_id', 'is_active'];

//     public function getUser($username = false, $email = false)
//     {
//         return $this->where(['username' => $username])->first();
//     }

//     public function getUserbyEmail($email)
//     {
//         return $this->where(['email' => $email])->first();
//     }

//     public function getGurubyId($id)
//     {
//         return $this->where(['id' => $id])->first();
//     }

//     public function getGuru($slug_nama = false)
//     {
//         if ($slug_nama == false) {
//             return $this->findAll();
//         }
//         return $this->where(['slug_nama' => $slug_nama])->first();
//     }

//     public function searchGuru($keyword)
//     {
//         $builder = $this->table('guru');
//         $builder->like('nama', $keyword);
//         $builder->orLike('nip', $keyword);
//         $builder->orLike('tempat_lahir', $keyword);
//         $builder->orLike('tanggal_lahir', $keyword);
//         $builder->orLike('jenis_kelamin', $keyword);
//         $builder->orLike('agama', $keyword);
//         $builder->orLike('alamat', $keyword);
//         $builder->orLike('no_telp', $keyword);
//         return $builder;
//     }

//     public function countUser()
//     {
//         $builder = $this->table('guru');
//         $builder->where('is_active', 1);
//         return $builder->countAllResults();
//     }

//     public function countResult($keyword = false)
//     {
//         if ($keyword == false) {
//             return $this->countAll();
//         }
//         $builder = $this->searchGuru($keyword);
//         return $builder->countAllResults();
//     }
// }
