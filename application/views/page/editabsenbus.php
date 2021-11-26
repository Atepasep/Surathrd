<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-dark-ifn">
			<div class="panel-body pan">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-horizontal">
								<div class="form-group font-kecil" id="formtgldari">
									<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Tanggal</label>
									<div class="col-md-6">
										<input type="text" class="form-control font-kecil input-sm" id="tglabsen" readonly value="<?= $this->session->flashdata('tglabsen') ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-horizontal">
								<div class="form-group font-kecil" id="formtgldari">
									<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Shift</label>
									<div class="col-md-6">
										<input type="text" class="form-control font-kecil input-sm" id="shift" readonly value="<?= $absenbus['namashift'] ?>">
										<input type="hidden" id="idrek" value="<?= $absenbus['id'] ?>" >
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr class="small">
					<table class="table table-bordered table-striped table-hover nowrap responsive font-kecil">
						<thead style="background-color: #D8EFE2;">
						<tr>
							<th class="text-center">Nama Jemputan</th>
							<th class="text-center">Masuk</th>
							<th class="text-center">Pulang</th>
						</tr>
						</thead>
						<tbody>
								<tr>
									<td id="namabus" rel="<?= $absenbus['idbus'] ?>"><?= $absenbus['nmpo'] ?></td>
									<td style="text-align: center; font-size: 16px;">
										<a href="#" id="masuk"  rel="masuk">
											<?php 
												$klas = $absenbus['masuk']==1 ? 'fa-check-square-o' : 'fa-square-o' ;
											?>
											<i id="ms" class="fa <?= $klas ?>"></i>
										</a>
									</td>
									<td style="text-align: center; font-size: 16px;">
										<a href="#" id="keluar" rel="keluar">
											<?php 
												$klas2 = $absenbus['pulang']==1 ? 'fa-check-square-o' : 'fa-square-o' ;
											?>
											<i id="pl" class="fa <?= $klas2 ?>"></i>
										</a>
									</td>
								</tr>
						</tbody>
					</table>
					<hr class="small">
					<div style="text-align: center;">
						<a href="#" class="btn btn-xs btn-success btn-flat" id="editabsenbus" ><i class="fa fa-save"></i> Update</a>
						<a href="#" class="btn btn-xs btn-danger btn-flat" id="keluarabsenbus" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$("#editabsenbus").click(function(){
			var ide = $("#idrek").val();
			var elm1 = $("#ms").hasClass('fa-check-square-o');
			var elm2 = $("#pl").hasClass('fa-check-square-o');
			var data1 = 0;
			var data2 = 0;
			if(elm1){
				data1 = 1;
			}
			if(elm2){
				data2 = 1;
			}
			$.ajax({
				dataType: 'json',
				type : "POST",
				url : "<?= base_url().'busabsen/editdata' ?>",
				data : {id : ide, masuk : data1, pulang : data2},
				success : function(data){
					if(data){
						$("#keluarabsenbus").click();
						window.location.reload();
					}
				}
			})
		})
</script>