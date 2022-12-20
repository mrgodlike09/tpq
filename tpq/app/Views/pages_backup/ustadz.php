<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
  <div class="card card-body">
    <h3>Tabel Ustadz / Ustadzah TPQ Al-Muhajirin</h3>
    <hr>
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Mulai Mengajar</th>
          <th>Amanah</th>
          <th>Syahadah</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($data as $data) {
            echo "
              <tr>
              <td>" . $data['nama'] . "</td>
              <td>" . $data['mulai mengajar'] . "</td>
              <td>" . $data['amanah'] . "</td>
              <td>" . $data['syahadah'] . "</td>
              </tr>
            ";
          }

        ?>
      </tbody>
    </table>
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


<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(() => {
    initTable()
  })

  let initTable = () => {
    $(".table").DataTable({
      paging: false,
      order: [[1, "asc"]],
      columnDefs: [
        {
          targets: [2,-1],
          orderable: false,
          searchable: false
        }
      ]
    })

  }
</script>