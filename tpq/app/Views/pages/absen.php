<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
        <div class="form-group" style="display: flex; align-items: center;">
          <strong class=" ">Bulan Ke - </strong>
          <select class="form-control ml-2" style="width: 5rem;" name="f_bulan" value="<?= Date('m'); ?>">
            <?php
            for ($i = 1; $i <= 12; $i++) {
              if ($i == Date('m')) {
                echo "<option value='$i' selected>$i</option>";
                continue;
              }
              echo "<option value='$i'>$i</option>";
            }
            ?>
          </select>
        </div>
        <hr>
  <nav class="bg-white">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="absen-tab" data-toggle="tab" href="#nav-absen" role="tab" aria-controls="nav-absen" aria-selected="true">Absensi</a>
      <a class="nav-item nav-link" id="bisaroh-tab" data-toggle="tab" href="#nav-bisaroh" role="tab" aria-controls="nav-bisaroh" aria-selected="false">Bisaroh</a>
      <!-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> -->
    </div>
  </nav>
  <div class="tab-content bg-white" id="nav-tabContent">
    <div class="tab-pane fade show active p-3" style="border: 1px solid; border-top: none; border-color:#dee2e6 #dee2e6;" id="nav-absen" role="tabpanel" aria-labelledby="nav-absen-tab">
      <section class="content">

      <table id="tabel_absensi" class="table table-striped table-hover w-100" >
      </table>


      </section>
      <div class="tab-overlay">
        <i class="fa fa-spin fa-sync fa-2x"></i>
      </div>

    </div>
    <div class="tab-pane fade p-3 row" id="nav-bisaroh" style="position: relative; border: 1px solid; border-top: none; border-color:#dee2e6;" role="tabpanel" aria-labelledby="nav-bisaroh-tab">

      <div class="form-group col-sm-4" id="protectionForm">
        <label class="mb-3" style="color: #6f42c1;">Masukkan Password untuk membuka dokumen</label>
        <input type="password" class="form-control" data-p="tidakjualbuku" id="content-pass" />
      </div>

      <div class="content-rahasia col-12" style="display:none;">
        <h4 class="w-100 text-center py-2">Info Bisaroh Ustadz / Ustadzah TPQ Al-Muhajirin</h4>
        <hr>
        <button class="btn btn-success mb-2 float-right" onclick="cetakBisaroh()"> <i class="fa fa-print"></i> Cetak Bisaroh</button>
        <div class="row no-gutters container-list-bisaroh" style="display: none; clear: both;">
          <!-- list bisaroh here  -->
        </div>
        <div class="tab-overlay">
          <i class="fa fa-spin fa-sync fa-2x"></i>
        </div>
      </div>
    </div>

  </div>
  <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div> -->
</div>
<!-- Main content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; 2019 - <?= Date('Y') ?> <a href="#">TPQ Al-Muhajirin</a>.</strong> All rights
  reserved.
  <?= Date('Y-m-d H:i:s'); ?>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js"></script>
<script src="/plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js"></script>

<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="/dist/js/demo.js"></script> -->

<script>
  let _global = {}
  $(document).ready(async () => {
    _global = {
      tanggal: await getTanggal(),
      absensi: await getAbsensi(),
      bonusPengabdian: 25000
    }
    appendTableData(_global.tanggal, _global.absensi)
    appendInfoBisaroh(_global.absensi)
    $('[data-toggle="tooltip"]').tooltip()
    checkAbsen()

  })
</script>

<script>
  let setGlobalVar = async() => {
    _global = {
      tanggal: await getTanggal(),
      absensi: await getAbsensi(),
      bonusPengabdian: 0
    }
    new Promise(resolve => {
      resolve(_global)
    })
  }
</script>

