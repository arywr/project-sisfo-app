<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\GuruModel;
use CodeIgniter\I18n\Time;

class Guru extends BaseController
{
	protected $userModel, $guruModel;
	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->guruModel = new GuruModel();
	}
	public function index()
	{
		$currentPage = $this->request->getVar('page_guru') ? $this->request->getVar('page_guru') : 1;
		$postPerPage = 10;
		$resultPage = $this->guruModel->countGuru();

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$resultPage = $this->guruModel->countGuru($keyword);
			$guru = $this->guruModel->searchGuru($keyword);
		} else {
			$guru = $this->guruModel;
		}
		$data = [
			'title' => 'Sisfo - Daftar Guru',
			'guru' => $guru->paginate($postPerPage, 'guru'),
			'pager' => $this->guruModel->pager,
			'currentPage' => $currentPage,
			'postPerPage' => $postPerPage,
			'resultPage' => $resultPage,
			'user' => $this->guruModel->getUserbyId(session('user_id'))
		];
		echo view('pages/guru/dashboard-guru', $data);
	}

	public function addGuru()
	{
		if (session('role_id') == 1) {
			$data = [
				'title' => 'Form Pendaftaran Guru Baru',
				'validation' => \Config\Services::validation(),
				'user' => $this->guruModel->getUserbyId(session('user_id'))
			];
			return view('pages/guru/add-guru', $data);
		} else {
			return redirect()->to(base_url('/Home'));
		}
	}

	public function SaveGuru()
	{
		if (!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama guru harus diisi!'
				]
			],
			'nip' => [
				'rules' => 'required|is_unique[guru.nip]',
				'errors' => [
					'required' => 'NIP guru harus diisi!',
					'is_unique' => 'NIP guru telah terdaftar!'
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
					'required' => 'Jenis kelamin guru harus diisi!'
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
					'required' => 'Alamat guru harus diisi!'
				]
			],
			'notelp' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nomor telepon guru harus diisi!'
				]
			]
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to(base_url('/guru/addGuru/'))->withInput()->with('validation', $validation->getErrors());
		}
		$slug_nama = url_title($this->request->getVar('nama'), '-', true);
		$splitDate = explode('-', $this->request->getVar('tanggal'));
		$tanggal_lahir = $splitDate[2] . ' ' . $this->convertMonth($splitDate[1]) . ' ' . $splitDate[0];
		$this->guruModel->save([
			'nama' => $this->request->getVar('nama'),
			'slug_nama' => $slug_nama,
			'nip' => $this->request->getVar('nip'),
			'tempat_lahir' => $this->request->getVar('tempat'),
			'tanggal_lahir' => $tanggal_lahir,
			'jenis_kelamin' => $this->request->getVar('gender'),
			'agama' => $this->request->getVar('agama'),
			'alamat' => $this->request->getVar('alamat'),
			'no_telp' => $this->request->getVar('notelp'),
		]);
		session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
		return redirect()->to(base_url('/Guru'));
	}

	public function detailGuru($slug_nama)
	{
		$data = [
			'title' => 'Sisfo - Detail Guru',
			'user' => $this->guruModel->getUserbyId(session('user_id')),
			'guru' => $this->guruModel->getGuru($slug_nama)
		];
		// Jika Data Guru Tidak Ditemukan Di Database
		if (empty($data['guru'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Guru ' . $slug_nama . ' Tidak Ditemukan.');
		}

		return view('pages/guru/detail-guru', $data);
	}

	public function delete($id)
	{
		$checkId = $this->guruModel->where(['id' => $id])->first();
		if (!empty($checkId['user_id'])) {
			$checkRole = $this->userModel->where(['user_id' => $checkId['user_id']])->first();
			if ($checkRole['role_id'] == 1) {
				session()->setFlashdata('alert', 'Data ini tidak bisa dihapus!');
				return redirect()->to(base_url('/Guru'));
			} else {
				$this->guruModel->delete($id);
				$this->userModel->where('user_id', $checkId['user_id'])->delete();
				session()->setFlashdata('success', 'Data Berhasil Dihapus.');
				return redirect()->to(base_url('/Guru'));
			}
		} else {
			$this->guruModel->delete($id);
			session()->setFlashdata('success', 'Data Berhasil Dihapus.');
			return redirect()->to(base_url('/Guru'));
		}
	}

	public function profile()
	{
		$data = [
			'title' => 'Profil Saya',
			'user' => $this->guruModel->getUserbyId(session('user_id')),
		];

		return view('pages/guru/profile', $data);
	}

	public function aktivasi($slug_nama)
	{
		if (session('role_id') == 1) {
			$guru = $this->guruModel->getGuru($slug_nama);
			if (empty($guru)) {
				return redirect()->to(base_url('/Guru'));
			} else {
				if (!empty($guru['user_id'])) {
					session()->setFlashdata('alert', 'User ini telah diaktivasi. Silahkan aktivasi user yang lain!');
					return redirect()->to(base_url('/Guru'));
				}
				$data = [
					'title' => 'Form Aktivasi User',
					'validation' => \Config\Services::validation(),
					'guru' => $guru,
					'user' => $this->guruModel->getUserbyId(session('user_id'))
				];
				return view('pages/guru/aktivasi-guru', $data);
			}
		} else {
			return redirect()->to(base_url('/Home'));
		}
	}

	public function activate($id)
	{
		$guru = $this->guruModel->getGurubyId($id);
		if ($guru['user_id'] == session('user_id')) {
			session()->setFlashdata('alert', 'Silahkan aktivasi user yang lain!');
			return redirect()->to(base_url('/Guru'));
		} else if ($guru['user_id'] != null) {
			session()->setFlashdata('alert', 'User ini telah diaktivasi. Silahkan aktivasi user yang lain!');
			return redirect()->to(base_url('/Guru'));
		} else {
			if (!$this->validate([
				'username' => [
					'rules' => 'required|is_unique[user.username]',
					'errors' => [
						'required' => 'Username harus diisi!',
						'is_unique' => 'Username telah terdaftar!',
					]
				],
				'email' => [
					'rules' => 'required|valid_email|is_unique[user.email]',
					'errors' => [
						'required' => 'Email harus diisi!',
						'valid_email' => 'Email tidak valid!',
						'is_unique' => 'Email telah terdaftar!'
					]
				],
				'password' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Password harus diisi!'
					]
				]
			])) {
				$validation = \Config\Services::validation();
				return redirect()->to(base_url('/Guru/aktivasi/') . $this->request->getVar('slug_nama'))->withInput()->with('validation', $validation->getErrors());
			}
			$this->userModel->save([
				'username' => $this->request->getVar('username'),
				'email' => $this->request->getVar('email'),
				'password' => $this->request->getVar('password'),
				'role_id' => 2,
				'waktu_dibuat' => Time::now()
			]);
			$user_id = $this->userModel->getUser($this->request->getVar('username'));
			$this->guruModel->save([
				'id' => $id,
				'user_id' => $user_id['user_id']
			]);

			session()->setFlashdata('pesan', 'User berhasil diaktivasi.');

			return redirect()->to(base_url('/Guru'));
		}
	}

	public function changePassword($id)
	{
		$password = $this->request->getVar('gantipassword');
		if ($password) {
			$this->userModel->updatePassword($id, $password);
			session()->setFlashdata('success', 'Password anda berhasil diganti!');
			return redirect()->to(base_url('/Guru/profile'));
		} else {
			return redirect()->to(base_url('/Guru/profile'));
		}
	}

	public function edit($slug_nama)
	{
		if (session('role_id') != 1) {
			return redirect()->to(base_url('/Guru'));
		} else {
			$guru = $this->guruModel->getGuru($slug_nama);
			if (empty($guru)) {
				return redirect()->to(base_url('/Guru'));
			} else {
				$data = [
					'title' => 'Form Ubah Data Guru',
					'validation' => \Config\Services::validation(),
					'guru' => $guru,
					'user' => $this->guruModel->getUserbyId(session('user_id'))
				];
				return view('pages/guru/edit-guru', $data);
			}
		}
	}

	public function update($id)
	{
		$oldGuru = $this->guruModel->getGuru($this->request->getVar('slug_nama'));
		if ($oldGuru['nip'] == $this->request->getVar('nip')) {
			$rule_nip = 'required';
		} else {
			$rule_nip = 'required|is_unique[guru.nip]';
		}
		if (!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama siswa harus diisi!'
				]
			],
			'nip' => [
				'rules' => $rule_nip,
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
					'required' => 'Jenis kelamin guru harus diisi!'
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
			]
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to(base_url('/Guru/edit/') . $this->request->getVar('slug_nama'))->withInput()->with('validation', $validation->getErrors());
		}
		$slug_nama = url_title($this->request->getVar('nama'), '-', true);
		$splitDate = explode('-', $this->request->getVar('tanggal'));
		$tanggal_lahir = $splitDate[2] . ' ' . $this->convertMonth($splitDate[1]) . ' ' . $splitDate[0];
		$this->guruModel->save([
			'id' => $id,
			'nama' => $this->request->getVar('nama'),
			'slug_nama' => $slug_nama,
			'nisn' => $this->request->getVar('nip'),
			'tempat_lahir' => $this->request->getVar('tempat'),
			'tanggal_lahir' => $tanggal_lahir,
			'jenis_kelamin' => $this->request->getVar('gender'),
			'agama' => $this->request->getVar('agama'),
			'alamat' => $this->request->getVar('alamat'),
			'no_telp' => $this->request->getVar('notelp'),
		]);

		session()->setFlashdata('pesan', 'Data Berhasil Diupdate.');

		return redirect()->to(base_url('/Guru'));
	}
}
