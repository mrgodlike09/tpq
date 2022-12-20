<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
   <!-- trigger scanner  -->
  <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#scannerModal" onclick="Scan('start')">
    Mulai Absen
    <i class="fa fa-chevron-right ml-2"></i>
  </button>

  <button type="button" class="btn btn-outline-danger my-2 float-right" data-toggle="modal" data-target="#izinModal">
    Edit Status Kehadiran
  </button>

  <div class="card">
    <div class="card-header">
        <h3 class="card-title">Absensi Hari ini <span style="color: var(--purple); font-weight: bold;">( <?= Date("d-m-Y") ?> )</span></h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          <div class="card card-purple">
            <div class="card-header">
              <h3 class="card-title">Absensi Shift Pagi</h3>
            </div>
            <div class="card-body shift-box shift-pagi">

            </div>
          </div>
        </div>

        <div class="col">
          <div class="card card-purple">
            <div class="card-header">
              <h3 class="card-title">Absensi Shift Siang</h3>
            </div>
            <div class="card-body shift-box shift-siang">

            </div>
          </div>
        </div>

        <div class="col">
          <div class="card card-purple">
            <div class="card-header">
              <h3 class="card-title">Absensi Shift Sore</h3>
            </div>
            <div class="card-body shift-box shift-sore">

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
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

<!-- Modal -->
<div class="modal fade" id="scannerModal" tabindex="-1" role="dialog" aria-labelledby="scannerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scannerModalLabel">Scanner Absensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Scan('stop')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <video style="height: 250px; min-width: 150px;"></video>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="izinModal" tabindex="-1" role="dialog" aria-labelledby="izinModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="izinModalLabel">Keterangan status kehadiran ustadz / ustdazhah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" class="card card-body">
          <div class="form-group">
            <label for="">Keterangan </label>
            <div class="custom-control custom-radio custom-control col-md-4">
              <input type="radio" id="sakit" name="keterangan" class="custom-control-input" value="izin" checked>
              <label class="custom-control-label" for="sakit" style="font-weight: 400;">Izin</label>
            </div>
            <div class="custom-control custom-radio custom-control col-md-4">
              <input type="radio" id="izin" name="keterangan" class="custom-control-input" value="Sakit / izin syar'i">
              <label class="custom-control-label" for="izin" style="font-weight: 400;">Sakit / izin syar'i</label>
            </div>
            <div class="custom-control custom-radio custom-control col-md-4">
              <input type="radio" id="alpa" name="keterangan" class="custom-control-input" value="%00">
              <label class="custom-control-label" for="alpa" style="font-weight: 400;">Tidak Mengajar</label>
            </div>
            <div class="custom-control custom-radio custom-control col-md-4">
              <input type="radio" id="alpa2" name="keterangan" class="custom-control-input" value="Tanpa Keterangan">
              <label class="custom-control-label" for="alpa2" style="font-weight: 400; color: var(--danger);">Tanpa Keterangan</label>
            </div>
          </div>
          <div class="form-group row">
            <label for="pilihShift" class="col-sm-4">Shift </label>
            <select class="form-control" id="pilihShift">
              <option value="shift_pagi">Shift Pagi</option>
              <option value="shift_siang">Shift Siang</option>
              <option value="shift_sore">Shift Sore</option>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Ustadz / Ustadzah</label>
            <select class="form-control select2bs4" style="width: 100%;"  multiple="multiple" data-placeholder="Pilih nama ustadz / ustadzah">
              <!-- options is here -->
            </select>
          </div>
        </form>
        <button class="btn btn-success float-right" id="simpanKeterangan" disabled>Simpan</button>
      </div>
    </div>
  </div>
</div>

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
<script src="/plugins/select2/js/select2.min.js"></script>

<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>

<script>
  let _global = {}

  $(document).ready(async () => {
    _global = {
      absensi: await getAbsensi(),
      bonusPengabdian: 25000
    }
    getShiftPagi()
    getShiftSiang()
    getShiftSore()
    appendSelectionNamaUst()
  })
</script>

<!-- select2 -->
<script>
  let appendSelectionNamaUst = () => {
    const { absensi } = _global
    let selections = ''

    for(i = 0; i < absensi.length; i++) {
      selections += `<option value="${absensi[i].id_ust}">${absensi[i].nama}</option>`
    }

    $('.select2bs4').html(selections)
    $('.select2bs4').select2()

  }

  $('#simpanKeterangan').on('click', async(e) => {
    const id_ust =  $('.select2bs4').val()
    const shift = $('#pilihShift').val()
    const keterangan = $('input[name=keterangan]:checked').val()

    for(i = 0; i < id_ust.length; i++) {
      let response = await fetch(`<?= base_url() ?>/absen/doAbsen?id=${id_ust[i]}&shift=${shift}&keterangan=${keterangan}`)
      let text = await response.text()
      console.log(text)
    }
    await setGlobalVar()

    $('.select2bs4').val([]).change()
    if(shift == "shift_pagi") return getShiftPagi()
    if(shift == "shift_siang") return getShiftSiang()
    return getShiftSore()


  })

  $('.select2bs4').on('change', (e) => {
    const t = $(e.currentTarget)
    $('#simpanKeterangan').prop("disabled", false)

    if(t.val().length == 0 ) {
      $('#simpanKeterangan').prop("disabled", true)
    }
  })

