<?php
  $dataUser=[];
  if ($this->session->userdata('username') != '') {
    $where = [
      'username' => $this->session->userdata('username'),
    ];
    $dataUser = $this->db->get_where('tbluser',$where)->row_array();
  }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Data Lokasi
    <a href="<?=base_url('user/add_lokasi');?>" class="btn btn-sm btn-success">
      <span class="fa fa-plus"></span> TAMBAH
    </a> 
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('user/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><a href="<?php echo base_url('user/lokasi');?>">Lokasi</a></li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
  	<div class="col-md-12">
      <div class="box box-info">
        <!-- /.box-footer -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin" id="dtTable">
              <thead>
              <tr>
                <th>No</th>
                <th>Lokasi Barang</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php
              	$no=1;
              	foreach ($lokasi as $key => $value) { ?>
              <tr>
              	<td><?php echo $no++; ?></td>
              	<td><?php echo $value->lokasi_barang; ?></td>
              	<td>
                  <a href="<?=base_url('user/edit_lokasi/'.$value->id_lokasi);?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                    <span class="fa fa-edit"></span>
                  </a>
                  <div data-toggle="tooltip" data-placement="top" title="Hapus" style="display:inline-block;width:32px;">
                    <a href="#" class="btn btn-sm btn-danger" onclick="konfirmasi(<?=$value->id_lokasi;?>,'<?=$value->lokasi_barang;?>')" data-toggle="modal" data-target="#modalHapus">
                      <span class="fa fa-trash-o"></span>
                    </a>
                  </div>
                </td>
              </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
      </div>
  	</div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<!-- MODAL -->
<div class="modal fade bd-example-modal-sm" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalHapusLabel" style="text-align:center;">
            Hapus Lokasi
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;font-weight:bold;">
            Apakah anda yakin akan MENGHAPUS data lokasi <span id="kode"></span> ?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <span class="fa fa-times"></span> Tidak
          </button>
          <a href="#" class="btn btn-primary" id="hapusYes">
            <span class="fa fa-check"></span> Ya
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function konfirmasi(id,kode){
    $('span#kode').html(kode);
    $('#hapusYes').attr('href','<?=base_url();?>user/delete_lokasi/'+id);
  }
</script>