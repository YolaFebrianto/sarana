<section class="content-header">
	<h1>
		DATA SARANA PRASARANA
		<div style="float:right;">
			<a href="<?php echo base_url('user/form_add'); ?>" class="btn btn-sm btn-primary">
				<i class="fa fa-plus"></i> Tambah
			</a>
			<a href="" class="btn btn-sm btn-info" id="cancel" style="display:none;">
				<i class="fa fa-times"></i> Batal
			</a>
		</div>
	</h1>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<?php if($this->session->flashdata('info') != null): ?>
			<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-info"></i> Alert!</h4>
				<?=$this->session->flashdata('info');?>
			</div>
			<?php endif; ?>	
			<?php if($this->session->flashdata('danger') != null): ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
				<?=$this->session->flashdata('danger');?>
			</div>
			<?php endif; ?>	
			<table class="table table-bordered table-striped" id="dtTable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Sarana</th>
						<th>Tahun Berdiri</th>
						<th>Keterangan</th>
						<th>Foto</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$uri_1 = $this->uri->segment(1);
						if ($uri_1 != null && $uri_1 > 0) {
							$no = $uri_1+1;
						} else {
							$no = 1;
						}
						foreach($isi as $crud): ?>
					<tr>
						<td><?=$no++;?></td>
						<td><?=$crud->nama;?></td>
						<td><?php
							if ($crud->tahun_berdiri>0) {
								echo $crud->tahun_berdiri;
							} else {
								echo "-";
							}
						?></td>
						<td><?=$crud->keterangan;?></td>
						<td>
							<?php
								if (!empty($crud->gambar)) {
							?>
							<a href="<?=base_url().'img/'.$crud->gambar;?>" target="_blank" class="img-thumbnail">
								<img src="<?=base_url().'img/'.$crud->gambar;?>" height="60px">
							</a>
							<?php
								}
							?>
						</td>
						<td>
							<a href="<?=base_url('user/form_edit/'.$crud->id) ?>" class="btn btn-info">
								<i class="fa fa-edit"></i>
							</a>
							<button class="btn btn-danger" onclick="konfirmasi(<?=$crud->id;?>)">
								<i class="fa fa-trash-o"></i>
							</button>
						</td>
					</tr>
					<?php 
						endforeach;
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<script type="text/javascript">
	function konfirmasi(id)
	{
		var cek = confirm('Hapus Data?');
		if (cek == true) {
			window.location.href="<?=base_url().'user/delete/';?>"+id;
		}
	}
</script>