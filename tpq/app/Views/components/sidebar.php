<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-purple" style="overflow: hidden;">
  <img src="/dist/img/logoQiroati.png" alt="" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); opacity: .05; pointer-events: none; width: 100%;">
  <!-- Brand Logo -->
  <a href="/" class="brand-link text-center">
    <!-- <img src="/dist/img/logoQiroati.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 33px; height: auto;"> -->
    <span class="brand-text font-weight-light">Absensi Al-Muhajirin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/" class="nav-link <?= ($active == "dashboard") ? "active" : "" ?>">
            <i class="nav-icon fa fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/absen" class="nav-link <?= ($active == "absen") ? "active" : "" ?>">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Rekap Absensi & Bisaroh
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Data
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/ustadz" class="nav-link <?= ($active == "ustadz") ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Ustadz / Ustadzah</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/data/santri" class="nav-link <?= ($active == "santri") ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Santri</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<style>
  [class*=sidebar-light-] .nav-treeview>.nav-item>.nav-link.active,
  [class*=sidebar-light-] .nav-treeview>.nav-item>.nav-link.active:hover {
    background-color : #6f42c1;
    color: white;
  }
</style>