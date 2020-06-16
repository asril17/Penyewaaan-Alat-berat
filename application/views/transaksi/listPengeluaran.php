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
                        <td><?= $row['tgl_pengeluaran'] ?></td>
                        <td><?= $row['nama_alber'] ?></td>
                        <td><?= format_rp($row['nominal']) ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function() {
        $('#example').DataTable();
    });
</script>