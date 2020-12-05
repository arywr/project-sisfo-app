<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug_nama', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'no_telp', 'orang_tua_asuh'];

    public function getSiswa($slug_nama = false)
    {
        if ($slug_nama == false) {
            return $this->findAll();
        }
        return $this->where(['slug_nama' => $slug_nama])->first();
    }

    public function searchSiswa($keyword)
    {
        $builder = $this->table('siswa');
        $builder->like('nama', $keyword);
        $builder->orLike('nisn', $keyword);
        $builder->orLike('tempat_lahir', $keyword);
        $builder->orLike('tanggal_lahir', $keyword);
        $builder->orLike('jenis_kelamin', $keyword);
        $builder->orLike('agama', $keyword);
        $builder->orLike('alamat', $keyword);
        $builder->orLike('no_telp', $keyword);
        $builder->orLike('orang_tua_asuh', $keyword);
        return $builder;
    }

    public function countResult($keyword = false)
    {
        if ($keyword == false) {
            return $this->countAll();
        }
        $builder = $this->searchSiswa($keyword);
        return $builder->countAllResults();
    }
}