</script>

<script>
  let setGlobalVar = async() => {
    _global = {
      absensi: await getAbsensi(),
    }
    new Promise(resolve => {
      resolve(_global)
    })
  }

</script>

<!-- script for absensi -->
<script>

  let getAbsensi = async () => {
    const today = new Date()
    const tahun = today.getFullYear()
    const bulan = today.getMonth()
    const tanggal = today.getDate()

    let response = await fetch(`<?= base_url() ?>/dashboard/getAbsensiHariIni?tanggal=${tahun}-${bulan+1}-${tanggal}`)
    let data = await response.json()
    return new Promise((resolve) => {
      resolve(data)
    })
  }

  let getShiftPagi = () => {
    $('.shift-pagi').html('')

    let shiftPagi = ''
    for(i = 0; i < _global.absensi.length; i++) {
      shiftPagi+= `<ul class="list-item">
        <li>${_global.absensi[i].nama}</li>
        <li
          style="color: ${_global.absensi[i].shift_pagi == null || _global.absensi[i].shift_pagi == "Tanpa Keterangan" ? "var(--danger)" : (_global.absensi[i].shift_pagi[0] <= 1 ? "var(--success)" : "var(--purple)")  };
                  font-weight: 700;">
          ${_global.absensi[i].shift_pagi == null ? "-" : (_global.absensi[i].shift_pagi[0] <= 1 ? "Mengajar" : _global.absensi[i].shift_pagi)  }
          </li>
      </ul>
      `
    }
    $('.shift-pagi').html(shiftPagi)
    console.log('triggered')
  }

  let getShiftSiang = () => {
    let shiftSiang = ''
    for(i = 0; i < _global.absensi.length; i++) {
      shiftSiang+= `<ul class="list-item">
        <li>${_global.absensi[i].nama}</li>
        <li
          style="color: ${_global.absensi[i].shift_siang == null || _global.absensi[i].shift_siang == "Tanpa Keterangan"? "var(--danger)" : (_global.absensi[i].shift_siang[0] <= 1 ? "var(--success)" : "var(--purple)")  };
                  font-weight: 700;">
          ${_global.absensi[i].shift_siang == null ? "-" : (_global.absensi[i].shift_siang[0] <= 1 ? "Mengajar" : _global.absensi[i].shift_siang)  }
          </li>
      </ul>
      `
    }
    $('.shift-siang').html(shiftSiang)
  }

  let getShiftSore = () => {
    let shiftSore = ''
    for(i = 0; i < _global.absensi.length; i++) {
      shiftSore+= `<ul class="list-item">
        <li>${_global.absensi[i].nama}</li>
        <li
          style="color: ${_global.absensi[i].shift_sore == null || _global.absensi[i].shift_sore == "Tanpa Keterangan"? "var(--danger)" : (_global.absensi[i].shift_sore[0] <= 2 ? "var(--success)" : "var(--purple)")  };
                  font-weight: 700;">
          ${_global.absensi[i].shift_sore == null ? "-" : (_global.absensi[i].shift_sore[0] <= 2 ? "Mengajar" : _global.absensi[i].shift_sore)  }
          </li>
      </ul>
      `
    }
    $('.shift-sore').html(shiftSore)
  }

</script>
<script src="/dist/js/qr-scanner.umd.min.js"></script>
<script>
  const videoElem = document.querySelector('video')
  const qrScanner = new QrScanner(videoElem, async(result) => {
    let d = new Date()
    let h = d.getHours()

    let shift = "shift_sore"
    if(h <= 14) shift = "shift_siang"
    if(h <= 11) shift = "shift_pagi"

    let response = await  fetch(`<?= base_url() ?>/absen/doAbsen?id=${result}&shift=${shift}`)
    let text = await response.text()
    alert(text)
    await setGlobalVar()

    return shift == "shift_pagi" ? getShiftPagi() : ( shift == "shift_siang" ? getShiftSiang() : getShiftSore() )

  })

  let Scan = action => {
    return action == "start" ? qrScanner.start() : qrScanner.stop()
  }

  $('#scannerModal').on('hide.bs.modal', function (e) {
     Scan('stop')
  })
</script>


</body>

</html>