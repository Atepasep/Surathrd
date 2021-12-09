
	<script src="<?= LOK_PAGE ?>vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?= LOK_PAGE ?>js/jquery.easing.1.3.js"></script>
	<script src="<?= LOK_PAGE ?>js/jquery.waypoints.min.js"></script>
	<script src="<?= LOK_PAGE ?>js/jquery.flexslider-min.js"></script>
	<script src="<?= LOK_PAGE ?>js/sticky-kit.min.js"></script>
	<script src="<?= LOK_PAGE ?>js/owl.carousel.min.js"></script>
	<script src="<?= LOK_PAGE ?>js/jquery.countTo.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/nanoscroller/nanoscroller.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/bootstrap/js/bootstrap.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/sweetalert/js/sweetalert.min.js"></script>

	<!-- dataTablses -->
	<script src="<?= LOK_PAGE ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/datatables/js/dataTables.bootstrap.min.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/datatables/js/responsive.bootstrap.min.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/toast/jquery.toast.min.js"></script>

	<!-- MAIN JS -->
	<script src="<?= LOK_PAGE ?>js/main.js"></script>
	<script src="<?= LOK_PAGE ?>js/myscript.js"></script>
	<?php if(isset($footer) and $footer=='cuti'): ?>
		<script src="<?= LOK_PAGE ?>js/cuti.js"></script>
	<?php endif; ?>
	<?php if(isset($footer) and $footer=='dash'): ?>
		<script src="<?= LOK_PAGE ?>js/apps.js"></script>
	<?php endif; ?>
	<?php if(isset($footer) and $footer=='izin'): ?>
		<script src="<?= LOK_PAGE ?>js/izin.js"></script>
	<?php endif; ?>
	<?php if(isset($footer) and $footer=='absen'): ?>
		<script src="<?= LOK_PAGE ?>js/absen.js"></script>
	<?php endif; ?>
	<?php if(isset($footer) and $footer=='akses'): ?>
		<script src="<?= LOK_PAGE ?>js/akses.js"></script>
	<?php endif; ?>
	<?php if(isset($footer) and $footer=='busabsen'): ?>
		<script src="<?= LOK_PAGE ?>js/busabsen.js"></script>
	<?php endif; ?>
	<?php if(isset($footer) and $footer=='konfirm'): ?>
		<script src="<?= LOK_PAGE ?>js/webcam/qrcodelib.js"></script>
		<script src="<?= LOK_PAGE ?>js/webcam/webcodecamjs.js"></script>
		<script src="<?= LOK_PAGE ?>js/webcam/main.js"></script>
		<script src="<?= LOK_PAGE ?>js/konfirm.js"></script>
	<?php endif; ?>
	<?php if($this->session->flashdata('pesan')=='qrcodeberhasil'){ ?>
		<script>swal("Terima kasih!", "Scan barcode surat izin berhasil", "success"); </script>
	<?php } $this->session->set_flashdata('pesan',''); ?>
	<script type="text/javascript">
		$(".nano").nanoScroller();
		<?php if($this->session->flashdata('info') == 'tidakberhak'){ ?>
			pesan('Anda tidak berhak mengakses Menu Ini','info');
		<?php }elseif($this->session->flashdata('info') == 'underconstruction'){ ?>
			pesan('Halaman Ini dalam pembuatan, hubungi IT','info');
		<?php } ?>
	</script>
	</body>
</html>
