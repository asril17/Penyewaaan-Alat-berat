<div class="form-error mt-2">
    <?php echo form_error('kd_tipe', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?php echo form_error('nama_alber', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?php echo form_error('merk', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?php echo form_error('harga_sewa', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?php echo form_error('satuan', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?php echo $this->session->flashdata('message'); ?>
</div>
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
                    <th>Kode Tipe</th>
                    <th>Nama Alat Berat</th>
                    <th>Jenis Alat Berat</th>
                    <th>Merk</th>
                    <th>Harga Sewa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($alat_berat as $row) {
                    $no++; ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row['kd_tipe'] ?></td>
                        <td><?= $row['nama_alber'] ?></td>
                        <td><?= $row['jenis'] ?></td>
                        <td><?= $row['merk'] ?></td>
                        <!-- <td><?= format_rp($row['harga_sewa']) . '/' . $row['satuan'] ?></td> -->
                        <td><?= format_rp($row['harga_sewa'])  ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" title="edit"><i class="fa fa-edit"></i></a>
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
                <form action="<?= base_url('master_data/alat_berat') ?>" method="post">
                    <div class="form-group">
                        <label>Kode tipe</label>
                        <input type="text" class="form-control" name="kd_tipe" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Alat Berat</label>
                        <input type="text" class="form-control" name="nama_alber">
                    </div>
                    <div class="form-group">
                        <label>Jenis Alat Berat</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="" disabled selected>Pilih....</option>
                            <?php foreach ($jenis_alat_berat as $jab) : ?>
                                <option value="<?= $jab['id'] ?>"><?= $jab['jenis'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Merk</label>
                        <input type="text" class="form-control" name="merk">
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa</label>
                        <input type="text" class="form-control" name="harga_sewa">
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" class="form-control" name="satuan">
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