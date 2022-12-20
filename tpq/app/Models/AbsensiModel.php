<?php

namespace App\Models;

use CodeIgniter\Model;

date_default_timezone_set('Asia/Jakarta');

class AbsensiModel extends Model
{
  protected $db,
    $absen, $ust;
  function __construct()
  {
    $this->db      = \Config\Database::connect();
    $this->absen  = $this->db->table("tabel_absen");
    $this->ust  = $this->db->table("tabel_ust");
  }

  public function getAbsensi ($bulan = '', $tahun = '', $id_ust = '')
  {
    if ($bulan == '' && $tahun == '') {
      $bulan = Date("m");
      $tahun = Date("Y");
    }

    $whereArray = [
      "MONTH(tanggal_absen)" => $bulan,
      "YEAR(tanggal_absen)" => $tahun,
      "status" => 1
    ];

    if($id_ust != '') {
      $whereArray["id_ust"] = $id_ust;
    }

    $this->absen->select('id_ust, nama, mulai_mengajar, bisaroh, amanah, tanggal_absen, shift_pagi, shift_siang, shift_sore');
    $this->absen->join('tabel_ust', 'tabel_absen.id_ust = tabel_ust.id');
    $this->absen->where($whereArray);
    $this->absen->groupBy(['id_ust', 'tanggal_absen']);
    return $this->absen->get()->getResult();
  }

  public function getTanggalAbsensi($bulan = '', $tahun = '')
  {
    if ($bulan == '' && $tahun == '') {
      $bulan = Date("m");
      $tahun = Date("Y");
    }

    $this->absen->select('tanggal_absen');
    $this->absen->where('MONTH(tanggal_absen) = ' . $bulan . ' AND YEAR(tanggal_absen) = ' . $tahun . '');
    $this->absen->groupBy('tanggal_absen');

    return $this->absen->get()->getResult();
  }

  public function checkAbsensiHariIni()
  {
    $this->absen->select('tanggal_absen');
    $this->absen->where('tanggal_absen', Date('Y-m-d'));
    return $this->absen->countAllResults();
  }

  public function tulisAbsen()
  {
    $absenHariIni = $this->checkAbsensiHariIni(); // check apakah hari ini sudah absen
    if ($absenHariIni == 0) { // jika belum, tulis absen!
      $data = array();

      $this->ust->select('id');
      $getUst = $this->ust->get()->getResult();

      foreach ($getUst as $v) {
        $temp = array(
          'id_ust' => $v->id,
          'tanggal_absen' => Date('Y-m-d')
        );

        array_push($data, $temp);
      }

      $absen = $this->absen->insertBatch($data);
      return true;
    } else {
      return false;
    }

  }

  //update absen
  public function absen($data) {
    $this->absen->set($data['shift'], $data['keterangan']);
    $this->absen->where('id_ust', $data['id_ust']);
    $this->absen->where('tanggal_absen', Date('Y-m-d'));
    $this->absen->update();
    return $this->db->affectedRows();
  }

  // api
  // get ust yang belum absen hari ini
  public function getUstBelumAbsen($where, $shift) {
    $this->absen->select("tabel_ust.id, nama, $shift");
    $this->absen->join("tabel_ust", 'tabel_ust.id = tabel_absen.id_ust');
    $this->absen->where($where);

    return $this->absen->get()->getResult();
  }
  // pdf bisaroh
  public function getBisaroh($bulanBisaroh, $tahunBisaroh)
  {
    $this->absen->select("(SELECT nama from tabel_ust tu where tu.id = tabel_absen.id_ust) nama,
    (SELECT bisaroh from tabel_ust tu where tu.id = tabel_absen.id_ust) bisaroh,
    (SELECT mulai_mengajar from tabel_ust tu where tu.id = tabel_absen.id_ust) mengajar, TIMESTAMPDIFF(YEAR,
    (SELECT mulai_mengajar from tabel_ust tu where tu.id = tabel_absen.id_ust) ,NOW()) lamaMengabdi,
    (Select amanah from tabel_ust where tabel_ust.id = tabel_absen.id_ust) amanah,
    (SELECT count(id) from tabel_absen t2 where t2.shift_pagi like '%tanpa%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') tanpa_ket_pagi,
    (SELECT count(id) from tabel_absen t2 where t2.shift_siang like '%tanpa%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') tanpa_ket_siang,
    (SELECT count(id) from tabel_absen t2 where t2.shift_sore like '%tanpa%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') tanpa_ket_sore,
    (SELECT count(id) from tabel_absen t2 where t2.shift_pagi like '%sakit%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') sakit_pagi,
    (SELECT count(id) from tabel_absen t2 where t2.shift_siang like '%sakit%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') sakit_siang,
    (SELECT count(id) from tabel_absen t2 where t2.shift_sore like '%sakit%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') sakit_sore,
    (SELECT count(id) from tabel_absen t2 where t2.shift_pagi like '%izin%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') izin_pagi,
    (SELECT count(id) from tabel_absen t2 where t2.shift_siang like '%izin%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') izin_siang,
    (SELECT count(id) from tabel_absen t2 where t2.shift_sore like '%izin%' AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') izin_sore,
    (SELECT count(id) from tabel_absen t2 where TIME(t2.shift_pagi) is not null AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') shift_pagi,
    (SELECT count(id) from tabel_absen t2 where TIME(t2.shift_siang) is not null AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') shift_siang,
    (SELECT count(id) from tabel_absen t2 where TIME(t2.shift_sore) is not null AND t2.id_ust = tabel_absen.id_ust and MONTH(tanggal_absen) ='$bulanBisaroh' and YEAR(tanggal_absen)='$tahunBisaroh') shift_sore,
    ");
    $this->absen->join("tabel_ust", 'tabel_ust.id = tabel_absen.id_ust');
    $this->absen->where(array('MONTH(tanggal_absen)' => $bulanBisaroh, 'YEAR(tanggal_absen)' => $tahunBisaroh, 'status' => 1));
    $this->absen->groupBy('id_ust');
    return $this->absen->get()->getResult();
    // return $this->absen->getCompiledSelect();
  }
}
