<?= $this->extend('layout') ?>

<?= $this->section('modal')?>
    <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <Form method="post" action="<?=base_url($controller."/tambah")?>">
                    <div class="formku">
                        <label>Nama</label>
                        <input name="nama">
                        <label>Keterangan</label>
                        <input name="keterangan">
                    </div>
                    <?=csrf_field()?>
                    <input type="submit" value="Tambah" class="btn btn-success"/>
                </Form>
            
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <Form method="post" action="<?=base_url($controller."/edit")?>">
                        <div class="formku">            
                            <label>Nama</label>
                                <input type="text" name="nama" id="nama">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan">
                                <input  type="hidden" name="id" id="id">
                            </div>
                        <?=csrf_field()?>
                        <input type="submit" value="Edit" class="btn btn-success"/>
                    </Form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('script')?>
<script>
    $('#modal_edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id =  button.data('id')
        var nama =  button.data('nama')
        var keterangan =  button.data('keterangan')

        $("#id").val(id);
        $("#nama").val(nama);
        $("#keterangan").val(keterangan);
    })
</script>
<?= $this->endSection() ?>