<!-- script for absensi -->
<script>
  let getTanggal = async () => {
    let bulan = $('select[name=f_bulan]').val()
    let tahun = <?= Date('Y') ?>

    let response = await fetch(`<?= base_url() ?>/absen/getTanggal?bulan=${bulan}&tahun=${tahun}`)
    let data = await response.json()

    return new Promise((resolve) => {
      resolve(data)
    })
  }

  let getAbsensi = async () => {
    let bulan = $('select[name=f_bulan]').val()
    let tahun = <?= Date('Y') ?>

    let response = await fetch(`<?= base_url() ?>/absen/getAbsensi?bulan=${bulan}&tahun=${tahun}`)
    let data = await response.json()

    return new Promise((resolve) => {
      resolve(data)
    })
  }

  let appendTableData = (tanggal, absensi) => {

    tanggal = tanggal.map((item) => item.tanggal_absen) //[...{tanggal_absen : tanggal}] to [...tanggal]
    //append header
    $('#tabel_absensi').html(`<thead>
                <tr style="border-top-left-radius: .75rem; border-top-right-radius: .75rem;">
                <th rowspan="2" class="text-center" style="vertical-align: middle;">Nama Ustad/dzah</th>
                </tr>
                <tr></tr>
              </thead>
              <tbody></tbody>`)
    let firstRowElement = ''
    let secondRowElement = ''
    for (let i = 0; i < tanggal.length; i++) {
      firstRowElement += `<th class="text-center" colspan="3">${tanggal[i]}</th>`
      secondRowElement += `<th class="text-center statics">Pagi</th>
                          <th class="text-center statics">Siang</th>
                          <th class="text-center statics">Sore</th>`
    }

    $('#tabel_absensi > thead > tr:first-child').append(firstRowElement) // append th to first tr of thead
    $('#tabel_absensi > thead > tr:nth-child(2)').html(secondRowElement) // append th to second tr of thead
    // ======================
    //append body

    let tbodyElement = ``
    let prevNama = ''

    for (i = 0; i < absensi.length; i++) {
      const {
        tanggal_absen,
        nama,
        shift_pagi,
        shift_siang,
        shift_sore
      } = absensi[i]

      if (prevNama != nama) {
        tbodyElement += `\n<tr><td>${nama}</td>`
      }

      tbodyElement += `<td class="text-center">${createTableData(shift_pagi)}</td>
      <td class="text-center">${createTableData(shift_siang)}</td>
      <td class="text-center">${createTableData(shift_sore)}</td>`

      prevNama = nama

      if (i == absensi.length - 1) {
        tbodyElement += `</tr>` //add closing tag tr on the last iteration
      } else if (prevNama != absensi[i + 1].nama) {
        tbodyElement += `</tr>` //add closing tag tr if the nama is different
      }
    }

    $('#tabel_absensi > tbody').html(tbodyElement)

    // ======================
    //initialize table
    initTable()
  }

  let createTableData = (shiftValue) => { // convert value to wanted table data value
    let tableData

    if (shiftValue == null) {
      tableData = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-minus text-dark" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Tidak Mengajar"></a>'
    } else if (shiftValue[0].toLowerCase() == 't') { //if value is a string
      tableData = `<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-times text-danger" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="${shiftValue}"></a>`
    } else if (shiftValue[0].toLowerCase() == 'i') { //if value is a string
      tableData = `<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-info" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="${shiftValue}"></a>`
    }else if (shiftValue[0].toLowerCase() == 's') {
      tableData = `<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-calendar-plus" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="${shiftValue}"></a>`
    } else { // is date time
      tableData = `<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-check text-success" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Absen jam ${shiftValue}"></a>`
    }

    return tableData
  }

  let initTable = () => {
    showTable()
    $('#tabel_absensi').DataTable({
      paging: false,
      scrollX: true,
      scrollCollapse: true,
      fixedColumns: {
        leftColumns: 1,
      },
      columnDefs: [{
        targets: 'statics',
        searchable: false,
        orderable: false
      }],
      "initComplete": function(settings, json) {
        // $('#tabel_absensi').wrap('<div class="dataTables_scroll" />')
        //initialize popover
        $('[data-toggle="popover"]').popover({
          trigger: 'hover'
        })

        $('.popover-dismiss').popover({
          trigger: 'focus'
        })
      }
    })
  }

  let showTable = () => {
    $('.card > .overlay').fadeOut()
    $('.tab-overlay').fadeOut()
    // $('#tabel_absensi').fadeIn()
    $('.container-list-bisaroh').fadeIn()
  }

  let hideTable = () => {
    $('.card > .overlay').show()
    $('.tab-overlay').show()
    // $('#tabel_absensi').hide()
    $('.container-list-bisaroh').hide()
  }
</script>

