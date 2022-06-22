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
		Daftar Barang
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('user/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo base_url('user/barang_gudang');?>">Barang</a></li>
		<li class="active">Gudang</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
  	<div class="col-md-12">
      <div class="box box-info">
        <div class="box-header pull-right">
          <form action="<?php echo base_url('user/printGudangPDF'); ?>" method="post">
            <div class="row">
              <div class="col-md-8 col-sm-8 col-xs-8">
                <input type="text" name="tahun" class="form-control" value="<?php echo date('Y'); ?>" placeholder="Input Tahun" id="year-input">
              </div>
              <div class="col-md-4 col-sm-4 col-xs-4">
                <button type="button" class="btn btn-md btn-default btn-flat" data-toggle="modal" data-target="#modal" onclick="getTahun()">
                  <span class="fa fa-print"></span> Cetak
                </button>
                <button type="submit" class="btn btn-md btn-default btn-flat" style="display:none;" id="btnCetak">
                  <span class="fa fa-print"></span> Cetak
                </button>
              </div>
            </div>
          </form>
        </div>
        <div style="clear: both;"></div>
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
                <th>Kondisi Barang</th>
                <th>Jumlah Barang</th>
                <?php if ($dataUser['level']==2) { ?>
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
              	<td><?php echo $value->tanggal_masuk_gudang; ?></td>
              	<td><?php echo $value->kode_barang; ?></td>
              	<td><?php echo @$value->nama_barang; ?></td>
                <td><?php echo @$value->kondisi_barang; ?></td>
              	<td><?php echo $value->jumlah_barang; ?></td>
                <?php if($dataUser['level']==2) { ?>
                <td>
                  <a href="#" class="btn btn-sm btn-info" onclick="konfirmasi1(<?=$value->id_barang_gudang;?>,'<?=$value->kode_barang;?>')" data-toggle="modal" data-target="#modalBatal">
                    <span class="fa fa-check"></span> Batal
                  </a>
                  <a href="#" class="btn btn-sm btn-danger" onclick="konfirmasi2(<?=$value->id_barang_gudang;?>,'<?=$value->kode_barang;?>')" data-toggle="modal" data-target="#modalHapus">
                    <span class="fa fa-trash-o"></span> Hapus
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
<div class="modal fade bd-example-modal-sm" id="modalBatal" tabindex="-1" role="dialog" aria-labelledby="modalBatalLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalBatalLabel" style="text-align:center;">
            Batal Hapus Barang
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;font-weight:bold;">
            Apakah anda yakin akan MENGEMBALIKAN data barang dengan kode <span id="kode1"></span> ?
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
<div class="modal fade bd-example-modal-sm" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalHapusLabel" style="text-align:center;">
            Hapus Barang
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;font-weight:bold;">
            Apakah anda yakin akan MENGHAPUS data barang dengan kode <span id="kode2"></span> ?
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
<!-- Modal CETAK -->
<div class="modal fade bd-example-modal-sm" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalDisetujui" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalDisetujui" style="text-align:center;">
            Cetak Barang
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;font-weight:bold;">
          Apakah anda yakin akan mencetak <br>Data Barang Gudang Tahun <span id="tahun"></span> ?
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
  function konfirmasi1(id,kode){
    $('span#kode1').html(kode);
    $('#validasiYes').attr('href','<?=base_url();?>user/pengembalian_gudang/'+id);
  }
  function konfirmasi2(id,kode){
    $('span#kode2').html(kode);
    $('#tolakYes').attr('href','<?=base_url();?>user/edit_status_gudang/'+id);
  }
  function kirim(){
    $('#btnCetak').click();
  }
  function getTahun(){
    var tahun_val = $('input#year-input').val();
    $('#tahun').html(tahun_val);
  }
</script>