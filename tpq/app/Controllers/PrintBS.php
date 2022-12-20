<?php

namespace App\Controllers;

use App\Models\AbsensiModel;

class PrintBS extends BaseController
{
	protected  $model;
	public function __construct()
	{
		$this->model = new AbsensiModel();
	}

	public function index()
	{
		$id_ust = $_GET['id'];
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$data = [
			'absensi' => $this->model->getAbsensi($bulan, $tahun, $id_ust),
			'tanggal' => $this->model->getTanggalAbsensi()
		];

		echo view('printBisaroh', $data);
	}



	//--------------------------------------------------------------------

}