<!-- script for bisaroh -->
<script>
  let appendInfoBisaroh = (absensi) => {

    let infoBisaroh = ``
    let prevNama = ``

    for (i = 0; i < absensi.length; i++) {
      const {
        id_ust,
        nama
      } = absensi[i]
      if (prevNama != nama) {
        infoBisaroh += `<div class="col-sm-6">
            <div class="card card-bisaroh collapsed-card mb-0">
              <div class="card-header" data-card-widget="collapse">
                <h6 class="mb-0 d-inline">${nama}</h6>
                <span class="float-right" id="total_bisaroh-${id_ust}"></span>
              </div>
              <div class="card-body" id="detail_bisaroh-${id_ust}">
                <!-- <button class="btn btn-success" onclick="printBisaroh(${id_ust})">Print</button> -->
                <h6 class="text-center mb-2">Detail Bisaroh</h6>
              </div>
            </div>
          </div>`
      }

      prevNama = nama
    }

    $('#nav-bisaroh .row').html(infoBisaroh)
    detailBisaroh()
  }

  let detailBisaroh = () => {

    let detailElement,
        total,
        tahunMengabdi

    let bisarohMengajar = 7500

    let _detail = {
      shiftPagi: 0,
      shiftSiang: 0,
      shiftSore: 0,
      totalMasuk: 0,
      izin: 0,
      sakit: 0,
      alpa: 0,
      tanpaKet: 0
    }

    for (i = 0; i < _global.absensi.length; i++) {
      let bonusAmanah = 0

      const {
        id_ust,
        bisaroh,
        shift_pagi,
        shift_siang,
        shift_sore,
        amanah,
        mulai_mengajar
      } = _global.absensi[i]

      if (shift_pagi == null) {
        _detail.alpa += 1
      } else if (isNaN(shift_pagi[0]) == false) {
        _detail.shiftPagi += 1
        _detail.totalMasuk += 1
      } else {
        _detail.sakit += (shift_pagi[0].toLowerCase() == 's') ? 1 : 0 // sakit
        _detail.izin += (shift_pagi[0].toLowerCase() == 'i') ? 1 : 0 //izin
        _detail.tanpaKet += (shift_pagi[0].toLowerCase() == 't') ? 1 : 0 //tanpaKet
      }

      if (shift_siang == null) {
        _detail.alpa += 1
      } else if (isNaN(shift_siang[0]) == false) {
        _detail.shiftSiang += 1
        _detail.totalMasuk += 1
      } else {
        _detail.sakit += (shift_siang[0].toLowerCase() == 's') ? 1 : 0// sakit
        _detail.izin += (shift_siang[0].toLowerCase() == 'i') ? 1 : 0
        _detail.tanpaKet += (shift_siang[0].toLowerCase() == 't') ? 1 : 0// tanpaKet
      }

      if (shift_sore == null) {
        _detail.alpa += 1
      } else if (isNaN(shift_sore[0]) == false) {
        _detail.shiftSore += 1
        _detail.totalMasuk += 1
      } else {
        _detail.sakit += (shift_sore[0].toLowerCase() == 's') ? 1 : 0// sakit
        _detail.izin += (shift_sore[0].toLowerCase() == 'i') ? 1 : 0//izin
        _detail.tanpaKet += (shift_sore[0].toLowerCase() == 't') ? 1 : 0//tanpaKet
      }

      if (i == _global.absensi.length - 1 || id_ust != _global.absensi[i + 1].id_ust) {
        //jika loop terakhir atau id ust berbeda dengan id ust selanjutnya
        let mulai = new Date(mulai_mengajar)
        let sekarang = new Date()

  //       amanah.toLowerCase().includes('pengelola') ? bonusAmanah += 1500000 : ''
  //       amanah.toLowerCase().includes('kepala') ? bonusAmanah += 100000 : ''
  //       amanah.toLowerCase().includes('operator') ? bonusAmanah += 25000 : ''
  //       amanah.toLowerCase().includes('finishing') ? bonusAmanah += 50000 : ''
  //       amanah.toLowerCase().includes('pembukuan') ? bonusAmanah += 50000 : ''
	// amanah.toLowerCase().includes('tpq pagi') ? bonusAmanah += 75000 : ''
  //       //jika hari ini taun ke - N mengajar
        tahunMengabdi = sekarang.getFullYear() - mulai.getFullYear()

        hariMengabdi = sekarang.getDate() - mulai.getDate()
        bulanMengabdi = sekarang.getMonth() - mulai.getMonth()

        if(tahunMengabdi > 0) {
          if (bulanMengabdi < 0 ) {
            tahunMengabdi -= 1
          } else if(bulanMengabdi == 0){
            if(hariMengabdi < 0) {
              tahunMengabdi -= 1
            }
          }
        }
        // total = (_detail.sakit + _detail.totalMasuk) * bisarohMengajar + bonusAmanah + (tahunMengabdi * _global.bonusPengabdian)
        total = (_detail.sakit + _detail.totalMasuk) * bisarohMengajar + parseInt(bisaroh)
        // let totalElement = `Rp. ${total} ,-`

        // console.log(`${_global.absensi[i].nama} : ${amanah} => bisaroh amanah : ${bonusAmanah}`)
        // detailElement = `
        // <p>Amanah : ${amanah}</p>
        // <ul>
        //   <li>Bisaroh Amanah : ${bonusAmanah}</li>
        //   <li>Total Mengajar : <strong>${_detail.totalMasuk}</strong> * ${bisarohMengajar} = ${_detail.totalMasuk * bisarohMengajar}</li>
        //   <li>Sakit : <strong>${_detail.sakit}</strong> * ${bisarohMengajar} = ${_detail.sakit * bisarohMengajar}</li>
        //   <li>Izin : <strong>${_detail.izin}</strong> * 0 = 0</li>
        //   <li>Tanpa Keterangan : <strong>${_detail.tanpaKet}</strong> * 0 = 0</li>
        //   <li>Tahun Mengabdi : <strong>${tahunMengabdi}</strong> * ${_global.bonusPengabdian} = ${tahunMengabdi * _global.bonusPengabdian}</li>
        // </ul>
        // `

        detailElement = `
        <p>Amanah : ${amanah}</p>
        <ul>
          <li>Bisaroh tambahan : ${bisaroh}</li>
          <li>Total Mengajar : <strong>${_detail.totalMasuk}</strong> * ${bisarohMengajar} = ${_detail.totalMasuk * bisarohMengajar}</li>
          <li>Sakit : <strong>${_detail.sakit}</strong> * ${bisarohMengajar} = ${_detail.sakit * bisarohMengajar}</li>
          <li>Izin : <strong>${_detail.izin}</strong> * 0 = 0</li>
          <li>Tanpa Keterangan : <strong>${_detail.tanpaKet}</strong> * 0 = 0</li>
          <li>Tahun Mengabdi : <strong>${tahunMengabdi} tahun</strong></li>
        </ul>
        `

        $(`#total_bisaroh-${id_ust}`).text(`Rp. ${total.toLocaleString(`id-ID`)},-`)
        $(`#detail_bisaroh-${id_ust}`).append(detailElement)
        //reset detail
        _detail = {
          shiftPagi: 0,
          shiftSiang: 0,
          shiftSore: 0,
          totalMasuk: 0,
          izin: 0,
          sakit: 0,
          alpa: 0,
          tanpaKet: 0
        }
      }
    }
  }
  // let printBisaroh = (id_ust) => {
  //   let bulan = $('select[name=f_bulan]').val()
  //   let tahun = <?= Date('Y'); ?>

  //   window.open(`<?= base_url(); ?>/printBS?id=${id_ust}&bulan=${bulan}&tahun=${tahun}`, '_blank')
  // }

  const cetakBisaroh = () => {
    let bulan = $('select[name=f_bulan]').val()
    let tahun = <?= Date('Y'); ?>

    window.open(`<?= base_url(); ?>/generateBisaroh?bulan=${bulan}&tahun=${tahun}`, '_blank')
  }
