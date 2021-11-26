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
										<select class="form-control input-sm font-kecil" id="kodeshift">
											<option value="">-- Pilih Shift --</option>
											<?php foreach($shift->result_array() as $data): ?>
												<option value="<?= $data['kode'] ?>"><?= $data['namashift'] ?></option>
											<?php endforeach; ?>
										</select>
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
							<?php $no=0; foreach($jemput->result_array() as $datajemput): $no++; ?>
								<tr>
									<td id="namabus<?= $no ?>" rel="<?= $datajemput['idbus'] ?>"><?= $datajemput['nmpo'] ?></td>
									<td style="text-align: center; font-size: 16px;"><a href="#" id="masuk"  rel="masuk<?= $no?>"><i id="ms<?= $no ?>" class="fa fa-square-o"></i></a></td>
									<td style="text-align: center; font-size: 16px;"><a href="#" id="keluar" rel="keluar<?= $no?>"><i id="pl<?= $no ?>" class="fa fa-square-o"></i></a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<hr class="small">
					<div style="text-align: center;">
						<a href="#" class="btn btn-xs btn-success btn-flat" id="simpanabsenbus" ><i class="fa fa-check"></i> Simpan</a>
						<a href="#" class="btn btn-xs btn-danger btn-flat" id="keluarabsenbus" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$("#simpanabsenbus").click(function(){
		var kode = $("#kodeshift").val();
		if(kode==''){
			pesan('Pilih Shift Dahulu');
			return false;
		}
		var ke = "<?= $no ?>";
		var xhitung = 0;
		for(x=1;x<=ke;x++){
			var idbuse = $("#namabus"+x).attr('rel');
			var elm1 = $("#ms"+x).hasClass('fa-check-square-o');
			var elm2 = $("#pl"+x).hasClass('fa-check-square-o');
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
				url : "<?= base_url().'busabsen/adddata' ?>",
				data : {idbus : idbuse, kodeshift : kode, masuk : data1, pulang : data2},
				success : function(data){
					xhitung = xhitung + 1;
					if(xhitung == ke){
						$("#keluarabsenbus").click();
						window.location.reload();
					}
				}
			})
		}
	})
</script>