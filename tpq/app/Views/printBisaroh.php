<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TPQ AL-MUHAJIRIN</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">

  <style>

    body {
      font-family : "Open Sans";
   }

    #watermark {
      width: calc(210mm /4);
      height: auto;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      opacity: .05;
    }

    #kertas {
      width: calc(210mm / 2);
      height: calc(297mm / 3);
      padding: .5cm;
      /* border: solid; */
      position: relative;
    }

    #kertas::before {
      content: '';
      position: absolute;
      top: 10px;
      right: 10px;
      left: 10px;
      bottom: 10px;
      border: solid;
      background: white;
      z-index:-1;
    }

    #kertas > .body p,
    #kertas > .ttd p {
      font-size: 10pt;
      margin-bottom: 0;
    }

    #kertas > .ttd {
      position: absolute;
      bottom: 30px;
      right: 30px;
    }

    .header {
      width: 100%;
      padding-bottom: .5rem;
      border-bottom: double;
    }

    .table > tbody > tr > td:last-child {
      text-align: right;
    }

    .table > tbody > tr > td {
      line-height: 1.2;
      font-size: 10pt;
      padding: .1rem;
    }

  </style>
</head>
  <?php
    $nama; $amanah; $mulai_mengajar;
    $sakit = $izin = $lama_mengabdi = $shift_pagi = $shift_siang = $shift_sore = 0;

    function countShift($absenShift) {
      $sakit = $izin = 0;
      $masuk = 1;

      if($absenShift == null) return [0, 0, 0];

      if(strtolower($absenShift[0]) == 'i') {
        $izin += 1;
        $masuk = 0;
      }

      if(strtolower($absenShift[0]) == 's') {
        $sakit += 1;
        $masuk = 0;
      }

      return [$masuk, $sakit, $izin];
    }

    foreach ($absensi as $v) {
      $nama = $v->nama;
      $amanah = $v->amanah;
      $mulai_mengajar = $v->mulai_mengajar;

      $shift_pagi += countShift($v->shift_pagi)[0];
      $shift_siang += countShift($v->shift_siang)[0];
      $shift_sore += countShift($v->shift_sore)[0];

      $sakit += (countShift($v->shift_pagi)[1] + countShift($v->shift_siang)[1] + countShift($v->shift_sore)[1]);
      $izin += (countShift($v->shift_pagi)[2] + countShift($v->shift_siang)[2] + countShift($v->shift_sore)[2]);
    }

    $tanggalMulai = date_create($mulai_mengajar);
    $tanggalSekarang = date_create(date('Y-m-d'));

    $lama_mengabdi = date_diff($tanggalSekarang, $tanggalMulai)->format('%y Tahun');


  ?>
