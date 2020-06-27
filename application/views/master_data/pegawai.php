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
                    <th>Kode pegawai</th>
                    <th>Nama pegawai</th>
                    <th>No Telpon pegawai</th>
                    <th>Alamat</th>
                    <th>Tarif pegawai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pegawai as $row) {
                    $no++; ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row['kd_pegawai'] ?></td>
                        <td><?= $row['nama_pegawai'] ?></td>
                        <td><?= $row['no_telp'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td class="text-right"><?= format_rp($row['biaya']) ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" title="edit" data-toggle="modal" data-target="#exampleModal" onclick="edit(
                                '<?= $row['id'] ?>',
                                '<?= $row['kd_pegawai'] ?>',
                                '<?= $row['nama_pegawai'] ?>',
                                '<?= $row['alamat'] ?>',
                                '<?= $row['no_telp'] ?>',
                                '<?= $row['biaya'] ?>',
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
                <h5 class="modal-title" id="exampleModalLabel">Form pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master_data/pegawai') ?>" method="post" id="form">
                    <div class="form-group">
                        <label>Kode pegawai</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" name="kd_pegawai" id="kd_pegawai" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai">
                    </div>
                    <div class="form-group">
                        <label>Alamat pegawai</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>No telfon pegawai</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp">
                        <input type="hidden" class="form-control" id="no_telp_sebelum" name="no_telp_sebelum">
                    </div>
                    <div class="form-group">
                        <label>Tarif</label>
                        <input type="text" class="form-control" id="biaya" name="biaya">
                        <b class="error" id="errtarif"></b>
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
    function edit(id, kd_pegawai, nama_pegawai, alamat, no_telp, biaya) {
        let url_edit = "<?= base_url('master_data/edit_pegawai') ?>"
        $('#form').attr('action', url_edit)
        $('#id').val(id)
        $('#kd_pegawai').val(kd_pegawai)
        $('#nama_pegawai').val(nama_pegawai)
        $('#alamat').val(alamat)
        // $('#no_telp').val(no_telp)
        $('#biaya').val(biaya)
        $('#no_telp_sebelum').val(no_telp);

    }

    function tambah() {
        $('#form').find('input[type="text"],select').val('');
        let url_tambah = "<?= base_url('master_data/pegawai') ?>"
        $('#form').attr('action', url_tambah);
        let kode = "<?= $kode ?>";
        $('#kd_pegawai').val(kode)
    }
    $(function() {
        $('#example').DataTable();
    });
    $('#biaya').keyup(function() {
        let val = $(this).val();
        let min = 200000;
        if (val < min) {
            $(this).addClass('is-invalid')
            $('#errtarif').html('Tarif minimal Rp 200.000')
        } else {
            $('#errtarif').html('')
            $(this).removeClass('is-invalid')

        }
        console.log('dsfsdfds')

    });
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                nama_pegawai: {
                    required: true
                },
                alamat: {
                    required: true
                },
                no_telp: {
                    required: true,
                    digits: true
                },
                biaya: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                nama_pegawai: {
                    required: "Inputan tidak boleh kosong"
                },
                alamat: {
                    required: "Inputan tidak boleh kosong"
                },
                no_telp: {
                    required: "Inputan tidak boleh kosong",
                    digits: "Inputan harus angka"
                },
                biaya: {
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