<?= $this->extend('layout_konten') ?>
<?= $this->section('isi')?>
    <div id="transaksi">
        <div id="daftar_item">            
            <?php foreach($tabel as $data):?>
            <div>
                <div class="thumbnail">
                    <?php if($data["Foto"]!="")echo("<img src='".$data["Foto"]."'>")?>
                </div>
                <div><?=$data["Nama"]?></div>
                <div><?=$data["Stock"]." ".$data["Satuan"]?></div>
                <div><?="Harga :".$data["Harga_Jual"]?></div>
                <div class="btn btn-info">Tambah</div>
            </div>
            <?PHP endforeach?>
        </div>
        <div>Tes</div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('modal')?>
<?= $this->endSection() ?>

<?= $this->section('script')?>
<?= $this->endSection() ?>