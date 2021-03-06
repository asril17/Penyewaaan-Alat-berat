<div class="form-error mt-2">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3" id="sewa1" style="display: block;">
    <div class="card-header">
        <?= $subtitle ?>
    </div>
    <div class="card-body">
        <form action="<?= base_url('transaksi/tambahPenyewaan') ?>" method="post" name="myForm" id="form">
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
                            <select name="kd_pelanggan" id="pelanggan" class="form-control pelanggan" required>
                                <option value="">--Pilih Nama Pelanggan--</option>
                                <?php foreach ($pl as $row) { ?>
                                    <option value="<?= $row['id'] ?>" pelanggan="<?= $row['nama_pelanggan'] ?>"><?= $row['nama_pelanggan'] ?></option>
                                <?php } ?>
                            </select>
                            <b class="text-danger"></b>
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
                            <input type="date" id="tgl_sewa" name="tgl_sewa" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" class="form-control tgl_sewa" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Tanggal Pengembalian *</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" id="tgl_expired" name="tgl_expired" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" class="form-control tgl_expired" required>
                            <div class="text-danger"><?= form_error('tgl_expired', '<small class="text-danger pl-3">', '</small>') ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Lama Sewa</label>
                        </div>
                        <div class="col-md-8">
                            <h6 id="hariku">0 Hari</h6>
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
                                <select name="id_alatberat" id="alat" class="form-control alat_berat unique" required>
                                    <option value="">--Pilih Nama Alat Berat--</option>
                                    <?php foreach ($alber as $row) { ?>
                                        <option value="<?= $row['id'] ?>" alat="<?= $row['nama_alber'] ?>"><?= $row['nama_alber'] ?></option>
                                    <?php } ?>
                                </select>
                                <b class="text-danger"></b>
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
                                <input readonly type="text" class="form-control harga_umum" id="harga_umum" name="harga_umum">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="sewa_sebelum_pajak">Total Sewa Sebelum Pajak</label>
                            </div>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control sewa_sebelum_pajak" id="sewa_sebelum_pajak" name="sewa_sebelum_pajak">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="pajak_harus_dibayar">Total Pajak yang harus dibayar</label>
                            </div>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control pajak_harus_dibayar" id="pajak_harus_dibayar" name="pajak_harus_dibayar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Harga Sewa Setelah Pajak</label>
                            </div>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control setelah_pajak" id="setelah_pajak" name="setelah_pajak">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Harga Sewa Khusus</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control harga_khusus" id="harga_khusus" name="harga_khusus">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Nama Supir *</label>
                            </div>
                            <div class="col-sm-8">
                                <select name="kd_pegawai" id="supir" class="form-control pegawai">
                                    <option value="">--Pilih Nama Supir--</option>
                                    <option value="1">Tanpa supir</option>
                                    <?php foreach ($pegawai as $row) { ?>
                                        <?php if ($row['status_sopir'] == 1) { ?>
                                            <option disabled value="<?= $row['id'] ?>" supir="<?= $row['nama_pegawai'] ?>"><?= $row['nama_pegawai'] ?></option>
                                        <?php  } else { ?>
                                            <option value="<?= $row['id'] ?>" supir="<?= $row['nama_pegawai'] ?>"><?= $row['nama_pegawai'] ?></option>

                                        <?php } ?>


                                    <?php } ?>
                                    <input type="hidden" class="nama_pegawai" value="">
                                </select>
                                <b class="text-danger"></b>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Biaya</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="harga_supir form-control" id="biaya" value="" readonly>
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
                    <div class="col-sm-2">
                        <label for="bensin">Solar</label>
                        <input type="number" min="1" class="form-control" name="bensin" id="bensin">
                        <b class="text-danger"></b>
                    </div>
                    <div class="col-sm-2">
                        <label for="harga_bensin">Harga per liter</label>
                        <input type="text" class="form-control rupiah" name="harga_bensin" id="harga_bensin">
                        <b class="text-danger"></b>
                    </div>
                </div>
            </div>
            <input type="hidden" name="DP" id="DP">
            <!-- <?php foreach ($tambahanBiaya as $key => $value) : ?>
                <input type="checkbox" class="biaya_lainnya_<?php echo $key ?>" name="id_biaya[]" value="<?php echo $value->id ?>"> <?php echo $value->nama ?> <br>
            <?php endforeach ?> -->
            <div class="form-group row" align="right">
                <div class="col-sm-12">
                    <!-- <button id="tambah" type="button" class="btn btn-primary btn-sm">Tambah</button> -->
                    <!-- <input type="submit" class="btn btn-primary" value="Tambah"> -->
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-12" align="right">
                    <input type="button" id="simpan" class="btn btn-primary btn-sm" value="Simpan">
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

