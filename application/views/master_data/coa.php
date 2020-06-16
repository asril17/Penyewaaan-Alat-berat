<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
        <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus"> Tambah Data</i>
        </button>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>Header Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($coa as $row) {
                    $no++; ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row['kode_akun'] ?></td>
                        <td><?= $row['nama_akun'] ?></td>
                        <td><?= $row['header_akun'] ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Form COA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master_data/coa') ?>" method="post">
                    <div class="form-group">
                        <label>Kode Akun</label>
                        <input type="text" class="form-control" name="kd_akun">
                        <?php echo form_error('kd_akun', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                    </div>
                    <div class="form-group">
                        <label>Nama Akun</label>
                        <input type="text" class="form-control" name="nama_akun">
                        <?php echo form_error('nama_akun', '<div class="alert alert-danger" role="alert">', '</div>') ?>  
                    </div>
                    <div class="form-group">
                        <label>Header Akun</label>
                        <input type="text" class="form-control" name="header_akun">
                        <?php echo form_error('header_akun', '<div class="alert alert-danger" role="alert">', '</div>') ?>
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
    $(function() {
        $('#example').DataTable();
    });
</script>