<body class="pt-5">
  <div class="row no-gutters">
    <div class="col-12 d-flex justify-content-center align-items-center" style="flex-direction: column;">
      <h3 class="w-100 text-center">Preview</h3>
      <div id="kertas" class="">
        <img src="/dist/img/logoQiroati.png" id="watermark"/>
        <div class="header">
          <h4 class="text-center">Bisaroh TPQ Al-Muhajirin</h4>
          <p class="text-center m-0" style="font-size:11pt;">Perum Bumi Tegal Blok BA-11, Kaliwates, Jember</p>
        </div>
        <div class="body">
          <div class="data-diri">
            <p class="text-right my-2" id="tanggal_bisaroh"></p>
            <p>Nama : <strong id="nama_ust"><?= $nama; ?></strong> </p>
            <p>Mulai Mengajar : <strong id="mulai_mengajar"><?= date_format(date_create($mulai_mengajar),'d-m-Y'); ?></strong></p>
            <p>Amanah : <strong id="amanah" style="text-transform: capitalize;"><?= $amanah; ?></strong></p>
            <p>Lama Mengabdi : <strong id="lama_mengabdi"><?= $lama_mengabdi; ?></strong></p>
          </div>
          <!-- <div class="border my-2"> -->
            <h6 class="text-center mt-2">Rincian</h6>
            <table class="table table-striped my-2">
              <tbody>
                <tr>
                  <td>Shift Pagi</td>
                  <td><strong id="shift_pagi"><?= $shift_pagi; ?></strong></td>
                </tr>
                <tr>
                  <td>Shift Siang</td>
                  <td><strong id="shift_siang"><?= $shift_siang; ?></strong></td>
                </tr>
                <tr>
                  <td>Shift Sore</td>
                  <td><strong id="shift_sore"><?= $shift_sore; ?></strong></td>
                </tr>
                <tr>
                  <td>Sakit / Izin Syar'i</td>
                  <td><strong id="sakit"><?= $sakit; ?></strong></td>
                </tr>
                <tr>
                  <td>Izin</td>
                  <td><strong id="izin"><?= $izin; ?></strong></td>
                </tr>
              </tbody>
            </table>
          <!-- </div> -->
          <!-- <span class="d-block">Total Bisaroh = ( <strong>total mengajar</strong> + <strong>sakit</strong> ) &times; 6000</span> -->
          <p>Total Bisaroh = <strong style="text-decoration: underline; font-size: 110%;" id="total_bisaroh">
            <?php
              $bonusLamaMengabdi = 25000;
              $feePerShift = 7500;
	      $bisarohAmanah = 0;
	
	      (strpos(strtolower($amanah), "kepala") !== false) ? $bisarohAmanah += 100000 : "";
	      (strpos(strtolower($amanah), "finishing") !== false) ? $bisarohAmanah += 50000 : "";
	      (strpos(strtolower($amanah), "pembukuan") !== false) ? $bisarohAmanah += 50000 : "";
	      (strpos(strtolower($amanah), "pengelola") !== false) ? $bisarohAmanah += 1500000 : "";
	      (strpos(strtolower($amanah), "tpq pagi") !== false) ? $bisarohAmanah += 75000 : "";
              // if (strpos(strtolower($amanah), "kepala") !== false) {
                // $bisarohAmanah += 100000; //kepala tpq
              // } 
	      // if(strpos(strtolower($amanah), "finishing") !== false) {
                // $bisarohAmanah += 50000; //guru finishing
              // }
	      // if(strpos(strtolower($amanah), "pembukuan") !== false) {
                // $bisarohAmanah += 50000; //pembukuan
              // } 
	      // if(strpos(strtolower($amanah), "pengelola") !== false) {
                // $bisarohAmanah += 1500000; //pembukuan
              // } 

              $total_bisaroh = (($shift_pagi + $shift_siang + $shift_sore + $sakit) * $feePerShift) + $bisarohAmanah + ($bonusLamaMengabdi * $lama_mengabdi);
              echo "Rp. ". number_format($total_bisaroh,0,",",".") .",-";

            ?>
          </strong></p>
        </div>
        <!-- <div class="ttd" >
          <p class="mb-5 text-center" id="tanggalSurat"></p>
          <p  class="text-center"><strong>Admin TPQ Al-Muhajirin</strong></p>
        </div> -->
      </div>
      <div>
        <button class="btn mr-3 btn-secondary" onclick="window.close()">Kembali</button>
        <button class="btn btn-primary" onclick="generatePDF()">Simpan</button>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>

  <script >

    let d = new Date()
    let bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]

    $(document).ready(() => {
      $('#tanggal_bisaroh').text(`${d.getDate()} ${bulan[d.getMonth()]} ${d.getFullYear()}`)
    })

    let generatePDF = () => {
      let node = document.getElementById('kertas')
      let scale = 2
      let options = {
        width: node.clientWidth * scale,
        height: node.clientHeight * scale,
        style: {
          transform: 'scale('+scale+')',
          transformOrigin: 'top left'
        }
      }

      domtoimage.toBlob(node).then(blob => {
        var url_string = window.location.href
        var uri = new URL(url_string)
        var month = uri.searchParams.get("bulan")


        let url = URL.createObjectURL(blob)
        var anchor = document.createElement('a');
        anchor.href = url;
        anchor.target = '_blank';
        anchor.download = `Bisaroh_${bulan[month - 1]}-<?= $nama ?>.png`;// nama file
        anchor.click();
      })

    }
  </script>
</body>
</html>