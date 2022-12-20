<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
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


        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel_absensi" class="table table-striped table-bordered table-hover w-100">
              <thead>
                <tr style="border-top-left-radius: .75rem; border-top-right-radius: .75rem;">
                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Nama Ustad/dzah</th>
                  <?php
                  foreach ($tanggal as $v) {
                    echo "<th colspan='3' class='text-center'>$v->tanggal_absen</th>";
                  }
                  ?>
                </tr>
                <tr>
                  <?php
                  foreach ($tanggal as $v) {
                    echo "<th class='text-center statics'>Pagi</th>
            <th class='text-center statics'>Siang</th>
            <th class='text-center statics'>Sore</th>";
                  }
                  ?>
                </tr>
              </thead>
              <tbody>


                <?php
                $tanggalLength = count($tanggal);
                $length = count($absensi);
                $row = '';
                $ust = '';
                $alpha = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-times text-danger" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Tidak Masuk"></a>';
                for ($i = 0; $i < $length; $i++) {
                  if ($ust != $absensi[$i]->id_ust) {
                    $row .= "<tr><td>" . $absensi[$i]->nama . "</td>";
                  }

                  $ust = $absensi[$i]->id_ust;

                  for ($j = 0; $j < $tanggalLength; $j++) {


                    if ($absensi[$i]->tanggal_absen == $tanggal[$j]->tanggal_absen) {


                      if ($absensi[$i]->shift_pagi == 'I') {
                        $shift_pagi = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-info" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Izin"></a>';
                      } else if ($absensi[$i]->shift_pagi == 'S') {
                        $shift_pagi = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-medkit" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Sakit"></a>';
                      } else {
                        $shift_pagi = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-check text-success" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Absen jam ' . $absensi[$i]->shift_pagi . '"></a>';
                      }

                      if ($absensi[$i]->shift_siang == 'I') {
                        $shift_siang = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-info" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Izin"></a>';
                      } else if ($absensi[$i]->shift_siang == 'S') {
                        $shift_siang = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-medkit" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Sakit"></a>';
                      } else {
                        $shift_siang = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-check text-success" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Absen jam ' . $absensi[$i]->shift_siang . '"></a>';
                      }

                      if ($absensi[$i]->shift_sore == 'I') {
                        $shift_sore = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-info" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Izin"></a>';
                      } else if ($absensi[$i]->shift_sore == 'S') {
                        $shift_sore = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-medkit" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Sakit"></a>';
                      } else {
                        $shift_sore = '<a tabindex="0" data-placement="top" class="w-100 h-100 fa fa-check text-success" role="button" data-toggle="popover" data-trigger="focus" title="Keterangan" data-content="Absen jam ' . $absensi[$i]->shift_sore . '"></a>';
                      }


                      $row .= "<td class='text-center'>" . (($absensi[$i]->shift_pagi != Null) ? $shift_pagi : $alpha) . "</td>" . //pagi
                        "<td class='text-center'>" . (($absensi[$i]->shift_siang != Null) ? $shift_siang : $alpha)  . "</td>" . //siang
                        "<td class='text-center'>" . (($absensi[$i]->shift_sore != Null) ? $shift_sore : $alpha) . "</td>"; //sore

                      break;
                    }
                  }

                  if (($i + 1) == $length || $ust != $absensi[$i + 1]->id_ust) { // jika next ust != current ust
                    $row .= "</tr>";
                  }
                }

                echo $row;
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            &copy; 2020 | Absensi Ustadz / Ustadzah TPQ Al-Muhajirin
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>

    </div>
    <div class="tab-pane fade p-3" id="nav-bisaroh" style="border: 1px solid; border-top: none; border-color:#dee2e6;" role="tabpanel" aria-labelledby="nav-bisaroh-tab">...</div>
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
  $(document).ready(() => {
    initTable()

    $('[data-toggle="tooltip"]').tooltip()
    $('[data-toggle="popover"]').popover({
      trigger: 'hover'
    })

    $('.popover-dismiss').popover({
      trigger: 'focus'
    })
  })
</script>

<script>
  let initTable = () => {
    $('#tabel_absensi').DataTable({
      columnDefs: [{
        targets: 'statics',
        searchable: false,
        orderable: false
      }],
      "initComplete": function(settings, json) {
        $('#tabel_absensi').wrap('<div class="dataTables_scroll" />')
      }
    })
  }
</script>
</body>

</html>