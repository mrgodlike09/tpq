<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Bisaroh ( <?= $bulan . ' '. date('Y') ?> )</title>
  <style>

    @font-face {
      font-family: "Nunito Regular";
      src: url("<?= base_url() ?>/vendor/dompdf/dompdf/lib/fonts/nunito-regular.ttf");
    }

    @font-face {
      font-family: "Nunito Light";
      src: url("<?= base_url() ?>/vendor/dompdf/dompdf/lib/fonts/nunito-light.ttf");
    }
   body {
     margin: 0;
      padding: 0;
      padding-bottom: 0;
      font-size: 12pt;
    }

    table {
      margin: 0;
      padding: 0;
    }

    td {
      padding: 2.5pt;
    }

    .box {
      width: 295px;
      height: 295px;
      border: solid 3px black;
      padding: 5px;
    }

    .kop {
      padding-bottom: 5pt;
      border-bottom: double 3px black;
    }

    .kop h2 {
      margin: 0;
      margin-bottom: 4px;
      text-align: center;
      font-family: "Nunito Regular", sans-serif !important;
      font-size: 14pt;
    }

    .kop p {
      margin: 0;
      margin-bottom: 4px;
      font-family: "Nunito Light", sans-serif !important;
      font-size: 10pt;
      text-align: center;
    }

    .body-box {
      font-size: 9pt;
      font-family: "Nunito Regular", sans-serif !important;
    }


    .body-box .tanggal {
      margin: 0;
      margin-top: 3px;
      text-align: right;
    }

    .body-box ul {
      margin: 0;
      padding: 0;
    }

    table.bio {
    }

    .bio td {
      padding: 0;
    }

    h6 {
      text-align: center;
      margin: 0;
      margin-bottom: 5px;
      font-size: 10pt;
    }

    .detail {
      width: 100%;
      border-collapse: collapse;
      font-family: "Nunito Regular", sans-serif !important;
    }

    .detail tr:nth-child(odd) {
      background: #eee;
    }

    .detail p {
      text-align: right;
      margin: 0;
    }
    .body-box .total {
      margin-top: 8px;
      font-size: 10pt;
    }
    </style>
