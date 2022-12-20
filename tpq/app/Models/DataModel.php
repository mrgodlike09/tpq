<?php

namespace App\Models;

use CodeIgniter\Model;

date_default_timezone_set('Asia/Jakarta');

class DataModel extends Model
{
  protected $db,
    $absen, $ust;
  function __construct()
  {
    $this->db      = \Config\Database::connect();
    $this->absen  = $this->db->table("tabel_absen");
    $this->ust  = $this->db->table("tabel_ust");
  }


  function getDataUst() {
    $this->ust->select('nama, amanah, mulai_mengajar as mulai mengajar, no_syahadah as syahadah');
    $this->ust->where(array('status' => 1));
    $query = $this->ust->get();
    return $query->getResultArray();
  }



}
