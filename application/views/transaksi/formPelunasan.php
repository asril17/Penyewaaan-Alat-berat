<div class="card mt-3">
	<div class="card-header">
		<?= $subtitle ?>
	</div>
	<div class="card-body">
		<h5 class="card-title"><?= $subtitle ?></h5>
		<form action="<?php echo base_url('transaksi/acc/' . $kd_penyewaan) ?>" method="post">
			<div class="form-group row">
				<div class="col-sm-3">
					<label for="">Tanggal Pembayaran *</label>
				</div>
				<div class="col-sm-9">
					<input type="date" max="<?= $tgl_berakhir ?>" class="form-control" name="tgl_pelunasan" required="">
				</div>
			</div>
			<!-- <div class="form-group row">
				<div class="col-sm-3">
					<label for="">Jumlah Bayar *</label>
				</div>
				<div class="col-sm-9">
					<input type="number" class="form-control" name="jml_bayar" required="">
				</div>
			</div> -->
			<div class="form-group row">
				<div class="col-sm-3">
					<label for="">Sisa</label>
				</div>
				<div class="col-sm-9">
					<input type="number" class="form-control" name="jml_bayar" readonly="" value="<?php echo ($sisa == 0) ? $nominal : $sisa ?>">
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