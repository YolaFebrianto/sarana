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
                  <a href="<?=base_url('user/form_edit/'.$value->no);?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                    <span class="fa fa-edit"></span>
                  </a> 
                </td>
                <?php } else if($dataUser['level']==2) { ?>
                <td>
                  <a href="<?=base_url('user/edit_status/'.$value->no.'/1');?>" class="btn btn-sm btn-success"><span class="fa fa-check"></span> Validasi</a> 
                </td>
                <td>
                  <a href="<?=base_url('user/edit_status/'.$value->no.'/2');?>" class="btn btn-sm btn-danger"><span class="fa fa-trash-o"></span> Tolak</a>
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