<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-dark-ifn">
				<div class="panel-body pan">
					<input type="text" id="adalah" value="<?= $dataasli ?>" class="hilang">
					<div class="col-sm-12">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-md-3 control-label" style="text-align: left;" for="inputDefault">Nama Validator / Releaser</label>
								<div class="col-md-9">
									<select class="form-control input-sm" name="nmvalid" id="nmvalid" style="font-size: 14px;">
										<option value="">-- Pilih --</option>
										<?php foreach ($datavalid->result_array() as $data) { ?>
											<option value="<?= $data['id'] ?>" <?php if ($current == $data['id']) {
																					echo "selected";
																				} ?>><?= $data['nama'] . '( ' . $data['noinduk'] . ' ) # ' . $data['bagian'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="text-center">
						<a href="#" class="btn btn-sm btn-success text-black" id="simpan">Simpan</a>
						<a href="#" class="btn btn-sm btn-info text-black" id="keluar">Batal</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$("#keluar").on('click', function() {
			$(".close").click();
		})
		$("#simpan").on('click', function() {
			var ie = $("#adalah").val();
			var is = $("#nmvalid").val();
			$.ajax({
				dataType: 'json',
				type: "POST",
				url: base_url + 'Validator/simpanvalid',
				data: {
					id: ie,
					isi: is
				},
				success: function(data) {
					$("#keluar").click();
					$("#xnamavalid" + ie).html(data[0].namavalid);
					$(".tabelakses tr.aktif").click();
				}
			})
		})
	</script>