<div class="form-error mt-2">
    <?php echo form_error('kd_pelanggan', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?php echo form_error('nama_pelanggan', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?php echo form_error('alamat', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?php echo form_error('no_telp', '<div class="alert alert-danger" role="alert">', '</div>') ?>
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
                    <th>Kode pelanggan</th>
                    <th>Nama pelanggan</th>
                    <th>Alamat pelanggan</th>
                    <th>No Telpon pelanggan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pelanggan as $row) {
                    $no++; ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row['kd_pelanggan'] ?></td>
                        <td><?= $row['nama_pelanggan'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['no_telp'] ?></td>
                        <td>
                            <a href="javascript:void()" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-warning" title="edit" onclick="edit(
                                '<?= $row['id'] ?>',
                                '<?= $row['kd_pelanggan'] ?>',
                                '<?= $row['nama_pelanggan'] ?>',
                                '<?= $row['alamat'] ?>',
                                '<?= $row['no_telp'] ?>'
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
                <h5 class="modal-title" id="exampleModalLabel">Form pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master_data/pelanggan') ?>" method="post" id="form">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label>Kode pelanggan</label>
                        <input type="text" class="form-control" id="kd_pelanggan" name="kd_pelanggan" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                    </div>
                    <div class="form-group">
                        <label>Alamat pelanggan</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>No telfon pelanggan</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp">
                        <input type="hidden" class="form-control" id="no_telp_sebelum" name="no_telp_sebelum">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let url_edit = "<?= base_url('master_data/edit_pelanggan') ?>"

    function edit(id, kd_pelanggan, nama_pelanggan, alamat, no_telp) {
        $('#form').attr('action', url_edit);
        $('#id').val(id);
        $('#kd_pelanggan').val(kd_pelanggan);
        $('#nama_pelanggan').val(nama_pelanggan);
        $('#alamat').val(alamat);
        // $('#no_telp').val(no_telp);
        $('#no_telp_sebelum').val(no_telp);
    }
    $(function() {
        $('#example').DataTable();
    });
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                nama_pelanggan: {
                    required: true
                },
                alamat: {
                    required: true
                },
                no_telp: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                nama_pelanggan: {
                    required: "Inputan tidak boleh kosong"
                },
                alamat: {
                    required: "Inputan tidak boleh kosong"
                },
                no_telp: {
                    required: "Inputan tidak boleh kosong",
                    digits: "Inputan harus angka"
                }
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>