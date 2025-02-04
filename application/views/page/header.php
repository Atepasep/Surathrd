<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>HRD PT.Indoneptune Net Mfg</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="<?= LOK_PAGE ?>images/favicon.png">

	<!-- <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet"> -->

	<link rel="stylesheet" href="<?= LOK_PAGE ?>css/animate.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>css/icomoon.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>css/flexslider.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/nanoscroller/nanoscroller.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/sweetalert/css/sweetalert.css" />
	<link rel="stylesheet" type="text/css" href="<?= LOK_PAGE ?>vendor/toast/jquery.toast.min.css">
	<!-- datatables -->
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/datatables/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/datatables/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>vendor/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= LOK_PAGE ?>css/style.css">
	<script src="<?= LOK_PAGE ?>js/modernizr-2.6.2.min.js"></script>
	<!-- PDF OBJECT -->
	<script src="<?= LOK_PAGE ?>js/pdfobject.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
		base_url = '<?= base_url() ?>';
	</script>
</head>

<body>
	<div class="modal fade" id="modalBox" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class='modal-dialog modal-lg'>
			<div class='modal-content'>
				<div class='modal-header bg-warning'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title' id='myModalLabel'> Pengaturan Pengguna</h4>
				</div>
				<div class="fetched-data"></div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalBox2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class='modal-dialog modal-lg'>
			<div class='modal-content'>
				<div class='modal-header btn-info'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title' id='myModalLabel'> Pilih P/O</h4>
				</div>
				<div class="modal-body" style="max-height: 350px; overflow: auto;">
					<div class="row">
						<div class="col-sm-12">
							<hr class="small">
							<div class="table-responsive tabler">
								<table class="table table-bordered table-striped table-hover responsive nowrap" id="bodi">

								</table>
								<hr class="small">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="text-center" style="margin-top: 20px;">
							<a href="#" class="btn btn-sm btn-warning" data-dismiss="modal" id="tutuppilih"><i class="fa fa-times"></i> Tutup</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalBox3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class='modal-dialog modal-lg' style="width: 100% !important;">
			<div class='modal-content'>
				<div class='modal-header bg-warning'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title' id='myModalLabel'> Pengaturan Pengguna</h4>
				</div>
				<div class="fetched-data"></div>
			</div>
		</div>
	</div>
	<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' data-backdrop="static" data-keyboard="false">
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header btn-info'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
				</div>
				<div class='modal-body'>
					Apakah Anda yakin ingin menghapus data ini?
				</div>
				<div class='modal-footer'>
					<a class='btn-ok'>
						<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-trash-o'></i> Hapus</button>
					</a>
					<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
				</div>
			</div>
		</div>
	</div>
	<div class='modal fade' id='confirm-task' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header btn-info'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
				</div>
				<div class='modal-body'>
					<div id="test">
						Apakah Anda yakin ingin menghapus data ini?
					</div>
				</div>
				<div class='modal-footer'>
					<a class='btn-oke'>
						<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-check'></i> Ya</button>
					</a>
					<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tidak</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	if (isset($act)) {
		$m1 = '';
		$m2 = '';
		$m3 = '';
		$m4 = '';
		$m5 = '';
		$m6 = '';
		$m7 = '';
		$m8 = '';
		$m9 = '';
		$m10 = '';
		$m11 = '';
		$m12 = '';
		if ($act == 1) {
			$m1 = 'ifn-active';
		} elseif ($act == 2) {
			$m2 = 'ifn-active';
		} elseif ($act == 3) {
			$m3 = 'ifn-active';
		} elseif ($act == 5) {
			$m5 = 'ifn-active';
		} elseif ($act == 6) {
			$m6 = 'ifn-active';
		} elseif ($act == 7) {
			$m7 = 'ifn-active';
		} elseif ($act == 8) {
			$m8 = 'ifn-active';
		} elseif ($act == 9) {
			$m9 = 'ifn-active';
		} elseif ($act == 10) {
			$m10 = 'ifn-active';
		} elseif ($act == 11) {
			$m11 = 'ifn-active';
		} elseif ($act == 12) {
			$m12 = 'ifn-active';
		} else {
			$m4 = 'ifn-active';
		}

		// $modul = $this->session->userdata('modul');
		// $m2 .= cekmod2($modul,0);
		// $m3 .= cekmod2($modul,1);
		// $m4 .= cekmod2($modul,2);
		// $m5 .= cekmod2($modul,3);
		// $m6 .= cekmod2($modul,4);
		// $m7 .= cekmod2($modul,5);
		// // 6 untuk upload foto
		// $m8 .= cekmod2($modul,7);
		// $m9 .= cekmod2($modul,8);
		// $m10 .= cekmod2($modul,9);
	}
	?>
	<div id="ifn-page">
		<a href="#" class="js-ifn-nav-toggle ifn-nav-toggle"><i></i></a>
		<aside id="ifn-aside" role="complementary" class="border js-fullheight" class="nano">
			<div id="ifn-logo"><a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/logodepan2.png"></a></div>
			<div class="overlay"></div>
			<nav id="ifn-main-menu" role="navigation">
				<ul>
					<li class="<?= $m1 ?>"><a href="<?= base_url() ?>">Dashboard</a></li>
					<?php if (substr($this->session->userdata('kritper'), 0, 1) == '0' || substr($this->session->userdata('kritper'), 0, 1) == '4' || substr($this->session->userdata('kritper'), 0, 1) == '5') { ?>
						<li class="<?= $m2 ?>"><a href="<?= base_url() . 'cuti' ?>" title="Permohonan Cuti dan Izin Khusus">Cuti dan Izin khusus</a></li>
					<?php } ?>
					<li class="<?= $m3 ?>"><a href="<?= base_url() . 'izin' ?>" title="surat izin keluar, pulang, terlambat">Izin P/L/K</a></li>
					<li class="<?= $m4 ?>"><a href="<?= base_url() . 'absen' ?>" title="surat keterangan tidak masuk">Keterangan Absen</a></li>
					<?php if (trim($this->session->userdata('bagian')) == 'IT' || trim($this->session->userdata('bagian')) == 'SATPAM' || trim($this->session->userdata('bagian')) == 'PERSONALIA') { ?>
						<li class="<?= $m9 ?>"><a href="<?= base_url() . 'busabsen' ?>" title="Absen bus jemputan">Absen Bus</a></li>
					<?php } ?>
					<li class="<?= $m12 ?>"><a href="<?= base_url() . 'presensi/clear' ?>" title="Input Presensi">Presensi</a></li>
					<?php if ($this->session->userdata('hakdep') != "'X'") { ?>
						<li class="<?= $m5 ?>"><a href="<?= base_url() . 'spl' ?>" title="Surat Perintah Lembur">Overtime</a></li>
					<?php } ?>
					<li class="<?= $m7 ?>"><a href="<?= base_url() . 'kupmak' ?>" title="Input Kupon Makan">Kupon Makan</a></li>
					<li class="<?= $m10 ?>"><a href="<?= base_url() . 'slip' ?>" title="View Slip GAji">Slip Gaji</a></li>
					<li class="<?= $m8 ?>"><a href="<?= base_url() . 'profile' ?>" title="Ubah ID Key">Profile</a></li>
					<br>
					<br>
					<?php if (trim($this->session->userdata('bagian')) == 'IT' || trim($this->session->userdata('bagian')) == 'PERSONALIA') { ?>
						<li class="<?= $m11 ?>"><a href="<?= base_url() . 'validator/clear' ?>">Validator</a></li>
					<?php } else {
						echo '<br>';
					} ?>
					<li><a href="<?= base_url() . 'Apps/logout' ?>">Log Out</a></li>
				</ul>
			</nav>

			<div class="ifn-footer">
				<ul>
					<li><a href="#"><i class="icon-facebook2"></i></a></li>
					<li><a href="#"><i class="icon-twitter2"></i></a></li>
					<li><a href="#"><i class="icon-instagram"></i></a></li>
					<li><a href="#"><i class="icon-linkedin2"></i></a></li>
				</ul>
			</div>

		</aside>