</script>
<script>
  //check absen hari ini
  let checkAbsen = () => {
    $.get(`<?= base_url(); ?>/absen/tulisabsen`, data => {
      console.log(data)
    })
  }

</script>

<script>
  //lihat absen bulan X

  $('select[name=f_bulan]').on('change', async(e) => {
    let _this = $(e.currentTarget)

    hideTable()
    $('#tabel_absensi').DataTable().clear().destroy()
    $('#tabel_absensi').html('')
    await setGlobalVar()
    if(_global.tanggal.length == 0) {
      // $('#tabel_absensi > thead ').html(`<tr style="border-top-left-radius: .75rem; border-top-right-radius: .75rem;">
      //                                     <th class="text-center" style="vertical-align: middle;">Nama Ustad/dzah</th>
      //                                   </tr>`)
      // $('#tabel_absensi > tbody ').html('<tr><td class="text-center">Data absen tidak ditemukan!</td></tr>')
      $('#tabel_absensi').html(`<thead>
                                  <tr style="border-top-left-radius: .75rem; border-top-right-radius: .75rem;">
                                    <th class="text-center" style="vertical-align: middle;">No Data Found</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr><td class="text-center">Data absen tidak ditemukan!</td></tr>
                                </tbody>`)


      $('#nav-bisaroh > .row').html(`<p class="w-100 text-center mt-3">Data bisaroh tidak ditemukan!</p> `)
      initTable()
    } else {
      appendTableData(_global.tanggal, _global.absensi)
      appendInfoBisaroh(_global.absensi)
    }
  })
</script>
<script>
  $('#content-pass').on('change keyup input paste', (e) => {
    let t = $(e.currentTarget)
    let p = t.data('p')
    let v = t.val()

    if(p !== v) {
      t.addClass('border-danger')
    } else {
      $('#protectionForm').fadeOut(300)
      setTimeout(() => {
        $('.content-rahasia').fadeIn(500)
      }, 300);
    }

  })
</script>
</body>

</html>