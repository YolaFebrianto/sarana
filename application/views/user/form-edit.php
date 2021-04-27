<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Update Barang
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('user/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo base_url('user/barang_masuk') ?>"> Barang </a></li>
		<li><a href="#"><?=$edit['id_barang'];?></a></li>
		<li class="active">Update</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
				<?= form_open('user/edit'); ?>
				<input type="hidden" name="id_barang" value="<?=$edit['id_barang'];?>">
					<div class="form-group">
						<label>Kode Barang :</label>
						<input type="text" name="kode_barang" class="form-control" required value="<?=$edit['kode_barang'];?>" readonly>
					</div>
					<div class="form-group">
						<label>Nama Barang :</label>
						<input type="text" name="nama_barang" class="form-control" required value="<?=$edit['nama_barang'];?>">	
					</div>
					<div class="form-group">
						<label>Tanggal :</label>
						<input type="date" name="tanggal_masuk" class="form-control" required value="<?=$edit['tanggal_masuk'];?>">
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
							<option <?=($edit['sumber_dana']=='BPOPP')?'selected':'';?>>BPOPP</option>
							<option <?=($edit['sumber_dana']=='Direktorat')?'selected':'';?>>Direktorat</option>
							<option <?=($edit['sumber_dana']=='Dana Masyarakat')?'selected':'';?>>Dana Masyarakat</option>
						</select>	
					</div>
					<div class="form-group">
						<label>Keterangan :</label>
						<textarea name="keterangan" class="form-control" rows="3"><?=$edit['keterangan'];?></textarea>
					</div>
					<a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal">
						Simpan
					</a>
					<input type="submit" name="update" value="Simpan" class="btn btn-success" id="btnSubmit" style="display: none;">
				<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog modal-sm vertical-align-center" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalEditLabel" style="text-align:center;">
						Edit Barang
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<div class="modal-body">
					<p style="text-align:center;font-weight:bold;">
					Apakah anda yakin akan menyimpan data barang dengan kode <span id="kode"><?=$edit['kode_barang'];?></span> ?
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<span class="fa fa-times"></span> Tidak
					</button>
					<button type="button" class="btn btn-primary" onclick="kirim()">
						<span class="fa fa-check"></span> Ya
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function kirim(){
		$('#btnSubmit').click();
	}
</script>