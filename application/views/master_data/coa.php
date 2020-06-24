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
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>Header Akun</th>
                    <!-- <th>Aksi</th> -->
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
                        <!-- <td>
                            <a href="javascript:void()" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-warning" title="edit" onclick="edit(
                                '<?= $row['kode_akun'] ?>',
                                '<?= $row['nama_akun'] ?>',
                                '<?= $row['header_akun'] ?>'
                            )"><i class="fa fa-edit"></i></a>
                        </td> -->
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

                <form action="<?= base_url('master_data/coa') ?>" method="post" id="form">
                    <div class="form-group">
                        <label>Kode Akun</label>
                        <input type="text" class="form-control" id="kd_akun" name="kd_akun">
                    </div>
                    <div class="form-group">
                        <label>Nama Akun</label>
                        <input type="text" class="form-control" id="nama_akun" name="nama_akun">
                    </div>
                    <div class="form-group">
                        <label>Header Akun</label>
                        <input type="text" class="form-control" id="header_akun" name="header_akun">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let url_edit = "<?= base_url('master_data/edit_coa') ?>"

    function edit(kode_akun, nama_akun, header_akun) {
        $('#form').attr('action', url_edit);
        $('#kd_akun').val(kode_akun);
        $('#nama_akun').val(nama_akun);
        $('#header_akun').val(header_akun);
    }

    function tambah() {
        let url_tambah = "<?= base_url('master_data/coa') ?>"
        $('#form').attr('action', url_tambah)
        $('#form').find('input[type="text"]').val('');
    }
    $(function() {
        $('#example').DataTable();
    });
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                kd_akun: {
                    required: true,
                    digits: true
                },
                nama_akun: {
                    required: true
                },
                header_akun: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                kd_akun: {
                    required: "Inputan tidak boleh kosong",
                    digits: true
                },
                nama_akun: {
                    required: "Inputan tidak boleh kosong"
                },
                header_akun: {
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