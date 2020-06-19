<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo site_url('laporan/lihat_jurnal') ?>">
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
                <h3>Jurnal Umum</h3>
                <h4>Periode : <?php echo 'Bulan ' . $_POST['bulan'] . ' Tahun ' . $_POST['tahun'] ?> </h4>
            </center>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Ref</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $spasi = '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                    foreach ($jurnal as $row) : ?>
                        <tr>
                            <td><?php echo $row['tgl_jurnal'] ?></td>
                            <?php if ($row['posisi_dr_cr'] == 'debit') : ?>
                                <td><?php echo $row['nama_akun'] ?></td>
                                <td><?php echo $row['kode_akun'] ?></td>
                                <td class="text-right"><?php echo 'Rp. ' . number_format($row['nominal'], 2, ',', '.') ?></td>
                                <td></td>
                            <?php else : ?>
                                <td><?php echo $spasi . $row['nama_akun'] ?></td>
                                <td><?php echo $row['kode_akun'] ?></td>
                                <td></td>
                                <td class="text-right"><?php echo 'Rp. ' . number_format($row['nominal'], 2, ',', '.') ?></td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" align="center"><b>Total</b></td>
                        <td class="text-right"><?php echo "Rp. " . number_format($debit, 2, ',', '.') ?></td>
                        <td class="text-right"><?php echo 'Rp. ' . number_format($credit, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
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