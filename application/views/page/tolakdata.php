<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-dark-ifn">
			<div class="panel-body pan">
				<div class="col-sm-12">
					<div class="form-group" id="formtgldari">
						<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Alasan Tolak</label>
						<div class="col-md-8">
							<input type="text" class="form-control input-sm" id="alasantolak" name="alasantolak">
						</div>
					</div>
				</div>
			</div>
			<div class="text-center" style="margin-top: 20px;">
					<a href="#" class="btn btn-sm btn-success" id="setuju"><i class="fa fa-check"></i> Konfirmasi</a>|
					<a href="#" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#setuju").click(function(){
		var alasan = $("#alasantolak").val();
		var idx =  '<?php echo $id; ?>';
		if(alasan==''){
			pesan('Alasan harus diisi ?');
		}else{
			$.ajax({
				dataType : "json",
				type : "POST",
				url : "<?php echo base_url().'cuti/tolakdatanya'; ?>",
				data : {id : idx, alasn : alasan },
				success : function(data){
					if(data==1){
						$(".close").click();
						location.reload();
					}
				}
			})
		}
	});
</script>
