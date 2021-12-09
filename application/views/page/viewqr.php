<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-dark-ifn">
			<div class="panel-body pan">
				<div class="col-sm-12">
					<div style="text-align:center;">
						<div>Silahkan Scan Qr Code</div>
						<img src="<?= $qr.'.png' ?>" style="width: 160px; height:auto;" >
						<div>Surat <strong><?= $jenis ?></strong></div>
					</div>
				</div>
				<hr>
				<div class="text-center">
					<a href="#" class="btn btn-sm btn-info text-black" id="keluar">Keluar</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$("#keluar").on('click',function(){
		var gb = "<?= $qr ?>";
		$.ajax({
			dataType : "json",
			type : "POST",
			url : "<?php echo base_url().'apps/hapusqr'; ?>",
			data : {gambar : gb },
			success : function(data){
				if(data==1){
					$(".close").click();
				}else{
					alert('Data undefined, hubnugi administrator data');
				}
			}
		})
	})
</script>