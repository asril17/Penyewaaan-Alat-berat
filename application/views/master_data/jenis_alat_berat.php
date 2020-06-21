<div class="form-error mt-2">
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
        </div>
    <?php } ?>
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
        <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#exampleModal" id="tambah" onclick="tambah()">
            <i class="fa fa-plus"> Tambah Data</i>
        </button>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jenis</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($list as $row) {
                    $no++; ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row['kode_jenis'] ?></td>
                        <td><?= $row['jenis'] ?></td>
                        <td class="text-center">
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" title="edit" onclick="edit(
                                '<?= $row['id_jenis'] ?>',
                                '<?= $row['kode_jenis'] ?>',
                                '<?= $row['jenis'] ?>',
                                )"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Alat Berat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master_data/jenis_alat_berat') ?>" method="post" id="form">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label>Kode jenis</label>
                        <input type="text" class="form-control" id="kode_jenis" name="kode_jenis" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" class="form-control" id="jenis" name="jenis">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function edit(id, kode_jenis, jenis) {
        let url_edit = "<?= base_url('master_data/edit_jenis_alat_berat') ?>"
        $('#form').attr('action', url_edit)
        $('#id').val(id)
        $('#kode_jenis').val(kode_jenis)
        $('#jenis').val(jenis)
    }

    function tambah() {
        let url_tambah = "<?= base_url('master_data/jenis_alat_berat') ?>"
        let kode = "<?= $kode ?>";
        $('#form').attr('action', url_tambah)
        $('#kode_jenis').val(kode)
        $('#jenis').val('')
    }

    $(function() {
        $('#example').DataTable();
    });
</script>