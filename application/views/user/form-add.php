<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Tambah Barang
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('user/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?=base_url('user/barang_masuk');?>"> Barang </a></li>
		<li class="active">Tambah</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
				<?= form_open('user/add'); ?>
				<?php
					$this->db->order_by('no','desc');
					$lastId = $this->db->get_where('tblbarang',[],1)->row_array();
					$kode_barang="";
					if (strlen($lastId['no'])<4) {
						$kode_barang = str_pad($lastId['no']+1, 3, '0', STR_PAD_LEFT);
					} else {
						$kode_barang = $lastId['no']+1; 
					}
					$kode_barang = "BRG-".$kode_barang;
				?>
					<div class="form-group">
						<label>Kode Barang :</label>
						<input type="text" name="kode_barang" class="form-control" required value="<?php echo $kode_barang; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Nama Barang :</label>
						<input type="text" name="nama_barang" class="form-control" required>	
					</div>
					<div class="form-group">
						<label>Lokasi Barang :</label>
						<input type="text" name="lokasi_barang" class="form-control">	
					</div>
					<div class="form-group">
						<label>Jumlah Barang :</label>
						<input type="number" name="jumlah_barang" class="form-control" min="0" required>
					</div>
					<div class="form-group">
						<label>Kondisi Barang :</label>
						<select name="kondisi_barang" class="form-control">
							<option value="" selected="" disabled="">-- PILIH --</option>
							<option>Baik</option>
							<option>Kurang Baik</option>
						</select>	
					</div>
					<div class="form-group">
						<label>Jenis Barang :</label>
						<select name="jenis_barang" class="form-control">
							<option value="" selected="" disabled="">-- PILIH --</option>
							<option>Baru</option>
							<option>Bekas</option>
						</select>	
					</div>
					<div class="form-group">
						<label>Sumber Dana :</label>
						<select name="sumber_dana" class="form-control">
							<option value="" selected="" disabled="">-- PILIH --</option>
							<option>BOS</option>
							<option>BPUPP</option>
							<option>Direktorat</option>
							<option>Dana Masyarakat</option>
						</select>	
					</div>
					<div class="form-group">
						<label>Keterangan :</label>
						<textarea name="keterangan" class="form-control" rows="3"></textarea>
					</div>
					<a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal">
						Simpan
					</a>
					<input type="submit" name="tambah" value="Simpan" class="btn btn-success" id="btnSubmit" style="display: none;">
				<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <b class="modal-title" id="modalLabel">Peringatan !!!</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          Apakah anda yakin akan menyimpan data barang dengan kode <span id="kode"><?=$kode_barang;?></span> ?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="kirim()">Ya</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	function kirim(){
		$('#btnSubmit').click();
	}
</script>