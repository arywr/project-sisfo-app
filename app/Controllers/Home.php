<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SiswaModel;
use App\Models\GuruModel;

class Home extends BaseController
{
	protected $userModel, $siswaModel, $guruModel;
	public function __construct()
	{
		$this->siswaModel = new SiswaModel();
		$this->userModel = new UserModel();
		$this->guruModel = new GuruModel();
	}

	public function index()
	{
		if (session('user_id')) {
			$user = $this->guruModel->getUserbyId((session('user_id')));
			$nickname = explode(' ', $user['nama']);

			$countSiswa = $this->siswaModel->countResult();
			$countGuru = $this->guruModel->countGuru();
			$countUser = $this->userModel->countUser();

			$data = [
				'title' => 'Sisfo - Dashboard',
				'user' => $user,
				'nickname' => $nickname[0],
				'countSiswa' => $countSiswa,
				'countGuru' => $countGuru,
				'countUser' => $countUser
			];
			echo view('pages/dashboard-home', $data);
		} else {
			return redirect()->to(base_url('/Auth'));
		}
	}
}
