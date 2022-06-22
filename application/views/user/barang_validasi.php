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
		Daftar Barang Belum Disetujui
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('user/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo base_url('user/barang_divalidasi');?>">Barang</a></li>
		<li class="active">Belum Disetujui</li>
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
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Lokasi Barang</th>
                <th>Jumlah Barang</th>
                <th>Kondisi Barang</th>
                <th>Jenis Barang</th>
                <th>Sumber Dana</th>
                <?php if ($dataUser['level']==1) { ?>
                <th>Aksi</th>
                <?php } ?>
              </tr>
              </thead>
              <tbody>
              <?php
              	$no=1; 
              	foreach ($barang as $key => $value) { ?>
              <tr>
              	<td><?php echo $no++; ?></td>
              	<td><?php echo $value->tanggal_masuk; ?></td>
              	<td><?php echo $value->kode_barang; ?></td>
              	<td><?php echo $value->nama_barang; ?></td>
              	<td><?php echo @$value->l_lokasi_barang; ?></td>
              	<td><?php echo $value->jumlah_barang; ?></td>
              	<td><?php echo $value->kondisi_barang; ?></td>
              	<td><?php echo $value->jenis_barang; ?></td>
              	<td><?php echo $value->sumber_dana; ?></td>
                <?php if ($dataUser['level']==1) { ?>
                <td>
                  <a href="#" class="btn btn-sm btn-success" onclick="konfirmasi3(<?=$value->id_barang;?>,'<?=$value->kode_barang;?>')" data-toggle="modal" data-target="#modalSetujui">
                    <span class="fa fa-check"></span> Setujui
                  </a>
                  <!-- <a href="<?=base_url().'user/edit_status/'.$value->id_barang.'/3';?>" class="btn btn-sm btn-success">
                    <span class="fa fa-check"></span> Setujui
                  </a> -->
                </td>
                <?php } ?>
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
<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modalSetujui" tabindex="-1" role="dialog" aria-labelledby="modalSetujuiLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalSetujuiLabel" style="text-align:center;">
            Setujui Barang
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;font-weight:bold;">
            Apakah anda yakin akan MENYETUJUI data barang dengan kode <span id="kode"></span> ?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <span class="fa fa-times"></span> Tidak
          </button>
          <a href="#" class="btn btn-primary" id="setujuiYes">
            <span class="fa fa-check"></span> Ya
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function konfirmasi3(id,kode){
    $('span#kode').html(kode);
    $('#setujuiYes').attr('href','<?=base_url();?>user/edit_status/'+id+'/3');
  }
</script>