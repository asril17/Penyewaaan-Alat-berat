<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
        <a href="<?= base_url('transaksi/tambahPengeluaran') ?>" class="btn btn-primary pull-right btn-sm">
            <i class="fa fa-plus"> Tambah Data</i>
        </a>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered">
            <thead class="text-capitalize">
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Alat Berat</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pengeluaran as $row) {
                    $no++; ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td class="text-right"><?= date("d-m-Y", strtotime($row['tgl_pengeluaran']));  ?></td>
                        <td><?= $row['nama_alber'] ?></td>
                        <td class="text-right"><?= format_rp($row['nominal']) ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td class="text-center">
                            <a href="javascript:void()" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-warning" title="edit" onclick="edit(
                                '<?= $row['id'] ?>',
                                '<?= $row['tgl_pengeluaran'] ?>',
                                '<?= $row['alat_berat_id'] ?>',
                                '<?= $row['nominal'] ?>',
                                '<?= $row['deskripsi'] ?>'
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('transaksi/editPengeluaran') ?>" method="post" id="form">
                    <div class="form-group">
                        <label for="">Tanggal Pengeluaran *</label>
                        <input type="hidden" name="id" id="id">
                        <input type="datetime" class="form-control" id="tgl_pengeluaran" name="tgl_pengeluaran" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Alat Berat*</label>
                        <select name="alat_berat" id="alat_berat" class="form-control">
                            <option value="">Plih Alat Berat</option>
                            <?php foreach ($alat_berat as $key => $value) : ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nama_alber ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nominal *</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
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
    function edit(id, tgl_pengeluaran, nama_alber, nominal, deskripsi) {
        $('#id').val(id);
        $('#tgl_pengeluaran').val(tgl_pengeluaran);
        $('#alat_berat').val(nama_alber);
        $('#nominal').val(nominal);
        $('#deskripsi').val(deskripsi);
    }
    $(function() {
        $('#example').DataTable();
    });
</script>