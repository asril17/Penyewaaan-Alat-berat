<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
    </div>
    <div class="card-body">
        <form action="<?= base_url('transaksi/tambahPenyewaan') ?>" method="post">
            <div class="form-group">
                <label for="">Kode Penyewaan</label>
                <input type="text" name="kd_penyewaan" class="form-control" value="<?= $kode ?>" readonly>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Tanggal Penyewaan</label>
                        <input type="date" name="tgl_sewa" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="">Tanggal Pengembalian</label>
                        <input type="date" name="tgl_expired"min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" class="form-control">
                        <div class="text-danger"><?= form_error('tgl_expired', '<small class="text-danger pl-3">', '</small>') ?></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Nama Pelanggan</label>
                        <select name="kd_pelanggan" id="" class="form-control">
                            <option disabled selected>--Pilih Nama Pelanggan--</option>
                            <?php foreach ($pl as $row) { ?>
                                <option value="<?= $row['kd_pelanggan'] ?>"><?= $row['nama_pelanggan'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="text-danger"><?= form_error('kd_pelanggan', '<small class="text-danger pl-3">', '</small>') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Nama Alat Berat</label>
                        <select name="kd_alat_berat" id="" class="form-control">
                            <option disabled selected>--Pilih Nama Alat Berat--</option>
                            <?php foreach ($alber as $row) { ?>
                                <option value="<?= $row['kd_tipe'] ?>"><?= $row['nama_alber'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="text-danger"><?= form_error('kd_alat_berat', '<small class="text-danger pl-3">', '</small>') ?></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Nama Supir</label>
                <select name="kd_pegawai" class="form-control">
                    <option disabled selected>--Pilih Nama Supir--</option>
                    <option value="1">Tanpa supir</option>
                    <?php foreach ($pegawai as $row) { ?>
                        <?php if ($row['status_sopir']==1) { ?>
                        <option disabled value="<?= $row['kd_pegawai'] ?>"><?= $row['nama_pegawai'] ?></option>
                    <?php  } else { ?>
                        <option value="<?= $row['kd_pegawai'] ?>"><?= $row['nama_pegawai'] ?></option>

                    <?php } ?>


                    <?php } ?> 
                </select>

                <div class="text-danger"><?= form_error('kd_alat_berat', '<small class="text-danger pl-3">', '</small>') ?></div>
            </div>
            <br>

            <div class="form-group ">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</button>

            </div>
        </form>
        <br>
        <?php if (!empty($detail)) { ?>
            <hr>
            <table id="example" class="table table-bordered">
                <thead class="text-capitalize">
                    <tr>
                        <th>Nama Penyewa</th>
                        <th>Nama Alat Berat</th>
                        <th>Nama Supir</th>
                        <th>Biaya Supir</th>
                        <th>Lama Penyewaan</th>
                        <th>Harga sewa</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                        $nominal = 0;
                        foreach ($detail as $row) {
                            $no++; ?>
                        <tr>
                            <td><?= $row['nama_pelanggan'] ?></td>
                            <td><?= $row['nama_alber'] ?></td>
                            <td><?= $row['nama_pegawai'] ?></td>
                            <td><?= format_rp(200000) ?></td>
                            <td><?= $row['lama_penyewaan'] ?></td>
                            <td><?= format_rp($row['harga_sewa']) ?></td>
                            <td><?= format_rp($row['subtotal']) ?></td>
                        </tr>
                    <?php $tgl_exp = $row['tgl_expired'];
                            $nominal += $row['subtotal'];
                        }  ?>
                </tbody>
            </table>

    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-check"></i> Submit
        </button>
    </div>
<?php } ?>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('transaksi/selesaiPny') ?>" method="post">
                    <input type="hidden" name="kd_penyewaan" value="<?= $kode ?>">
                    <input type="hidden" name="tgl_expired" value="<?= $tgl_exp ?>">
                    <input type="hidden" name="nominal" value="<?= $nominal ?>">
                    <div class="form-group">
                        <label for="">Kode Penyewaan</label>
                        <input type="text" class="form-control" value="<?= $kode ?>" readonly>
                    </div>
                    <div>
                        <label for="">Subtotal</label>
                        <input type="text" class="form-control" value="<?= format_rp($nominal) ?>" readonly>
                    </div>
                    <div>
                        <label for="">Jumlah Pembayaran</label>
                        <input type="text" class="form-control" name="jml" value="<?= $nominal / 2 ?>">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
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