<div class="card mt-3" id="sewa" style="display: none;">
    <div class="card-header">
        Form detail Penyewaan
    </div>
    <div class="card-body">
        <div class="row" id="setelah_sewa">
            <div class="col">
                <table class="table">
                    <thead>

                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Alat yang di sewa</th>
                            <th>Jumlah hari penyewaan</th>
                            <th class="umum">Harga sewa setelah pajak</th>
                            <th class="khusus">Harga sewa khusus</th>
                            <th>Tambah Lainnya</th>
                            <th>Harga Tambahan</th>
                            <th>Nama Supir</th>
                            <th>Biaya supir</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" id="nama_pelanggan"></td>
                            <td class="text-center" id="alat_sewa"></td>
                            <td class="text-center" id="jumlah_hari"></td>
                            <td class="text-right umum" id="sewa_umum"></td>
                            <td class="text-right khusus" id="sewa_khusus"></td>
                            <td class="text-center" id="tambahan"></td>
                            <td class="text-center" id="harga_tambahan"></td>
                            <td class="text-center" id="nama_supir"></td>
                            <td class="text-right" id="biaya_supir"></td>
                            <td class="text-right" id="total"></td>
                        </tr>
                    </tbody>
                </table>
                <input type="button" id="bayar" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm float-right mt-4" value="Simpan">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran DP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Jumlah Bayar *</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control rupiah" id="jumlah_bayarDP" name="jml_bayar" required="">
                        <b id="err" class="error"></b>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('change', '#tgl_expired, #tgl_sewa', function() {
        var oneDay = 24 * 60 * 60 * 1000;
        var firstDate = new Date($("#tgl_sewa").val());
        var secondDate = new Date($("#tgl_expired").val());
        var diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)));

        $('#hariku').html(diffDays + ' Hari');
    });


    $(document).on('click', '#simpan', function() {

        let input = $(this).closest('#form').find('input[type="text"],input[type="number"],select');
        console.log(input);
        let valid = true;
        for (i = 0; i < input.length; i++) {
            if (!input[i].validity.valid) {
                valid = false;
                $(input[i]).closest(".form-group input").addClass("is-invalid");
                $(input[i]).closest(".form-group select").addClass("is-invalid");
                $(input[i]).closest(".form-group").find('b').text("Form tidak boleh kosong");

            } else {
                $(input[i]).closest(".form-group input").removeClass("is-invalid");
                $(input[i]).closest(".form-group select").removeClass("is-invalid");
                $(input[i]).closest(".form-group").find('b').text("");
            }
        }

        if (valid) {
            var oneDay = 24 * 60 * 60 * 1000;
            var firstDate = new Date($("#tgl_sewa").val());
            var secondDate = new Date($("#tgl_expired").val());
            var diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)));

            let pelanggan = $('option:selected', '#pelanggan').attr('pelanggan');
            let alat = $('option:selected', '#alat').attr('alat');
            let harga_umum = format_angka($('#harga_umum').val());
            let harga_khusus = format_angka($('#harga_khusus').val());
            let bensin = $('#bensin').val();
            let harga_bensin = $('#harga_bensin').val();
            let supir = $('option:selected', '#supir').attr('supir');
            let biaya = $('#biaya').val();
            let harga = '';
            let harga_sewa = '';

            if (harga_khusus <= 0) {
                harga = harga_umum;
                harga_sewa = harga;
                $('.khusus').css('display', 'none');
                $('.umum').css('display', 'block');
            } else {
                $('.khusus').css('display', 'block');
                $('.umum').css('display', 'none');
                harga = harga_khusus;
                harga_sewa = harga;
            }

            let set_pajak = 0;
            if (Number(diffDays) > 7) {
                set_pajak += (Number(harga_sewa) * 2 / 100) * Number(diffDays);
            }

            let sewa = Number(harga) * Number(diffDays);

            let harga_setelah_pajak = Number(sewa) + Number(set_pajak);

            let tambahan = 0;
            if (bensin != '' || bensin != 0 || harga_bensin != '' || harga_bensin != 0) {
                tambahan += (Number(bensin) * Number(format_angka(harga_bensin)));

            }
            let sopir = 0;
            if (biaya != '' || biaya != 0) {
                sopir += Number(format_angka(biaya)) * Number(diffDays);
            }
            // let subtotal = harga_setelah_pajak + tambahan + sopir;
            let subtotal = harga_setelah_pajak;


            // MENENTUKAN 50 PERSEN DARI TOTAL
            let min_bayar = subtotal * 50 / 100;

            $('#jumlah_hari').html(diffDays + " hari");
            $('#nama_pelanggan').html(pelanggan);
            $('#alat_sewa').html(alat);
            $('#sewa_umum').html(format_rp(harga_setelah_pajak));
            $('#sewa_khusus').html(format_rp(harga_setelah_pajak));
            $('#tambahan').html('Bensin ' + bensin + ' liter');
            $('#harga_tambahan').html(format_rp(tambahan));
            $('#nama_supir').html(supir);
            $('#biaya_supir').html(format_rp(sopir));
            $('#total').html(format_rp(subtotal));

            // MENAMPILKAN NOMINAL PEMBAYARAN DP
            $('#jumlah_bayarDP').val(format_rp(min_bayar));
            $('#jumlah_bayarDP').attr('min', min_bayar);
            $('#jumlah_bayarDP').attr('max', subtotal);

            $('#sewa1').css('display', 'none')
            $('#sewa').css('display', 'block')
        }


    });

    $(document).on('click', '#save', function() {
        let dp = format_angka($('#jumlah_bayarDP').val());
        $('#DP').val(dp);
        if (dp == '') {
            $('#jumlah_bayarDP').addClass('is-invalid');
            $('#err').html('Jumlah bayar tidak boleh kosong');
        } else {
            $('#form').trigger('submit');

        }
    });

    $(document).on('keyup', '#jumlah_bayarDP', function() {
        $('#save').attr('disabled', 'true')
        let min = $(this).attr('min');
        let max = $(this).attr('max');
        let nominal = $(this).val();
        if (format_angka(nominal) < min) {
            // $('#jumlah_bayarDP').val(min);
            $('#jumlah_bayarDP').addClass('is-invalid');
            $('#err').html('Jumlah pembayaran minimal ' + format_rp(min));
            $('#save').attr('disabled', 'true')
        } else if (format_angka(nominal) > max) {
            $('#save').attr('disabled', 'true')
            $('#jumlah_bayarDP').addClass('is-invalid');
            $('#err').html('Jumlah pembayaran maksimal ' + format_rp(min));

        } else if (format_angka(nominal) <= max && format_angka(nominal) >= min) {
            $('#save').removeAttr('disabled');
            $('#jumlah_bayarDP').removeClass('is-invalid');
            $('#err').html('');

        }

    });

    // function CalcDiff() {
    //     var a = $('#tgl1').data("DateTimePicker").date();
    //     var b = $('#tgl2').data("DateTimePicker").date();
    //     var timeDiff = 0
    //     if (b) {
    //         timeDiff = (b - a) / 1000;
    //     }

    //     $('#selisih').val(Math.floor(timeDiff / (86400)) + ' Hari')
    // }
    $(function() {

        $('#example').DataTable();
    });

    $('.alat_berat').change(function(event) {
        var id = $(this).val();
        var oneDay = 24 * 60 * 60 * 1000;
        var firstDate = new Date($("#tgl_sewa").val());
        var secondDate = new Date($("#tgl_expired").val());
        var diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)));
        $.ajax({
            url: '<?php echo base_url() ?>transaksi/getAlatBerat/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.status == true) {
                    let setelah_pajak = (Number(data.data.harga_sewa) * 2 / 100) * diffDays;
                    let sebelum_pajak = Number(data.data.harga_sewa) * diffDays;
                    $('#sewa_sebelum_pajak').val(format_rp(sebelum_pajak));
                    $('#pajak_harus_dibayar').val(format_rp(Number(setelah_pajak)));
                    $('.harga_umum').val(format_rp(data.data.harga_sewa));
                    $('.setelah_pajak').val(format_rp(Number(sebelum_pajak) + Number(setelah_pajak)));
                    $('.nama_alat').val(data.data.nama_alber);
                    $('.harga_khusus').val(format_rp(data.data.harga_sewa_khusus));
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
                        $('.harga_supir').val(format_rp(data.data.biaya));
                        $('.pajak').val(data.data.pajak);
                        $('.nama_pegawai').val(data.data.nama_pegawai);
                    }
                }
            })
        } else {
            $('.harga_supir').val('');
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
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                kd_pelanggan: {
                    required: true
                },
                tgl_sewa: {
                    required: true
                },
                tgl_expired: {
                    required: true
                },
                id_alatberat: {
                    required: true
                },
                kd_pegawai: {
                    required: true
                },
                harga_khusus: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                kd_pelanggan: {
                    required: "Inputan tidak boleh kosong"
                },
                tgl_sewa: {
                    required: "Inputan tidak boleh kosong"
                },
                tgl_expired: {
                    required: "Inputan tidak boleh kosong"
                },
                id_alatberat: {
                    required: "Inputan tidak boleh kosong"
                },
                kd_pegawai: {
                    required: "Inputan tidak boleh kosong"
                },
                harga_khusus: {
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