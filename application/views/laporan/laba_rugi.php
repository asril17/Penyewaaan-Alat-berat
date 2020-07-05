<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo site_url('laporan/laba_rugi') ?>">
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
            <div class="row justify-content-center text-center">
                <div class="col-lg-12">
                    <h3>CV. AINUN JAYA</h3>
                    <h3>LAPORAN LABA RUGI</h3>
                    <h4>Periode : <?php echo 'Bulan ' . get_monthname($_POST['bulan']) . ' Tahun ' . $_POST['tahun'] ?> </h4>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <table class="table mt-5">
                        <tr>
                            <th class="text-left">Pendapatan</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="pl-5 text-left">Pendapatan Sewa Alat Berat</td>
                            <td class="text-right"><?= format_rp($total_pendapatan) ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-left">Laba Kotor</th>
                            <th></th>
                            <th class="text-right"><?= format_rp($total_pendapatan) ?></th>
                        </tr>
                        <tr>
                            <th class="text-left">Beban Usaha</th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php $total_pengeluaran = 0;
                        foreach ($coa as $row) :

                            $trans = $this->db->select('SUM(nominal) as nominal')
                                ->where('id_coa', $row['kode_akun'])
                                ->get('transaksi_pengeluaran2');

                            if ($trans->num_rows() > 0) {
                                $trans = $trans->row_array();
                                $total_pengeluaran += $trans['nominal'];

                        ?>

                                <tr>
                                    <td class="pl-5 text-left"><?= $row['nama_akun'] ?></td>
                                    <td class="text-right"><?= format_rp($trans['nominal']) ?></td>
                                    <td></td>
                                </tr>

                        <?php }
                        endforeach; ?>

                        <tr>
                            <th class="text-left">Jumlah Beban Usaha</th>
                            <th></th>
                            <th class="text-right"><?= format_rp($total_pengeluaran) ?></th>
                        </tr>
                        <?php $jumlah_laba_op = $total_pendapatan + $total_pengeluaran ?>
                        <tr>
                            <th class="text-left">Jumlah Laba Operasi</th>
                            <th></th>
                            <th class="text-right"><?= format_rp($jumlah_laba_op) ?></th>
                        </tr>
                        <tr>
                            <th class="text-left">Lain-lain</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="pl-5 text-left">Pendapatan Lain-lain</td>
                            <td class="text-right"><?= format_rp($pendapatan_dll) ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-left">Jumlah Lain-lain</th>
                            <th></th>
                            <th class="text-right"><?= format_rp($pendapatan_dll) ?></th>
                        </tr>
                        <?php $laba_sebelum_pajak = $jumlah_laba_op + $pendapatan_dll ?>
                        <tr>
                            <th class="text-left">Laba sebelum pajak penghasilan</th>
                            <th></th>
                            <th class="text-right"><?= format_rp($laba_sebelum_pajak) ?></th>
                        </tr>
                        <tr>
                            <th class="text-left">Pajak sewa</th>
                            <th></th>
                            <th class="text-right"><?= format_rp($pajak_sewa['pajak']) ?></th>
                        </tr>
                        <tr>
                            <th class="text-left">Laba bersih setelah pajak</th>
                            <th></th>
                            <th class="text-right"><?= format_rp($laba_sebelum_pajak + $pajak_sewa['pajak']) ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
        <?php endif ?>
    </div>
</div>
<script>
    $(function() {
        $('#example').DataTable();
    });
</script>