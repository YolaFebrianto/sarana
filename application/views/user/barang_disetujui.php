<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Daftar Barang
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Barang</a></li>
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
                <button type="submit" class="btn btn-md btn-default btn-flat">
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
              	$no=0; 
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