<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\DashboardModel;

class Dashboard extends BaseController
{
	protected  $model, $mDash;
	public function __construct()
	{
		$this->model = new AbsensiModel();
		$this->mDash = new DashboardModel();
	}

	public function index()
	{
		$menu['active'] = "dashboard";
		$this->tulisAbsen();
		echo view('components/header');
		echo view('components/sidebar', $menu);
		echo view('pages/dashboard');
	}

	public function tulisAbsen()
	{
		if($this->model->tulisAbsen()) {
			return 1;
		} else {
			return 0;
		}
		// echo $this->model->tulisAbsen();
	}

	public function getAbsensiHariIni()
	{
		$tanggal = $_GET["tanggal"];
		echo json_encode($this->mDash->getAbsensi($tanggal));
	}

	//--------------------------------------------------------------------

	public function doAbsen() {
		$keterangan = isset($_GET['keterangan']) ? $_GET['keterangan'] : date('H:i:s');
		$keterangan = ($keterangan == "\x00") ? NULL : $keterangan;
		$data = [
			"shift" => $_GET['shift'],
			"id_ust" => $_GET['id'],
			"keterangan" => $keterangan
		];

		if( $this->model->absen($data) > 0 ) {
			echo 'Absen berhasil!';
		} else {
			echo 'Absen gagal! Silahkan coba lagi';
		}

	}

}
