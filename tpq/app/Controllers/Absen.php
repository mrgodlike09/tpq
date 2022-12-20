<?php

namespace App\Controllers;

use App\Models\AbsensiModel;

class Absen extends BaseController
{
	protected  $model;
	public function __construct()
	{
		$this->model = new AbsensiModel();
	}

	public function index()
	{
		$menu['active'] = "absen";
		$this->tulisAbsen();
		$data = [
			'absensi' => $this->model->getAbsensi(),
			'tanggal' => $this->model->getTanggalAbsensi()
		];
		echo view('components/header');
		echo view('components/sidebar', $menu);
		echo view('pages/absen', $data);
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

	public function getTanggal()
	{
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		echo json_encode($this->model->getTanggalAbsensi($bulan, $tahun));
	}

	public function getAbsensi()
	{
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		echo json_encode($this->model->getAbsensi($bulan, $tahun));
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

	public function getAbsenUst() {
		$shift = $_GET['shift'];
		$tanggal = $_GET['tanggal'];
		$data = [
			"tanggal_absen" => $tanggal,
		];

		echo json_encode($this->model->getUstBelumAbsen( $data, $shift ) );
	}

}
