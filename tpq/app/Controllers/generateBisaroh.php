<?php

namespace App\Controllers;

use App\Models\AbsensiModel;

class GenerateBisaroh extends BaseController
{
	protected  $model;
	public function __construct()
	{
		$this->model = new AbsensiModel();
	}

	public function index()
	{
		$dompdf = new \Dompdf\Dompdf();
    $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $bln = (int) date('m');
    $indexBulan = $bln - 1;
    $data['rekapBisaroh'] = $this->model->getBisaroh($_GET['bulan'], $_GET['tahun']);
    $data['bulan'] = $bulan[$indexBulan];
    $dompdf->loadHtml(view('components/pdfBisaroh', $data));
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('Rekap Bisaroh '.$bulan[$indexBulan].'.pdf', array('Attachment' => false));
    exit(0);
	}



	//--------------------------------------------------------------------

}
