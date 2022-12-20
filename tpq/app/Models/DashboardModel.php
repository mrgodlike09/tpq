<?php

namespace App\Models;

use CodeIgniter\Model;

date_default_timezone_set('Asia/Jakarta');

class DashboardModel extends Model
{
  protected $db,
    $absen, $ust;
  function __construct()
  {
    $this->db      = \Config\Database::connect();
    $this->absen  = $this->db->table("tabel_absen");
    $this->ust  = $this->db->table("tabel_ust");
  }

  public function getAbsensi ($tanggal)
  {
    $this->absen->select('id_ust, nama, mulai_mengajar, amanah, tanggal_absen, shift_pagi, shift_siang, shift_sore');
    $this->absen->join('tabel_ust', 'tabel_absen.id_ust = tabel_ust.id');
    $this->absen->where(["tanggal_absen" => $tanggal, "status" => 1]);
    return $this->absen->get()->getResult();
  }

}
