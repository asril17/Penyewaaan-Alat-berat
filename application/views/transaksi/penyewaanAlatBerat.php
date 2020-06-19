<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
        <a href="<?= base_url('transaksi/tambahPenyewaan') ?>" class="btn btn-primary pull-right btn-sm">
            <i class="fa fa-plus"> Tambah Data</i>
        </a>
    </div>
    <div class="card-body">
        <table id="example" class="table-responsive table-bordered">
            <thead class="text-capitalize">
                <tr>
                    <th>No</th>
                    <th>Kode Penyewaan</th>
                    <th>Tanggal Penyewaan</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Nominal</th>
                    <th>Uang Muka</th>
                    <th>Sisa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pny as $row) {
                    $no++; ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row['kd_penyewaan'] ?></td>
                        <td><?= $row['tgl_mulai'] ?></td>
                        <td><?= $row['tgl_berakhir'] ?></td>
                        <td class="text-right"><?= format_rp($row['nominal']) ?></td>
                        <td class="text-right"><?= format_rp($row['jml_bayar']) ?></td>
                        <td class="text-right"><?= format_rp($row['sisa']) ?></td>
                        <td class="text-right"><?php echo ($row['status'] == 0) ? 'Belum Lunas' : 'Sudah Lunas' ?></td>
                        <td align="center">
                            <?php if ($row['status'] == 1) { ?>
                                <button type="button" class="btn btn-primary" disabled> Sudah Lunas </button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-Warning" onclick="location.assign('<?php echo base_url() ?>index.php/transaksi/acc/<?php echo $row['kd_penyewaan'] ?>')"> Lakukan Pelunasan </button>
                            <?php } ?>
                        </td>


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