</head>
<body>
  <table>
    <tbody>
      <?php
      $bisaroh = 7500;
      // $bonusLamaMengabdi =  25000;
      foreach ($rekapBisaroh as $index => $row) {
        $totalBisaroh = 0;
        $totalMengajar = $row->shift_pagi + $row->shift_siang + $row->shift_sore;
        $totalSakit = $row->sakit_pagi + $row->sakit_siang + $row->sakit_sore;
        $totalIzin = $row->izin_pagi + $row->izin_siang + $row->izin_sore;
        $totalTanpaKet = $row->tanpa_ket_pagi + $row->tanpa_ket_siang + $row->tanpa_ket_sore;
        //bisaroh mengajar
        $totalBisaroh = ($totalMengajar + $totalSakit) * $bisaroh;

        // $bisarohLamaMengabdi = $bonusLamaMengabdi * $row->lamaMengabdi;
        //bisaroh mengajar + lama mengabdi
        // $totalBisaroh += $bisarohLamaMengabdi;
        //+ amanah
        // $bisarohAmanah = 0;
  //       if (strpos(strtolower($row->amanah), "kepala") !== false) {
  //         $bisarohAmanah += 100000; //kepala tpq
  //       }
	// if(strpos(strtolower($row->amanah), "operator") !== false) {
  //         $bisarohAmanah += 25000; //operator
  //       }
	// if(strpos(strtolower($row->amanah), "finishing") !== false) {
  //         $bisarohAmanah += 50000; //guru finishing
  //       }
	// if(strpos(strtolower($row->amanah), "pembukuan") !== false) {
  //         $bisarohAmanah += 50000; //pembukuan
  //       }
	// if(strpos(strtolower($row->amanah), "pengelola") !== false) {
  //         $bisarohAmanah += 1500000; //amik
  //       }
	// if(strpos(strtolower($row->amanah), "tpq pagi") !== false) {
  //         $bisarohAmanah += 75000; //tpq pagi
  //       }

        $totalBisaroh += $row->bisaroh;
        ?>
        <?php if($index == 0 || $index % 2 == 0 ) {  ?>
        <tr>
          <td>
            <div class="box">
              <div class="kop">
                <h2>Bisaroh TPQ Al-Muhajirin</h2>
                <p>Perum Bumi Tegal Besar Blok BA-11, Jember</p>
              </div>
              <div class="body-box">
                <p class="tanggal"><?= date('d-m-Y') ?></p>
                <table class="bio">
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><?= $row->nama ?></td>
                    </tr>
                    <tr>
                      <td>Mulai Mengajar</td>
                      <td>:</td>
                      <td><?= date_format(date_create($row->mengajar), 'd-m-Y')?></td>
                    </tr>
                    <!-- <tr>
                      <td>Amanah</td>
                      <td>:</td>
                      <td><?= $row->amanah ?></td>
                    </tr> -->
                    <tr>
                      <td>Lama Mengabdi</td>
                      <td>:</td>
                      <td><?= $row->lamaMengabdi ?> tahun</td>
                    </tr>
                </table>
                <h6>Rincian</h6>
                <table class="detail">
                  <tr>
                    <td>Shift Pagi</td>
                    <td><p><?= $row->shift_pagi ?></p></td>
                  </tr>
                  <tr>
                    <td>Shift Siang</td>
                    <td><p><?= $row->shift_siang ?></p></td>
                  </tr>
                  <tr>
                    <td>Shift Sore</td>
                    <td><p><?= $row->shift_sore ?></p></td>
                  </tr>
                  <tr>
                    <td>Sakit / Izin Syar'i</td>
                    <td><p><?= $totalSakit ?></p></td>
                  </tr>
                  <tr>
                    <td>Izin</td>
                    <td><p><?= $totalIzin ?></p></td>
                  </tr>
                  <tr>
                    <td>Tanpa Keterangan</td>
                    <td><p><?= $totalTanpaKet ?></p></td>
                  </tr>
                </table>
                <!-- bisaroh = (total mengajar + total sakit) * 6500 + lama mengabdi * bonus + bisaro amanah  -->
                <p class="total">Total Bisaroh : <u><strong>Rp. <?= number_format($totalBisaroh,0,",",".") ?>,-</strong></u></p>
              </div>
            </div>
          </td>
          <?php } else { ?>
            <td>
            <div class="box">
              <div class="kop">
                <h2>Bisaroh TPQ Al-Muhajirin</h2>
                <p>Perum Bumi Tegal Besar Blok BA-11, Jember</p>
              </div>
              <div class="body-box">
                <p class="tanggal"><?= date('d-m-Y') ?></p>
                <table class="bio">
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><?= $row->nama ?></td>
                    </tr>
                    <tr>
                      <td>Mulai Mengajar</td>
                      <td>:</td>
                      <td><?= date_format(date_create($row->mengajar), 'd-m-Y')?></td>
                    </tr>
                    <!-- <tr>
                      <td>Amanah</td>
                      <td>:</td>
                      <td><?= $row->amanah ?></td>
                    </tr> -->
                    <tr>
                      <td>Lama Mengabdi</td>
                      <td>:</td>
                      <td><?= $row->lamaMengabdi ?> tahun</td>
                    </tr>
                </table>
                <h6>Rincian</h6>
                <table class="detail">
                  <tr>
                    <td>Shift Pagi</td>
                    <td><p><?= $row->shift_pagi ?></p></td>
                  </tr>
                  <tr>
                    <td>Shift Siang</td>
                    <td><p><?= $row->shift_siang ?></p></td>
                  </tr>
                  <tr>
                    <td>Shift Sore</td>
                    <td><p><?= $row->shift_sore ?></p></td>
                  </tr>
                  <tr>
                    <td>Sakit / Izin Syar'i</td>
                    <td><p><?= $totalSakit ?></p></td>
                  </tr>
                  <tr>
                    <td>Izin</td>
                    <td><p><?= $totalIzin ?></p></td>
                  </tr>
                  <tr>
                    <td>Tanpa Keterangan</td>
                    <td><p><?= $totalTanpaKet ?></p></td>
                  </tr>
                </table>
                <!-- bisaroh = (total mengajar + total sakit) * 6500 + lama mengabdi * bonus + bisaro amanah  -->
                <p class="total">Total Bisaroh : <u><strong>Rp. <?= number_format($totalBisaroh,0,",",".") ?>,-</strong></u></p>
              </div>
            </div>
          </td>
        </tr>
        <?php } ?>

        <?php if($index == count($rekapBisaroh) - 1 ) { ?>
          <!-- last iteration -->
        </tr>
        <!-- ================ -->
      <?php }} ?>
    </tbody>
  </table>
</body>
</html>