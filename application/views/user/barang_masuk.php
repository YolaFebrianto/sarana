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
		Daftar Barang Belum Divalidasi
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('user/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo base_url('user/barang_masuk');?>">Barang</a></li>
		<li class="active">Belum Divalidasi</li>
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
                <?php if ($dataUser['level']==3) { ?>
                <th>Aksi</th>
                <?php } else if($dataUser['level']==2) { ?>
                <th>Validasi</th>
                <th>Tolak</th>
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
              	<td><?php echo $value->lokasi_barang; ?></td>
              	<td><?php echo $value->jumlah_barang; ?></td>
              	<td><?php echo $value->kondisi_barang; ?></td>
              	<td><?php echo $value->jenis_barang; ?></td>
              	<td><?php echo $value->sumber_dana; ?></td>
                <?php if ($dataUser['level']==3) { ?>
              	<td>
                  <a href="<?=base_url('user/form_edit/'.$value->id_barang);?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                    <span class="fa fa-edit"></span>
                  </a> 
                </td>
                <?php } else if($dataUser['level']==2) { ?>
                <td>
                  <a href="#" class="btn btn-sm btn-success" onclick="konfirmasi1(<?=$value->id_barang;?>,'<?=$value->kode_barang;?>')" data-toggle="modal" data-target="#modalValidasi">
                    <span class="fa fa-check"></span> Validasi
                  </a>
                </td>
                <td>
                  <a href="#" class="btn btn-sm btn-danger" onclick="konfirmasi2(<?=$value->id_barang;?>,'<?=$value->kode_barang;?>')" data-toggle="modal" data-target="#modalTolak">
                    <span class="fa fa-trash-o"></span> Tolak
                  </a>
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
<div class="modal fade bd-example-modal-sm" id="modalValidasi" tabindex="-1" role="dialog" aria-labelledby="modalValidasiLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalValidasiLabel" style="text-align:center;">
            Validasi Barang
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;font-weight:bold;">
            Apakah anda yakin akan MEMVALIDASI data barang dengan kode <span id="kode1"></span> ?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <span class="fa fa-times"></span> Tidak
          </button>
          <a href="#" class="btn btn-primary" id="validasiYes">
            <span class="fa fa-check"></span> Ya
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-sm" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="modalTolakLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalTolakLabel" style="text-align:center;">
            Tolak Barang
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;font-weight:bold;">
            Apakah anda yakin akan MENOLAK data barang dengan kode <span id="kode2"></span> ?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <span class="fa fa-times"></span> Tidak
          </button>
          <a href="#" class="btn btn-primary" id="tolakYes">
            <span class="fa fa-check"></span> Ya
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function konfirmasi1(id,kode){
    $('span#kode1').html(kode);
    $('#validasiYes').attr('href','<?=base_url();?>user/edit_status/'+id+'/1');
  }
  function konfirmasi2(id,kode){
    $('span#kode2').html(kode);
    $('#tolakYes').attr('href','<?=base_url();?>user/edit_status/'+id+'/2');
  }
</script>