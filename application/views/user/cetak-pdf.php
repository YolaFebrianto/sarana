<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sarana Prasarana SMK PGRI 2 Malang</title>
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
	.col-md-6{
		width: 40%;
		display: inline-block;
	}
	.row-footer {
		width: 100%;
		height:200px;
		position:fixed;
		bottom:0px;
	}
	.col-footer {
		height:200px;
		width:30%;
		display: inline-block;
	}
	.col-footer p {
		margin: 0;
		font-size: 16px;
		line-height: 20px;
	}
	.col-footer p.enter {
		height: 100px;
	}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<img src="<?php echo base_url().'template/dist/img/logo.png'; ?>">
			</div>
			<div class="col-md-9">
				<h1 style="margin-bottom:0;">SMK PGRI 2 MALANG</h1>
				<p style="margin:0;">Jl. Janti Barat Blok A No 25, Bandungsari</p>
				<p style="margin:5px;">Kec. Sukun, Kota Malang, Jawa Timur 65148</p>
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
		<table class="table table-bordered" style="margin-bottom:200px;">
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
	<div class="row-footer">
		<div class="col-footer" style="text-align: left;">
			<p>Mengetahui,</p>
			<p>Kepala Sekolah</p>
			<p class="enter"></p>
			<p style="text-decoration:underline;font-weight:bold;">Suprijana, S.Pd.</p>
			<p>NIP. 196907231994031005</p>
		</div>
		<div class="col-footer" style="width:38%"></div>
		<div class="col-footer" style="text-align: center;">
			<p>	&nbsp; </p>
			<p>Waka Sarpras</p>
			<p class="enter"></p>
			<p style="text-decoration:underline;font-weight:bold;">Yan Romero Njio, S.S.</p>
		</div>
		<div style="clear: both;"></div>
	</div>
</body>
</html>