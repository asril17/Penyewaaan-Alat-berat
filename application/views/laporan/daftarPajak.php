<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo site_url('laporan/daftar_pajak') ?>">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-5 ">
                        <label>Pilih Bulan</label>
                        <select class="form-control select2" name="bulan">
                            <option disabled selected>--pilih bulan--</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-md-5 ">
                        <label>Pilih Tahun</label>
                        <select class="form-control select2" name="tahun">
                            <option disabled selected>--pilih tahun--</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                        </select>
                    </div>
                    <div class="col-md-2 ">
                        <label></label><br><br>
                        <button type="submit" class="btn btn-primary "><i class="fa fa-list"></i> filter</button>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        <?php if (!empty($_POST['bulan'])) : ?>
            <center>
                <!-- <h2>Balai Latihan Kerja Bandung</h2> -->
                <h3>Daftar Pajak</h3>
                <h4>Periode : <?php echo 'Bulan ' . get_monthname($_POST['bulan']) . ' Tahun ' . $_POST['tahun'] ?> </h4>
            </center>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Penyewaan</th>
                        <th>Tanggal</th>
                        <th>Nama Alat Berat</th>
                        <th>Nominal Pajak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    $total = 0;
                    foreach ($pajak as $pj) :
                        $total += $pj['nominal_pajak'];
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pj['kd_penyewaan'] ?></td>
                            <td><?= date("d-m-Y", strtotime($pj['tgl_transaksi']));  ?></td>
                            <td><?= $pj['nama_alber'] ?></td>
                            <td class="text-right"><?= format_rp($pj['nominal_pajak']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tr>
                    <th class="text-left" colspan="3">Total</th>
                    <th class="text-right" colspan="2"><?= format_rp($total) ?></th>
                </tr>
            </table>
            <br>
        <?php endif ?>
    </div>
</div>
<script>
    $(function() {
        $('#example').DataTable();
    });
</script>