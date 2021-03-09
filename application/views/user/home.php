<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Barang Tunggu</span>
          <span class="info-box-number"><?php echo $jumlahTunggu; ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-file"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Barang Ditolak</span>
          <span class="info-box-number"><?php echo $jumlahTolak; ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-undo"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Barang Divalidasi</span>
          <span class="info-box-number"><?php echo $jumlahValidasi; ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Barang Disetujui</span>
          <span class="info-box-number"><?php echo $jumlahSetujui; ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <div class="row">
  	<div class="col-md-12">  		
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin" id="dtTable">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Lokasi Barang</th>
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
                <td><?php
                  if ($value->status==0) {
                    echo '<span class="label label-warning">Tunggu</span>';
                  } else if ($value->status==1) {
                    echo '<span class="label label-info">Divalidasi</span>';
                  } else if ($value->status==2) {
                    echo '<span class="label label-danger">Ditolak</span>';
                  } else {
                    echo '<span class="label label-success">Disetujui</span>';
                  } 
                ?></td>
                <td><?php echo $value->kode_barang; ?></td>
                <td><?php echo $value->nama_barang; ?></td>
                <td><?php echo $value->jumlah_barang; ?></td>
                <td><?php echo $value->lokasi_barang; ?></td>
                <td><?php echo $value->kondisi_barang; ?></td>
                <td><?php echo $value->jenis_barang; ?></td>
                <td><?php echo $value->sumber_dana; ?></td>
              </tr>
              <?php
                }
              ?>
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