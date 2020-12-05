<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table = 'guru';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug_nama', 'nip', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'no_telp', 'user_id'];

    public function getUserbyId($id)
    {
        return $this->db->table('guru')
            ->join('user', 'user.user_id = guru.user_id')
            ->join('user_role', 'user_role.role_id = user.role_id')
            ->where('guru.user_id', $id)
            ->get()->getRowArray();
    }

    public function searchGuru($keyword)
    {
        $builder = $this->table('guru');
        $builder->like('nama', $keyword);
        $builder->orLike('nip', $keyword);
        $builder->orLike('tempat_lahir', $keyword);
        $builder->orLike('tanggal_lahir', $keyword);
        $builder->orLike('jenis_kelamin', $keyword);
        $builder->orLike('agama', $keyword);
        $builder->orLike('alamat', $keyword);
        $builder->orLike('no_telp', $keyword);
        return $builder;
    }

    public function countGuru($keyword = false)
    {
        if ($keyword == false) {
            return $this->countAll();
        }
        $builder = $this->searchGuru($keyword);
        return $builder->countAllResults();
    }

    public function getGuru($slug_nama = false)
    {
        if ($slug_nama == false) {
            return $this->findAll();
        }
        return $this->where(['slug_nama' => $slug_nama])->first();
    }

    public function getGurubyId($id)
    {
        return $this->where(['id' => $id])->first();
    }


    // public function getUserbyId($id)
    // {
    //     $builder = $this->table('guru');
    //     $builder->join('user', 'user.user_id = guru.user_id');
    //     $builder->where(['guru.user_id' => $id])->first();
    //     return $builder->get()->getRowArray();
    // }

    // public function getUser($username = false, $email = false)
    // {
    //     return $this->where(['username' => $username])->first();
    // }

    // public function getUserbyEmail($email)
    // {
    //     return $this->where(['email' => $email])->first();
    // }

    // public function getGurubyId($id)
    // {
    //     return $this->where(['id' => $id])->first();
    // }

    // public function getGuru($slug_nama = false)
    // {
    //     if ($slug_nama == false) {
    //         return $this->findAll();
    //     }
    //     return $this->where(['slug_nama' => $slug_nama])->first();
    // }

    // public function searchGuru($keyword)
    // {
    //     $builder = $this->table('guru');
    //     $builder->like('nama', $keyword);
    //     $builder->orLike('nip', $keyword);
    //     $builder->orLike('tempat_lahir', $keyword);
    //     $builder->orLike('tanggal_lahir', $keyword);
    //     $builder->orLike('jenis_kelamin', $keyword);
    //     $builder->orLike('agama', $keyword);
    //     $builder->orLike('alamat', $keyword);
    //     $builder->orLike('no_telp', $keyword);
    //     return $builder;
    // }

    // public function countUser()
    // {
    //     $builder = $this->table('guru');
    //     $builder->where('is_active', 1);
    //     return $builder->countAllResults();
    // }

    // public function countResult($keyword = false)
    // {
    //     if ($keyword == false) {
    //         return $this->countAll();
    //     }
    //     $builder = $this->searchGuru($keyword);
    //     return $builder->countAllResults();
    // }
}
