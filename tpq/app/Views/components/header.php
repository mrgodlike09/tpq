<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TPQ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/select2/css/select2.css">


  <style>
    .nav-pills .nav-link:not(.active):hover {
      color: var(--purple);
    }

    .brand-link:hover>span {
      letter-spacing: 2px;
      transition: .3s;
    }

    table.dataTable thead tr {
      background-color: var(--purple);
      color: white;
    }

    .dataTables_scroll {
      overflow: auto;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(111, 66, 193, 0.25);
      transition: background .5s;
    }

    td>a.fa-check::before,
    td>a.fa-times::before,
    td>a.fa-calendar-plus::before,
    td>a.fa-info::before {
      filter: drop-shadow(0 2px 3px grey);
    }

    #nav-bisaroh .card {
      border-radius: 0;
    }

    .card-purple.card-outline {
      border-top: 3px solid var(--purple);
    }

    .card-bisaroh>.card-header {
      cursor: pointer;
      transition: background .3s;
    }

    .card-bisaroh>.card-header:hover {
      background-color: rgba(111, 66, 193, .2);
    }

    /* width */
    ::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 5px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      border-radius: 5px;
      background: var(--purple);
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: var(--indigo);
    }

    .tab-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: rgba(255,255,255,1)
    }

    .tab-pane {
      position: relative;
      height: auto;
    }

    .shift-box  {
      padding: 1rem;
    }

    .shift-box > .list-item {
      margin : 0;
      padding: .5rem .25rem;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      list-style: none;
      border-bottom: solid 1px rgba(0,0,0,.3);
    }

    .shift-box > .list-item:nth-child(odd) {
      background-color: rgba(0,0,0,.07)
    }

    .shift-box > .list-item > li {
      padding: 0;
    }

  </style>
</head>

<body class="hold-transition sidebar-mini sidebar-light-purple accent-purple layout-fixed layout-navbar-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <!-- <a title="logout" class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fa fa-power-off"></i>
          </a> -->
          <a class="nav-link" href="#" role="button">
            <i class="fa fa-power-off" tabindex="0" data-toggle="tooltip" role="tooltip" title="logout" data-placement="left"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->