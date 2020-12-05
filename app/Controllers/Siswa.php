<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\UserModel;

class Siswa extends BaseController
{
	protected $userModel, $siswaModel;
	public function __construct()
	{
		$this->siswaModel = new SiswaModel();
		$this->userModel = new UserModel();
		$this->guruModel = new GuruModel();
	}

	public function index()
	{
		$currentPage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;
		$postPerPage = 10;
		$resultPage = $this->siswaModel->countResult();

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$resultPage = $this->siswaModel->countResult($keyword);
			$siswa = $this->siswaModel->searchSiswa($keyword);
		} else {
			$siswa = $this->siswaModel;
		}
		$data = [
			'title' => 'Sisfo - Daftar Siswa',
			'siswa' => $siswa->paginate($postPerPage, 'siswa'),
			'pager' => $this->siswaModel->pager,
			'currentPage' => $currentPage,
			'postPerPage' => $postPerPage,
			'resultPage' => $resultPage,
			'user' => $this->guruModel->getUserbyId(session('user_id')),
		];
		echo view('pages/siswa/dashboard-siswa', $data);
	}

	public function detailSiswa($slug_nama)
	{
		$data = [
			'title' => 'Sisfo - Detail Siswa',
			'siswa' => $this->siswaModel->getSiswa($slug_nama),
			'user' => $this->guruModel->getUserbyId(session('user_id'))
		];
		// Jika Data Siswa Tidak Ditemukan Di Database
		if (empty($data['siswa'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Siswa ' . $slug_nama . ' Tidak Ditemukan.');
		}

		return view('pages/siswa/detail-siswa', $data);
	}

	public function addSiswa()
	{

		$data = [
			'title' => 'Form Tambah Data Siswa',
			'validation' => \Config\Services::validation(),
			'user' => $this->guruModel->getUserbyId(session('user_id'))
		];
		d($data['validation']->getErrors());
		return view('pages/siswa/add-siswa', $data);
	}

	public function SaveSiswa()
	{
		if (!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama siswa harus diisi!'
				]
			],
			'nisn' => [
				'rules' => 'required|is_unique[siswa.nisn]',
				'errors' => [
					'required' => 'NISN siswa harus diisi!',
					'is_unique' => 'NISN siswa telah terdaftar!'
				]
			],
			'tempat' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'TTL belum lengkap!'
				]
			],
			'tanggal' => [
				'rules' => 'required'
			],
			'gender' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Jenis kelamin siswa harus diisi!'
				]
			],
			'agama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Agama harus diisi!'
				]
			],
			'alamat' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Alamat siswa harus diisi!'
				]
			],
			'notelp' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nomor telepon siswa harus diisi!'
				]
			],
			'orangtua' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama orang tua siswa harus diisi!'
				]
			]
		])) {

			$validation = \Config\Services::validation();
			return redirect()->to(base_url('/siswa/addSiswa'))->withInput()->with('validation', $validation->getErrors());
		}

		$slug_nama = url_title($this->request->getVar('nama'), '-', true);
		$splitDate = explode('-', $this->request->getVar('tanggal'));
		$tanggal_lahir = $splitDate[2] . ' ' . $this->convertMonth($splitDate[1]) . ' ' . $splitDate[0];
		$this->siswaModel->save([
			'nama' => $this->request->getVar('nama'),
			'slug_nama' => $slug_nama,
			'nisn' => $this->request->getVar('nisn'),
			'tempat_lahir' => $this->request->getVar('tempat'),
			'tanggal_lahir' => $tanggal_lahir,
			'jenis_kelamin' => $this->request->getVar('gender'),
			'agama' => $this->request->getVar('agama'),
			'alamat' => $this->request->getVar('alamat'),
			'no_telp' => $this->request->getVar('notelp'),
			'orang_tua_asuh' => $this->request->getVar('orangtua')
		]);
		session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');

		return redirect()->to(base_url('/Siswa'));
	}

	public function delete($id)
	{
		$this->siswaModel->delete($id);

		session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
		return redirect()->to(base_url('/Siswa'));
	}

	public function edit($slug_nama)
	{
		$siswa = $this->siswaModel->getSiswa($slug_nama);
		if (empty($siswa)) {
			return redirect()->to(base_url('/Siswa'));
		} else {
			$data = [
				'title' => 'Form Ubah Data Siswa',
				'validation' => \Config\Services::validation(),
				'siswa' => $siswa,
				'user' => $this->guruModel->getUserbyId(session('user_id'))
			];
			return view('pages/siswa/edit-siswa', $data);
		}
	}

	public function update($id)
	{
		$oldSiswa = $this->siswaModel->getSiswa($this->request->getVar('slug_nama'));
		if ($oldSiswa['nisn'] == $this->request->getVar('nisn')) {
			$rule_nisn = 'required';
		} else {
			$rule_nisn = 'required|is_unique[siswa.nisn]';
		}
		if (!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama siswa harus diisi!'
				]
			],
			'nisn' => [
				'rules' => $rule_nisn,
				'errors' => [
					'required' => 'NISN siswa harus diisi!',
					'is_unique' => 'NISN siswa telah terdaftar!'
				]
			],
			'tempat' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'TTL belum lengkap!'
				]
			],
			'tanggal' => [
				'rules' => 'required'
			],
			'gender' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Jenis kelamin siswa harus diisi!'
				]
			],
			'agama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Agama harus diisi!'
				]
			],
			'alamat' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Alamat siswa harus diisi!'
				]
			],
			'notelp' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nomor telepon siswa harus diisi!'
				]
			],
			'orangtua' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama orang tua siswa harus diisi!'
				]
			]
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to(base_url('/siswa/edit/') . $this->request->getVar('slug_nama'))->withInput()->with('validation', $validation->getErrors());
		}
		$slug_nama = url_title($this->request->getVar('nama'), '-', true);
		$splitDate = explode('-', $this->request->getVar('tanggal'));
		$tanggal_lahir = $splitDate[2] . ' ' . $this->convertMonth($splitDate[1]) . ' ' . $splitDate[0];
		$this->siswaModel->save([
			'id' => $id,
			'nama' => $this->request->getVar('nama'),
			'slug_nama' => $slug_nama,
			'nisn' => $this->request->getVar('nisn'),
			'tempat_lahir' => $this->request->getVar('tempat'),
			'tanggal_lahir' => $tanggal_lahir,
			'jenis_kelamin' => $this->request->getVar('gender'),
			'agama' => $this->request->getVar('agama'),
			'alamat' => $this->request->getVar('alamat'),
			'no_telp' => $this->request->getVar('notelp'),
			'orang_tua_asuh' => $this->request->getVar('orangtua')
		]);

		session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');

		return redirect()->to(base_url('/Siswa'));
	}
}
