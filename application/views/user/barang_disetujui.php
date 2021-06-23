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
              <div class="col-md-3 col-sm-4 col-xs-4">
                <input type="text" name="tahun" class="form-control" value="<?php echo date('Y'); ?>" placeholder="Input Tahun" id="year-input">
              </div>
              <div class="col-md-5 col-sm-4 col-xs-4">
                <select name="lokasi_barang" class="form-control">
                    <option selected value="">SEMUA RUANGAN</option>
                    <?php
                        foreach ($lokasi_barang as $k => $loc) {
                    ?>
                    <option value="<?php echo $loc->id_lokasi; ?>"><?php echo $loc->lokasi_barang; ?></option>
                    <?php
                        }
                    ?>
                </select>
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
                <th>Foto</th>
                <th>Lokasi Barang</th>
                <th>Jumlah Barang</th>
                <th>Kondisi Barang</th>
                <th>Jenis Barang</th>
                <th>Sumber Dana</th>
                <?php if ($dataUser['level']>0) { ?>
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
                <td>
                  <a href="<?php echo base_url().'template/uploads/'.$value->foto_barang;?>" target="_blank">
                    <img src="<?php echo base_url().'template/uploads/'.$value->foto_barang;?>" width="50px" alt="<?php echo $value->foto_barang; ?>">
                  </a>
                </td>
                <td><?php echo @$value->l_lokasi_barang; ?></td>
                <td><?php echo $value->jumlah_barang; ?></td>
                <td><?php echo $value->kondisi_barang; ?></td>
                <td><?php echo $value->jenis_barang; ?></td>
                <td><?php echo $value->sumber_dana; ?></td>
                <?php if ($dataUser['level']>0) { ?>
                <td width="80px">
                  <a href="<?=base_url('user/form_edit/'.$value->id_barang);?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                    <span class="fa fa-edit"></span>
                  </a>
                  <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalGudang<?php echo $value->id_barang; ?>">
                    <span class="fa fa-folder"></span> 
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
<?php
  $no=1;
  foreach ($barang as $key => $value) {
?>
<div class="modal fade bd-example-modal-sm" id="modalGudang<?php echo $value->id_barang;?>" tabindex="-1" role="dialog" aria-labelledby="modalGudangLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalGudangLabel" style="text-align:center;">
            Masukkan Gudang
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <?= form_open('user/masukkan_gudang'); ?>
          <div class="modal-body">
            <p style="text-align:center;font-weight:bold;">
              Berapa banyak Barang <?php echo $value->kode_barang; ?> yang akan anda masukkan gudang ?
            </p>
            <input type="number" name="stok_gudang" min="1" max="<?php echo $value->jumlah_barang-1; ?>" class="form-control" value="1"><br>
            <select name="kondisi_barang" class="form-control">
              <option selected disabled>-- Pilih --</option>
              <option>Rusak Ringan</option>
              <option>Rusak Berat</option>
            </select>
            <input type="hidden" name="id_barang" value="<?php echo $value->id_barang; ?>">
            <input type="hidden" name="kode_barang" value="<?php echo $value->kode_barang; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <span class="fa fa-times"></span> Batal
            </button>
            <button type="submit" class="btn btn-primary">
              <span class="fa fa-check"></span> Simpan
            </button>
          </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
<?php
  }
?>
<script type="text/javascript">
  function kirim(){
    $('#btnCetak').click();
  }
  function getTahun(){
    var tahun_val = $('input#year-input').val();
    $('#tahun').html(tahun_val);
  }
</script>