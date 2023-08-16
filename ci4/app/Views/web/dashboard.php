<?= $this->extend('layout') ?>
<?= $this->section('isi')?>
    <!-- baris icon beranda -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12 w3-animate-zoom">
            <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-inbox"></i></span>
            <div class="info-box-content">
                <a href="http://localhost/aplikasi-peminjaman/admin/barang">Barang</a>
                <!--<span class="info-box-text">Barang</span>-->
                <span class="info-box-number">8</span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12 w3-animate-zoom">
            <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <a href="http://localhost/aplikasi-peminjaman/admin/anggota">Anggota</a>
                <!--<span class="info-box-text">Anggota</span>-->
                <span class="info-box-number">2</span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12 w3-animate-zoom">
            <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <a href="http://localhost/aplikasi-peminjaman/admin/pinjam">Peminjaman</a>
                <!--<span class="info-box-text">Peminjam</span>-->
                <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12 w3-animate-zoom">
            <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
            <a href="http://localhost/aplikasi-peminjaman/admin/kembali">Pengembalian</a>
                <!--<span class="info-box-text">Transaksi</span>-->
                <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
        <div class="row">
        <div class="col-md-4 w3-animate-zoom">
            
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Anggota terdaftar</h3>
                <div class="card-tools">
                
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="users-list clearfix">
                                    <li>
                                        <img style="width:50px; height:50px;" src="http://localhost/aplikasi-peminjaman/admin-lte-master/foto/agt/2023-02-271.png" alt="Image">
                                        <a class="users-list-name" href="#">Joko</a>
                    <span class="users-list-date">111111</span>
                </li>
                                    <li>
                                        <img style="width:50px; height:50px;" src="http://localhost/aplikasi-peminjaman/admin-lte-master/foto/agt/2023-04-061.png" alt="Image">
                                        <a class="users-list-name" href="#">Petugas</a>
                    <span class="users-list-date">123456</span>
                </li>
                                </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="javascript::">View All Users</a>
            </div>
            <!-- /.card-footer -->
            </div>

        </div>
    </div>
<?= $this->endSection()?>