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
        <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="tambah()">
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
                        <td class="text-right"><?= format_rp($row['harga_sewa'])  ?></td>
                        <td class="text-center">
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" title="edit" onclick="edit(
                                '<?= $row['id'] ?>',
                                '<?= $row['kd_tipe'] ?>',
                                '<?= $row['nama_alber'] ?>',
                                '<?= $row['jenis_id'] ?>',
                                '<?= $row['merk'] ?>',
                                '<?= $row['harga_sewa'] ?>',
                                '<?= $row['harga_sewa_khusus'] ?>',
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
                <form action="<?= base_url('master_data/alat_berat') ?>" method="post" id="form">
                    <div class="form-group">
                        <label>Kode tipe</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" id="kd_tipe" name="kd_tipe" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Alat Berat</label>
                        <input type="text" class="form-control" id="nama_alber" name="nama_alber">
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
                        <input type="text" class="form-control" name="merk" id="merk">
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa</label>
                        <input type="text" class="form-control" name="harga_sewa" id="harga_sewa">
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa khusus</label>
                        <input type="text" class="form-control" name="harga_sewa_khusus" id="harga_sewa_khusus">
                    </div>
                    <!-- <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" class="form-control" name="satuan">
                    </div> -->

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function edit(id, kd_tipe, nama_alber, jenis, merk, harga_sewa, harga_sewa_khusus) {
        let url_edit = "<?= base_url('master_data/edit_alat_berat') ?>"
        $('#form').attr('action', url_edit)
        $('#id').val(id)
        $('#kd_tipe').val(kd_tipe)
        $('#nama_alber').val(nama_alber)
        $('#jenis').val(jenis)
        $('#merk').val(merk)
        $('#harga_sewa').val(harga_sewa)
        $('#harga_sewa_khusus').val(harga_sewa_khusus)
    }

    function tambah() {
        $('#form').find('input[type="text"],select').val('');
        let url_tambah = "<?= base_url('master_data/alat_berat') ?>"
        $('#form').attr('action', url_tambah);
        let kode = "<?= $kode ?>";
        $('#kd_tipe').val(kode)
    }
    $(function() {
        $('#example').DataTable();
    });
</script>