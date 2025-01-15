<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-dark-ifn">
			<div class="panel-body pan">
				<div class="col-sm-12">
					<div class="form-horizontal">
						<form method="POST" action="<?= $formAction ?>" name="formlatitude">
						<input type="hidden" id="id" name="id" value="<?= $data['id'] ?>">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">Latitude<div class="small-desc"></div></label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm" id="latitude" name="latitude" value="<?= $data['latitude'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">Longitude</label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm" id="longitude" name="longitude" value="<?= $data['longitude'] ?>">
									</div>
								</div>
								<div class="form-group mt-2">
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">Radius (meter)</label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm" id="jarak" name="jarak" value="<?= $data['jarak'] ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					</form>
					<hr class="small">
					<div style="text-align: right;">
						<a href="#" class="btn btn-sm btn-success flat" id="tombolsave"><i class="fa fa-save"></i> Simpan</a>
						<a href="#" class="btn btn-sm btn-danger flat" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".tglpilih").datepicker({
		autoclose : true,
		format : 'dd-mm-yyyy'
		})
	})
	$("#tombolsave").click(function(){
		if($("#latitude").val()=='' || $("#longitude").val()=='' || $("#jarak").val()==''){
			pesan('Isi data dengan lengkap','info');
		}else{
			document.formlatitude.submit();
		}
	})
</script>