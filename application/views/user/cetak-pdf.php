<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sarana Prasarana SMK Muhammadiyah 1 Malang</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table {
		border-spacing: 0;
		border-collapse: collapse;
		background-color: transparent;
		margin: 10px 0;
		text-align: center;
	}
	.table {
		width: 100%;
		max-width: 100%;
		margin-bottom: 20px;
	}
	.table-bordered th,
	.table-bordered td {
		border: 1px solid #ddd;
	}
	.table-bordered > thead > tr > th,
	.table-bordered > tbody > tr > th,
	.table-bordered > thead > tr > td,
	.table-bordered > tbody > tr > td,{
		border: 1px solid #ddd;
	}
	.table-bordered > thead > tr > th,
	.table-bordered > thead > tr > td {
		border-bottom-width: 2px;
	}
	h4{
		font-size: 18px;
	}
	.row{
		text-align: center;
	}
	.col-md-3{
		width: 15%;
		display: inline-block;
	}
	.col-md-3 img{
		height: 130px;
	}
	.col-md-9{
		width: 84%;
		display: inline-block;
	}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<img src="<?php echo base_url().'template/dist/img/logo.jpg'; ?>">
			</div>
			<div class="col-md-9">
				<h1 style="margin-bottom:0;">SMK MUHAMMADIYAH 1 MALANG</h1>
				<p style="margin:5px;">Jl. Galunggung No.37a, Gading Kasri, Klojen, Kota Malang, Jawa Timur 651175</p>
			</div>
		</div>
		<div style="clear: both;"></div>
		<br>
		<hr>
		<h2 style="text-align: center;margin-bottom:5px;">
			<b>Laporan Inventaris</b>
		</h2>
		<?php
			if ($barang != null) { 
		?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Lokasi Barang</th>
					<th>Jumlah Barang</th>
					<th>Kondisi Barang</th>
					<th>Jenis Barang</th>
					<th>Sumber Dana</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					foreach ($barang as $value): 
				?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?php echo date('d/m/Y',strtotime($value->tanggal_masuk)); ?></td>
						<td><?php echo $value->kode_barang; ?></td>
						<td><?php echo $value->nama_barang; ?></td>
						<td><?php echo $value->lokasi_barang; ?></td>
						<td><?php echo $value->jumlah_barang; ?></td>
						<td><?php echo $value->kondisi_barang; ?></td>
						<td><?php echo $value->jenis_barang; ?></td>
						<td><?php echo $value->sumber_dana; ?></td>
						<td><?php echo $value->keterangan; ?></td>
					</tr>
				<?php 
					endforeach;
				?>
			</tbody>
		</table>
		<?php 
			} else {
				echo "<p style='text-align:center;'>Data Inventaris Tahun <b>".$tahun."</b> masih kosong!</p>";
			} 
		?>
	</div>
</body>
</html>