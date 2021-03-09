<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SI Sarana Prasarana SMK Muhammadiyah 1 Malang</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="<?=base_url();?>template/dist/img/logo_mini.png">
	<!-- bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?=base_url();?>template/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url();?>template/bootstrap/css/font-awesome.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url();?>template/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?=base_url();?>template/dist/css/skins/_all-skins.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?=base_url();?>template/plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?=base_url();?>template/plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?=base_url();?>template/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?=base_url();?>template/plugins/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?=base_url();?>template/plugins/daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?=base_url();?>template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<style type="text/css">
		@media screen and (min-width: 1080px){
			.table-responsive {
				overflow-x: hidden;
			}
		}
		.skin-blue .main-header .navbar{
			background: #32642D;
		}
		.skin-blue .main-header .logo{
			background: #224820;
		}
		.content-wrapper, .right-side{
			background: #D0FED0;
		}
		.skin-blue .sidebar-menu>li.header{
			background: #224820;
			color: white;
		}
		.skin-blue .wrapper, 
		.skin-blue .main-sidebar, 
		.skin-blue .left-side{
			background: #224820;
		}
		.skin-blue .sidebar-menu>li:hover>a, 
		.skin-blue .sidebar-menu>li.active>a{
			background: #32642D;
			border-left-color: white;
		}
		.box.box-info,.box.box-primary{
			border-top-color: green;
		}
		.skin-blue .main-header .navbar .sidebar-toggle:hover{
			background: #224820;
		}
		.skin-blue .main-header .logo:hover{
			background: #32642D;
		}
		.pagination>.active>a, 
		.pagination>.active>a:focus, 
		.pagination>.active>a:hover, 
		.pagination>.active>span, 
		.pagination>.active>span:focus, 
		.pagination>.active>span:hover{
			background: green;
			border-color: green;
		}
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php
	$dataUser=[];
	if ($this->session->userdata('username') != '') {
		$where = [
			'username' => $this->session->userdata('username'),
		];
		$dataUser = $this->db->get_where('tbluser',$where)->row_array();
	}
	$jml_brg_tunggu = $this->db->get_where('tblbarang',['status'=>0])->num_rows();
	$jml_brg_blm_disetujui = $this->db->get_where('tblbarang',['status'=>0])->num_rows();
?>
<div class="wrapper">
	<header class="main-header">
		<!-- Logo -->
		<a href="<?php echo base_url(); ?>" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>SI</b>SP</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>SIS</b>PRA</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li>
						<a href="#"><?php echo $dataUser['full_name']; ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('user/logout'); ?>"><span class="fa fa-sign-in"></span> Logout</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?=base_url();?>template/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?php echo $dataUser['full_name']; ?></p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="header">MAIN NAVIGATION</li>
				<?php
					if($dataUser['level']==1){
				?>
				<li <?php echo($this->uri->segment(2)=='barang_disetujui')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_disetujui'); ?>">
						<i class="fa fa-list"></i> <span>Daftar Barang Disetujui</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='barang_divalidasi')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_divalidasi'); ?>">
						<i class="fa fa-undo"></i> <span>Daftar Barang Divalidasi</span>
					</a>
				</li>
				<?php
					} else if($dataUser['level']==2) {
				?>
				<li <?php echo($this->uri->segment(2)=='barang_disetujui')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_disetujui'); ?>">
						<i class="fa fa-list"></i> <span>Daftar Barang Disetujui</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='barang_divalidasi')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_divalidasi'); ?>">
						<i class="fa fa-undo"></i> <span>Daftar Barang Divalidasi</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='barang_masuk')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_masuk'); ?>">
						<i class="fa fa-download"></i> <span>Daftar Barang Masuk</span>
						<?php if($jml_brg_blm_disetujui>0): ?>
						<span class="pull-right-container">
							<small class="label pull-right bg-orange"><?=$jml_brg_blm_disetujui;?></small>
						</span>
						<?php endif; ?>
					</a>
				</li>
				<?php
					} else if($dataUser['level']==3) {
				?>
				<li <?php echo($this->uri->segment(2)=='barang_disetujui')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_disetujui'); ?>">
						<i class="fa fa-list"></i> <span>Daftar Barang Disetujui</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='form_add')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/form_add'); ?>">
						<i class="fa fa-edit"></i> <span>Tambah Barang</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='barang_masuk')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_masuk'); ?>">
						<i class="fa fa-clock-o"></i> <span>Daftar Barang Tunggu</span>
						<?php if($jml_brg_tunggu>0): ?>
						<span class="pull-right-container">
							<small class="label pull-right bg-orange"><?=$jml_brg_tunggu;?></small>
						</span>
						<?php endif; ?>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='barang_ditolak')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_ditolak'); ?>">
						<i class="fa fa-file"></i> <span>Daftar Barang Ditolak</span>
					</a>
				</li>
				<?php
					} else {
				?>
				<li <?php echo($this->uri->segment(2)=='barang_disetujui')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_disetujui'); ?>">
						<i class="fa fa-list"></i> <span>Daftar Barang Disetujui</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='form_add')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/form_add'); ?>">
						<i class="fa fa-edit"></i> <span>Tambah Barang</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='barang_masuk')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_masuk'); ?>">
						<i class="fa fa-clock-o"></i> <span>Daftar Barang Tunggu</span>
						<?php if($jml_brg_tunggu>0): ?>
						<span class="pull-right-container">
							<small class="label pull-right bg-orange"><?=$jml_brg_tunggu;?></small>
						</span>
						<?php endif; ?>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='barang_ditolak')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_ditolak'); ?>">
						<i class="fa fa-file"></i> <span>Daftar Barang Ditolak</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='barang_divalidasi')?'class="active"':'';?>>
					<a href="<?php echo base_url('user/barang_divalidasi'); ?>">
						<i class="fa fa-undo"></i> <span>Daftar Barang Divalidasi</span>
					</a>
				</li>
				<?php
					}
				?>
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content" style="min-height:0;padding-top:0;padding-bottom:0;">
			<div class="row">
				<div class="col-md-12">
					<?php if($this->session->flashdata('info') != null): ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-info"></i> Success!</h4>
						<?=$this->session->flashdata('info');?>
					</div>
					<?php endif; ?>	
					<?php if($this->session->flashdata('danger') != null): ?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						<?=$this->session->flashdata('danger');?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>