<?php

namespace App\Controllers;

use App\Models\DataModel;

class Ustadz extends BaseController
{
	protected  $model;
	public function __construct()
	{
		$this->model = new DataModel();
  }

  public function index()
  {
    $data['data'] = $this->model->getDataUst();
    $menu['active'] = "ustadz";

    echo view('components/header');
		echo view('components/sidebar', $menu);
		echo view('pages/ustadz', $data);
  }

}