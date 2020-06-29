<div class="form-error mt-2">
	<?php if (validation_errors()) { ?>
		<div class="alert alert-danger" role="alert">
			<?php echo validation_errors(); ?>
		</div>
	<?php } ?>
	<?php echo $this->session->flashdata('message'); ?>
</div>
<div class="card mt-3">
	<div class="card-header">
		<?= $subtitle ?>
	</div>
	<div class="card-body">
		<h5 class="card-title"><?= $subtitle ?></h5>
		<form action="<?php echo base_url('transaksi/tambahpengeluaran') ?>" method="post">
			<div class="form-group row">
				<div class="col-sm-3">
					<label for="">Tanggal Pengeluaran *</label>
				</div>
				<div class="col-sm-9">
					<input type="date" class="form-control" name="tgl_pengeluaran" required="">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3">
					<label for="">Jenis Pengeluaran</label>
				</div>
				<div class="col-sm-9">
					<select name="jenis_pengeluaran" id="jenis_pengeluaran" class="form-control">
						<option value="" selected disabled>Plih jenis pengeluaran</option>
						<option value="Alat berat">Alat Berat</option>
						<option value="Pegawai">Pegawai</option>
						<option value="Operasional">Operasional</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3">
					<label for="">Pengeluaran Beban</label>
				</div>
				<div class="col-sm-9">
					<select name="jenis_beban" id="jenis_beban" class="form-control">
						<option value="">Plih Beban ....</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3">
					<label for="">Nominal *</label>
				</div>
				<div class="col-sm-9">
					<input type="number" class="form-control" name="nominal" required="">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3">
					<label for="">Keterangan</label>
				</div>
				<div class="col-sm-9">
					<textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$('#jenis_pengeluaran').change(function(event) {
		$('.bb').remove('');
		var jenis = $(this).val();
		$.ajax({
			url: '<?php echo base_url() ?>transaksi/getJenisBeban',
			type: 'POST',
			data: {
				jenis: jenis
			},
			dataType: 'json',
			success: function(res) {
				if (res.status == true) {
					for (i = 0; i < res.data.length; i++) {
						$('#jenis_beban').append('<option class="bb" value="' + res.data[i].kode_akun + '">' + res.data[i].nama_akun + '</option>')
					}

				}
			}
		})

	});
</script>