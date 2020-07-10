<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo site_url('laporan/buku_besar') ?>">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 ">
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
                    <div class="col-md-3 ">
                        <label>Pilih Tahun</label>
                        <select class="form-control select2" name="tahun">
                            <option disabled selected>--pilih tahun--</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                        </select>
                    </div>
                    <div class="col-md-3 ">
                        <label>pilih akun</label>
                        <select class="form-control select2" name="akun">
                            <option disabled selected>--pilih akun--</option>
                            <?php foreach ($coa as $row) { ?>
                                <option value="<?php echo $row['kode_akun'] ?>"><?php echo $row['nama_akun'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2 ">
                        <label></label><br><br>
                        <button type="submit" class="btn btn-primary "><i class="fa fa-filter"></i> filter</button>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        <?php if (!empty($_POST['bulan'])) : ?>
            <hr>
            <center>
                <strong>
                    <!-- <h2>Balai Latihan Kerja</h2> -->
                    <h3>Buku Besar</h3>
                    <h4> <?= $akun['nama_akun'] ?></h4>
                    <h4>Periode Bulan <?php echo get_monthname($_POST['bulan']) . ' Tahun ' . $_POST['tahun'] ?></h4>
                </strong>
            </center>
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align: center;">Tanggal</th>
                            <th rowspan="2" style="text-align: center;">Keterangan</th>
                            <th rowspan="2" style="text-align: center;">Ref</th>
                            <th rowspan="2" style="text-align: center;">Debit</th>
                            <th rowspan="2" style="text-align: center;">Kredit</th>
                            <th colspan="2" style="text-align: center">saldo</th>
                        <tr>
                            <th>debit</th>
                            <th>kredit</th>
                        </tr>
                        </tr>
                        <?php if ($akun['header_akun'] == 1 or $akun['header_akun'] == 5) {
                            $col = 5;
                        } else {
                            $col = 6;
                        } ?>
                        <tr>
                            <th class="text-left" colspan="<?= $col ?>">Saldo Awal</th>
                            <th class="text-right" colspan="1"><?= 'Rp ' . number_format($saldoo, 2, ',', '.') ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $saldo_awal = 0;
                        foreach ($buku_besar as $row) : ?>
                            <tr>
                                <td><?php echo $row['tgl_jurnal'] ?></td>
                                <td><?php echo $row['nama_akun'] ?></td>
                                <?php if ($row['posisi_dr_cr'] == 'debit') :
                                    $saldo_awal = $saldo_awal + $row['nominal'];


                                ?>
                                    <td>JU1</td>
                                    <td class="text-right"><?php echo 'Rp. ' . number_format($row['nominal'], 2, ',', '.') ?></td>
                                    <td></td>
                                    <td class="text-right"><?php echo 'Rp. ' . number_format($saldo_awal, 2, ',', '.') ?></td>
                                    <td></td>
                            </tr>
                        <?php else : ?>
                            <?php if ($akun['header_akun'] == 1 or $akun['header_akun'] == 5) {
                                        $saldo_awal = $saldo_awal - $row['nominal'];
                                    } else {
                                        $saldo_awal = $saldo_awal + $row['nominal'];
                                    }
                            ?>
                            <td>JU1</td>
                            <td></td>
                            <td class="text-right"><?php echo 'Rp. ' . number_format($row['nominal'], 2, ',', '.') ?></td>
                            <?php
                                    // if ($saldo_awal >= 0) {
                                    //     $saldo_awal = $saldo_awal;
                                    // } else {
                                    //     $saldo_awal = str_replace("-", "", $saldo_awal);
                                    // }

                            ?>
                            <?php if ($akun['header_akun'] == 1 or $akun['header_akun'] == 5) : ?>
                                <td class="text-right"><?php echo 'Rp. ' . number_format($saldo_awal, 2, ',', '.') ?></td>
                                <td></td>
                            <?php else : ?>
                                <td></td>
                                <td class="text-right"><?php echo 'Rp. ' . number_format(abs($saldo_awal), 2, ',', '.') ?></td>
                            <?php endif ?>
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php if ($akun['header_akun'] == 1 or $akun['header_akun'] == 5) {
                        $col = 5;
                    } else {
                        $col = 6;
                    } ?>
                    <tr>
                        <th class="text-left" colspan="<?= $col ?>">Saldo Akhir</th>
                        <th class="text-right" colspan="1"><?= 'Rp ' . number_format($saldo_awal, 2, ',', '.') ?></th>
                    </tr>
                </table>
            </div>
        <?php endif ?>
    </div>
</div>
<script>
    $(function() {
        $('#example').DataTable();
    });
</script>