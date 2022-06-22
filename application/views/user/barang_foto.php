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
    Foto Barang "<?php echo $barang['kode_barang']; ?>"
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('user/barang_disetujui');?>"><i class="fa fa-dashboard"></i> Barang</a></li>
    <li><a href="<?php echo base_url('user/form_edit/'.$barang['id_barang']);?>"><?php echo $barang['kode_barang']; ?></a></li>
    <li class="active">Foto</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <!-- /.box-footer -->
        <div class="box-body">
          <?= form_open_multipart('user/foto_upload',['class'=>'form-inline']); ?>
          <div class="form-group">
            <label>Upload Foto :</label>
            <input type="file" name="foto_barang" class="form-control" required>
          </div>
            <input type="hidden" name="id_barang" class="form-control" value="<?php echo $barang['id_barang']; ?>">
          <!-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal">
            Simpan
          </a> -->
          <input type="submit" name="tambah" value="Upload" class="btn btn-success" id="btnSubmit">
          <?= form_close(); ?>
          <br>
          <div class="row">
            <?php foreach ($foto as $key => $value) { ?>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
              <div class="thumbnail"> 
                <img src="<?=base_url().'template/uploads/'.$value->foto_barang; ?>" height="200px" alt="<?php echo $value->foto_barang; ?>">
              </div>
              <a href="<?=base_url().'template/uploads/'.$value->foto_barang; ?>" class="btn btn-sm btn-info" target="_blank"><span class="fa fa-eye"></span> View</a>
              <a href="<?=base_url().'user/foto_hapus/'.$value->id_foto;?>" class="btn btn-sm btn-danger"><span class="fa fa-trash-o"></span> Delete</a>
            </div>
            <?php } ?>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<!-- Modal -->
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
          Apakah anda yakin akan mencetak <br>data barang tahun <span id="tahun"></span> ?
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
  function kirim(){
    $('#btnCetak').click();
  }
  function getTahun(){
    var tahun_val = $('input#year-input').val();
    $('#tahun').html(tahun_val);
  }
</script>