
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
	<?php if(isset($footer) and $footer=='user'): ?>
		<script src="<?= LOK_PAGE ?>js/user.js"></script>
		<script src="<?= LOK_PAGE ?>js/keluarga.js"></script>
	<?php endif; ?>
	<?php if(isset($footer) and $footer=='konfirm'): ?>
		<script src="<?= LOK_PAGE ?>js/webcam/qrcodelib.js"></script>
		<script src="<?= LOK_PAGE ?>js/webcam/webcodecamjs.js"></script>
		<script src="<?= LOK_PAGE ?>js/webcam/main.js"></script>
		<script src="<?= LOK_PAGE ?>js/konfirm.js"></script>
	<?php endif; ?>
	<?php if(isset($footer) and $footer=='repkonfirm'): ?>
		<script src="<?= LOK_PAGE ?>js/konfirmrep.js"></script>
	<?php endif; ?>
	<?php if($this->session->flashdata('pesan')=='qrcodeberhasil'){ ?>
		<script>swal("Terima kasih!", "Scan barcode surat izin berhasil", "success"); </script>
	<?php } $this->session->set_flashdata('pesan',''); ?>
	<?php if($this->session->flashdata('msg')==''){ ?> <!-- Pesan Msg untuk tanda error upload dokumen -->
		<?php if($this->session->flashdata('pesancuti')!=''){ ?> 
			<?php if($this->session->flashdata('pesancuti')=='simpancutiberhasil'){ ?>  <!-- Pesan Pesancuti untuk tanda success simpan data cuti -->
				<script>swal("Berhasil!", "Permohonan Surat Cuti berhasil dibuat, lihat di Riwayat", "success"); </script>
			<?php } ?>
			<?php if($this->session->flashdata('pesancuti')=='simpancutigagal'){ ?>  <!-- Pesan Pesancuti untuk tanda success simpan data cuti -->
				<script>swal("Gagal!", "Permohonan Surat Cuti gagal dibuat, cek data di Riwayat apakah pernah dibuat", "error"); </script>
			<?php } ?>
		<?php } $this->session->set_flashdata('pesancuti',''); ?>
		<?php if($this->session->flashdata('pesanizin')!=''){ ?>
			<?php if($this->session->flashdata('pesanizin')=='simpanizinberhasil'){ ?>
				<script>swal("Berhasil!", "Permohonan Surat Izin berhasil dibuat, lihat di Riwayat", "success"); </script>
			<?php } ?>
			<?php if($this->session->flashdata('pesanizin')=='simpanizingagal'){ ?>
				<script>swal("Gagal!", "Permohonan Surat Izin gagal dibuat, cek data di Riwayat apakah pernah dibuat", "error"); </script>
			<?php } ?>
		<?php } $this->session->set_flashdata('pesanizin',''); ?>
		<?php if($this->session->flashdata('pesanabsen')!=''){ ?>
			<?php if($this->session->flashdata('pesanabsen')=='simpanabsenberhasil'){ ?>
				<script>swal("Berhasil!", "Permohonan Surat Absen berhasil dibuat, lihat di Riwayat", "success"); </script>
			<?php }  ?>
			<?php if($this->session->flashdata('pesanabsen')=='simpanabsengagal'){ ?>
				<script>swal("Gagal!", "Permohonan Surat Izin Absen dibuat, cek data di Riwayat apakah pernah dibuat", "error"); </script>
			<?php } ?>
		<?php } $this->session->set_flashdata('pesanabsen',''); ?>
	<?php } $this->session->set_flashdata('pesanabsen',''); $this->session->set_flashdata('pesanizin',''); $this->session->set_flashdata('pesancuti','');?>
	<?php if($this->session->flashdata('msg')!=''){ isilogerror('SuratHRD',$this->session->flashdata('ketlain').'Error -> '.$this->session->flashdata('msg')) ?>
		<script>pesan("Ada masalah upload dokumen, pastikan ukuran foto max 2MB dan berformat JPG,JPEG,PNG atau GIF","error");</script>
	<?php } $this->session->set_flashdata('msg','');$this->session->set_flashdata('ketlain',''); ?>
	<script type="text/javascript">
		$(".nano").nanoScroller();
		<?php if($this->session->flashdata('simpanfoto')=='berhasil'){ ?>
			pesan('Ubah foto profile berhasil','info');
		<?php } $this->session->set_flashdata('simpanfoto','') ?>
		<?php if($this->session->flashdata('info') == 'tidakberhak'){ ?>
			pesan('Anda tidak berhak mengakses Menu Ini','info');
		<?php }elseif($this->session->flashdata('info') == 'underconstruction'){ ?>
			pesan('Halaman Ini dalam pembuatan, hubungi IT','info');
		<?php } ?>
	</script>
	</body>
</html>
