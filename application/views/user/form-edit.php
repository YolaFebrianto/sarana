<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Update Barang
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('user/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo base_url('user/barang_masuk') ?>"> Barang </a></li>
		<li><a href="#"><?=$edit['no'];?></a></li>
		<li class="active">Update</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
				<?= form_open('user/edit'); ?>
				<input type="hidden" name="no" value="<?=$edit['no'];?>">
					<div class="form-group">
						<label>Kode Barang :</label>
						<input type="text" name="kode_barang" class="form-control" required value="<?=$edit['kode_barang'];?>">
					</div>
					<div class="form-group">
						<label>Nama Barang :</label>
						<input type="text" name="nama_barang" class="form-control" required value="<?=$edit['nama_barang'];?>">	
					</div>
					<div class="form-group">
						<label>Lokasi Barang :</label>
						<input type="text" name="lokasi_barang" class="form-control" value="<?=$edit['lokasi_barang'];?>">
					</div>
					<div class="form-group">
						<label>Jumlah Barang :</label>
						<input type="number" name="jumlah_barang" class="form-control" min="0" value="<?=$edit['jumlah_barang'];?>" required>
					</div>
					<div class="form-group">
						<label>Kondisi Barang :</label>
						<select name="kondisi_barang" class="form-control">
							<option value="" selected="" disabled="">-- PILIH --</option>
							<option <?=($edit['kondisi_barang']=='Baik')?'selected':'';?>>Baik</option>
							<option <?=($edit['kondisi_barang']=='Kurang Baik')?'selected':'';?>>Kurang Baik</option>
						</select>
					</div>
					<div class="form-group">
						<label>Jenis Barang :</label>
						<select name="jenis_barang" class="form-control">
							<option value="" selected="" disabled="">-- PILIH --</option>
							<option <?=($edit['jenis_barang']=='Baru')?'selected':'';?>>Baru</option>
							<option <?=($edit['jenis_barang']=='Bekas')?'selected':'';?>>Bekas</option>
						</select>	
					</div>
					<div class="form-group">
						<label>Sumber Dana :</label>
						<select name="sumber_dana" class="form-control">
							<option value="" selected="" disabled="">-- PILIH --</option>
							<option <?=($edit['sumber_dana']=='BOS')?'selected':'';?>>BOS</option>
							<option <?=($edit['sumber_dana']=='BPUPP')?'selected':'';?>>BPUPP</option>
							<option <?=($edit['sumber_dana']=='Direktorat')?'selected':'';?>>Direktorat</option>
							<option <?=($edit['sumber_dana']=='Dana Masyarakat')?'selected':'';?>>Dana Masyarakat</option>
						</select>	
					</div>
					<div class="form-group">
						<label>Keterangan :</label>
						<textarea name="keterangan" class="form-control" rows="3"><?=$edit['keterangan'];?></textarea>
					</div>	
					<input type="submit" name="update" value="Submit" class="btn btn-success">
				<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>