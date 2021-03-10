<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Daftar Barang
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('user/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo base_url('user/barang_disetujui');?>">Barang</a></li>
		<li class="active">Disetujui</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
  	<div class="col-md-12">
      <div class="box box-info">
    		<div class="box-header pull-right">
          <form action="<?php echo base_url('user/printPDF'); ?>" method="post">
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
                <th>Lokasi Barang</th>
                <th>Jumlah Barang</th>
                <th>Kondisi Barang</th>
                <th>Jenis Barang</th>
                <th>Sumber Dana</th>
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
          Apakah anda yakin akan mencetak barang tahun <span id="tahun"></span> ?
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
    $('#btnCetak').click();
  }
  function getTahun(){
    var tahun_val = $('input#year-input').val();
    $('#tahun').html(tahun_val);
  }
</script>