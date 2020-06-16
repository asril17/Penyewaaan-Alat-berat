<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
    <div class="card-header">
        <?= $subtitle ?>
    </div>
    <div class="card-body">
        <form action="<?= base_url('transaksi/tambahPenyewaan') ?>" method="post" name="myForm">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Kode Penyewaan</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Kode Penyewa" name="kd_penyewaan" value="<?php echo $kode ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Nama Pelanggan * </label>
                        </div>
                        <div class="col-sm-8">
                            <select name="kd_pelanggan" id="" class="form-control pelanggan">
                                <option value="">--Pilih Nama Pelanggan--</option>
                                <?php foreach ($pl as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama_pelanggan'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="text-danger"><?= form_error('kd_pelanggan', '<small class="text-danger pl-3">', '</small>') ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Tanggal Penyewaan *</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" name="tgl_sewa" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" class="form-control tgl_sewa">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Tanggal Pengembalian *</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" name="tgl_expired" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" class="form-control tgl_expired">
                            <div class="text-danger"><?= form_error('tgl_expired', '<small class="text-danger pl-3">', '</small>') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="wrapper-input">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Nama Alat Berat *</label>
                            </div>
                            <div class="col-sm-8">
                                <select name="id_alatberat" id="" class="form-control alat_berat unique">
                                    <option value="">--Pilih Nama Alat Berat--</option>
                                    <?php foreach ($alber as $row) { ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['nama_alber'] ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="" value="" class="harga_umum">
                                <input type="hidden" name="" value="" class="harga_khusus">
                                <input type="hidden" name="" value="" class="nama_alat">
                                <div class="text-danger"><?= form_error('kd_alat_berat', '<small class="text-danger pl-3">', '</small>') ?></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Harga Sewa Umum</label>
                            </div>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control harga_umum" name="harga_umum">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Harga Sewa Setelah Pajak</label>
                            </div>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control setelah_pajak" name="setelah_pajak">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Harga Sewa Khusus</label>
                            </div>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control harga_khusus" name="harga_khusus">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Nama Supir *</label>
                            </div>
                            <div class="col-sm-8">
                                <select name="kd_pegawai" class="form-control pegawai">
                                    <option value="">--Pilih Nama Supir--</option>
                                    <option value="1">Tanpa supir</option>
                                    <?php foreach ($pegawai as $row) { ?>
                                        <?php if ($row['status_sopir'] == 1) { ?>
                                            <option disabled value="<?= $row['id'] ?>"><?= $row['nama_pegawai'] ?></option>
                                        <?php  } else { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama_pegawai'] ?></option>

                                        <?php } ?>


                                    <?php } ?>
                                    <input type="hidden" class="nama_pegawai" value="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Biaya</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="harga_supir form-control" value="" readonly>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Pajak %</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="pajak form-control" value="" readonly>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="">Tambahan Lainnya</label>
                    </div>
                    <div class="col-sm-8">
                        <?php foreach ($tambahanBiaya as $key => $value) : ?>
                            <input type="checkbox" class="biaya_lainnya_<?php echo $key ?>" name="id_biaya[]" value="<?php echo $value->id ?>"> <?php echo $value->nama ?> <br>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="form-group row" align="right">
                <div class="col-sm-12">
                    <!-- <button id="tambah" type="button" class="btn btn-primary btn-sm">Tambah</button> -->
                    <!-- <input type="submit" class="btn btn-primary" value="Tambah"> -->
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-12" align="right">
                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                </div>
            </div>
            <!-- <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Alat Berat</th>
                            <th>Supir</th>
                            <th>Tambahan</th>
                        </tr>
                    </thead>
                    <tbody class="data-table">

                        <tr>
                            <th colspan="2" class="text-right">Sub Total</th>
                            <th colspan="2" class="text-right">1.00.000</th>
                        </tr>
                    </tbody>
                </table>
            </div> -->
        </form>
    </div>
</div>

<script>
    $(function() {
        $('#example').DataTable();
    });

    $('.alat_berat').change(function(event) {
        var id = $(this).val();
        $.ajax({
            url: '<?php echo base_url() ?>transaksi/getAlatBerat/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.status == true) {
                    let setelah_pajak = Number(data.data.harga_sewa) * 2 / 100;
                    $('.harga_umum').val(data.data.harga_sewa);
                    $('.setelah_pajak').val(Number(data.data.harga_sewa) + Number(setelah_pajak));
                    $('.nama_alat').val(data.data.nama_alber);
                    $('.harga_khusus').val(data.data.harga_sewa_khusus);
                }
            }
        })

    });

    $('.pegawai').change(function(event) {
        var pegawaiID = $(this).val(),
            hargaPegawai = 0;
        if (pegawaiID != 1) {
            $.ajax({
                url: '<?php echo base_url() ?>transaksi/getSupir/' + pegawaiID,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    if (data.status == true) {
                        $('.harga_supir').val(data.data.biaya);
                        $('.pajak').val(data.data.pajak);
                        $('.nama_pegawai').val(data.data.nama_pegawai);
                    }
                }
            })
        }

    });
    var i = 0;
    $('.biaya_lainnya_' + i).change(function(event) {
        var id = $(this).val(),
            harga = [];
        if ($(this).is(':checked')) {
            $.ajax({
                url: '<?php echo base_url() ?>transaksi/getBiayaTambahan/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    harga.push(data.data.harga)
                }
            })

        } else {
            alert('uwuwu');
        }
    });



    var dataTable = "";
    $('#tambah').click(function(event) {

        var form = $('form[name="myForm"]'),
            checkVal = [],
            tgl_sewa = form.find('.tgl_sewa').val(),
            tgl_expired = form.find('.tgl_expired').val(),
            pelanggan = form.find('.pelanggan').val(),
            pegawai = form.find('.pegawai').val(),
            nama_pegawai = form.find('.nama_pegawai').val(),
            alat_berat = $('.alat_berat').val(),
            harga_umum = $('.harga_umum').val(),
            harga_khusus = $('.harga_khusus').val(),
            tbody = $('.data-table'),
            input_id = $('.nama_alat').val(),
            biaya_lainnya = form.find('.biaya_lainnya').val();

        tbody.find('.unique').each(function(i, e) {
            if ($(e).text() == input_id) {
                $(e).parents('tr').remove();
            }
        });




        if ($('.pelanggan').val() == "") {
            alert('Pelanggan tidak boleh kosong!!');
            $('.pelanggan').focus();
            return false;
        }

        if ($('.alat_berat').val() == "") {
            alert('Alat Berat  tidak boleh kosong!!');
            return false;
        }

        // checkbox val
        $(':checkbox:checked').each(function(index, el) {
            checkVal[index] = $(this).val();
        });

        dataTable = "<tr>";
        dataTable += "<td class='unique'>" + $('.nama_alat').val() + "<input type='hidden' name='id_alatberat[]' value='" + alat_berat + "'><input type='hidden' name='harga_umum[]' value='" + harga_umum + "'><input type='hidden' name='harga_khusus[]' value='" + harga_khusus + "'></td>";
        dataTable += "<td>" + nama_pegawai + "<input type='hidden' name='id_supir[]' value='" + pegawai + "'><input type='hidden' name='biaya[]' value='" + $('.harga_supir').val() + "'><input type='hidden' name='pajak[]' value='" + $('.pajak').val() + "'></td>";
        dataTable += "<td>" + checkVal + "<input type='hidden' name='id_biaya' value='" + checkVal + "'></td>";
        dataTable += "</tr>";

        $('.data-table').append(dataTable);
        clear_wrapper_input(true);
        $('.alat_berat').focus();


    });


    function clear_wrapper_input(all) {
        all = typeof all !== 'undefined' ? all : false;
        $('#wrapper-input').children().find('input,select').each(function(i) {
            $(this).val('');
        });
    }
</script>