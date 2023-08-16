<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <link rel="icon" type="image/png" href="<?=base_url() ?>/asset-user\img\favicon.png" />
    <script src="<?=base_url() ?>/admin-lte-master/plugins/jquery/jquery.min.js"></script>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Asset/styleku.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url() ?>/admin-lte-master/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url() ?>/admin-lte-master/dist/css/adminlte.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?=base_url() ?>/admin-lte-master/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <?php date_default_timezone_set("Asia/Jakarta"); ?>
                <a href="#" class="nav-link"> <?=date('Y-m-d') ?> </a>
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="badge badge-warning navbar-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    Developer
                <button type="button" onclick="window.location.href='<?=base_url() ?>admin/logout' " class="btn btn-danger float-right">Logout</button>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                    class="fa fa-th-large"></i></a>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?=base_url()?>/admin" class="brand-link">
                <img src="<?=base_url() ?>/admin-lte-master/dist/img/sbi.jpeg" alt="AdminLTE Logo" class="brand-image img-circle"
                style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <?php
                        $i=0;
                        $ikon=["fa fa-dashboard", "fa fa-list", "fa fa-briefcase", "fa fa-user", "fa fa-users", "fa fa-truck", "fa fa-briefcase"];
                        $link=["Dashboard" => "dashboard", "Kategori" => "kategori", "Satuan" => "satuan", "Pengguna" => "users", "Pelanggan" => "pelanggan", "Supplier" => "supplier", "Obat" => "obat"];
                        foreach($link as $s => $alamat):
                    ?>
                    <li class="nav-item">
                        <a href="<?=base_url($alamat)?>" class="nav-link">
                        <i class="nav-icon <?=$ikon[$i]?>"></i>
                            <p><?=$s?></p>
                        </a>
                    </li>
                    <?php
                        $i++;
                        endforeach;
                    ?>
                    <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa fa-truck"></i>
                        <p>Transaksi<i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul style="margin-left:8px;" class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="<?=base_url("penjualan")?>" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Barang Masuk</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="<?=base_url("penjualan")?>" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Barang Keluar</p>
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

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?=$judul?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="content">
                <?php if($data):?>
                <button class="btn btn-success" data-toggle='modal' data-target='#modal_tambah'>Tambah Data</button><br />
                <table id="tabel_data">
                    <thead>
                        <tr>
                            <?php
                                foreach($header as $s):
                            ?>
                            <th><?=$s?></th>
                            <?PHP endforeach?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tabel as $data):?>
                        <tr>
                            <?php
                                foreach($kolom as $s):
                            ?>
                                <td><?=$data[$s]?></td>
                            <?PHP endforeach?>
                            <td>
                                <div class="btn btn-warning btn-sm" data-toggle='modal' data-target='#modal_edit'
                                    data-id=<?=$data["id"]?>
                                    <?php
                                        foreach($kolom as $s){
                                            echo("data-".$s."='".$data[$s]."'");
                                        }
                                    ?>
                                ><i class="fa fa-pencil"></i></div>&nbsp;
                                <a href="<?=base_url($controller.'/hapus/'.$data["id"])?>"><div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div></a>
                            </td>
                        </tr>
                        <?PHP endforeach?>
                    </tbody>
                </table>
                <?php else:?>
                    <?= $this->renderSection('isi') ?>
                <?php endif;?>
            </div>
        </div>
        
        <?= $this->renderSection('modal') ?>

        <footer class="main-footer">
            <strong>Copyright &copy; 2019 <a href="http://adminlte.io">Power By AdminLTE</a>
                <b>Version</b> 3.0.0
            </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <?= $this->renderSection('script') ?>
        <script src="<?=base_url() ?>sijek/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url() ?>/admin-lte-master/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?=base_url() ?>/admin-lte-master/plugins/knob/jquery.knob.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?=base_url() ?>/admin-lte-master/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?=base_url() ?>/admin-lte-master/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?=base_url() ?>/admin-lte-master/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url() ?>/admin-lte-master/dist/js/adminlte.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?=base_url() ?>/admin-lte-master/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?=base_url() ?>/admin-lte-master/dist/js/demo.js"></script>
    </body>
</html>