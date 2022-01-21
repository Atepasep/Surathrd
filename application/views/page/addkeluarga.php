<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-dark-ifn">
			<div class="panel-body pan">
				<div class="col-sm-12">
					<div class="form-horizontal">
						<form method="POST" action="<?= $formAction ?>" name="formkeluarga">
						<input type="hidden" id="id" name="id" value="<?= $id ?>">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">No KTP<div class="small-desc">sesuai KK</div></label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm" id="nik" name="nik" value="<?= $nik ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">Nama Lengkap</label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm" id="nama" name="nama" value="<?= $nama ?>">
									</div>
								</div>
								<div class="form-group" >
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">Jenis Kelamin</label>
									<div class="col-md-8">
										<select class="form-control input-sm" name="jenkel" id="jenkel" name="jenkel" >
											<option value="">--Pilih--</option>
											<option value="L" <?php if($jenkel=='L'){echo "selected"; } ?>>Laki - Laki</option>
											<option value="P" <?php if($jenkel=='P'){echo "selected"; } ?>>Perempuan</option>
										</select>
									</div>
								</div>
								<div class="form-group mt-2">
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">Tempat Lahir</label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm" id="tmplahir" name="tmplahir" value="<?= $tmplahir ?>">
									</div>
								</div>
								<div class="form-group mt-2">
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">Tanggal Lahir</label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm tglpilih" id="tglahir" name="tglahir" value="<?= $tgllahir ?>">
									</div>
								</div>
								<hr class="small">
								<div class="form-group" >
									<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Pendidikan</label>
									<div class="col-md-8">
										<select class="form-control input-sm" name="id_pendidikan" id="id_pendidikan" name="id_pendidikan" >
											<option value="">--Pilih--</option>
											<?php foreach($pendidikan->result_array() as $didik){ ?>
												<option value="<?= $didik['id'] ?>" <?php if($id_pendidikan==$didik['id']){echo "selected"; } ?>><?= $didik['pendidikan'] ?></option>
											<?php } ?>
										</select>
										<input type="hidden" id="namapendidikan" name="namapendidikan" value="">
									</div>
								</div>
								<div class="form-group" >
									<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Pekerjaan</label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm" id="pekerjaan" name="pekerjaan" value="<?= $pekerjaan ?>">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group" >
									<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Status</label>
									<div class="col-md-8">
										<select class="form-control input-sm" name="id_statuskawin" id="id_statuskawin" name="id_statuskawin" >
											<option value="">--Pilih--</option>
											<?php foreach($status->result_array() as $statnikah){ ?>
												<option value="<?= $statnikah['id'] ?>" <?php if($id_statuskawin==$statnikah['id']){echo "selected"; } ?>><?= $statnikah['status'] ?></option>
											<?php } ?>
										</select>
										<input type="hidden" id="namastatus" name="namastatus" value="">
									</div>
								</div>
								<div class="form-group" >
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">Hubungan<div class="small-desc">dengan Karyawan</div></label>
									<div class="col-md-8">
										<select class="form-control input-sm" name="id_hubkeluarga" id="id_hubkeluarga" name="id_hubkeluarga" >
											<option value="">--Pilih--</option>
											<?php foreach($hubkeluarga->result_array() as $hubungan){ ?>
												<option value="<?= $hubungan['id'] ?>" <?php if($id_hubkeluarga==$hubungan['id']){echo "selected"; } ?>><?= $hubungan['hubungan'] ?></option>
											<?php } ?>
										</select>
										<input type="hidden" id="namahubungan" name="namahubungan" value="">
									</div>
								</div>
								<div class="form-group mt-2">
									<label class="col-md-4 control-label" style="text-align: left; padding-top: 3px; line-height: 15px;" for="inputDefault">NIK Indoneptune<div class="small-desc">apabila bekerja di IFN</div></label>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm tglpilih3" id="noinduk" name="noinduk" value="<?= $noinduk ?>">
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
		$("#id_pendidikan").change();
		$("#id_statuskawin").change();
		$("#id_hubkeluarga").change();
	})
	$("#tombolsave").click(function(){
		if($("#nama").val()=='' || $("#tmplahir").val()=='' || $("#tglahir").val()=='' || $("#id_statuskawin").val()=='' || $("#id_hubkeluarga").val()==''){
			pesan('Isi data dengan lengkap','info');
		}else{
			document.formkeluarga.submit();
		}
	})
	$("#id_pendidikan").on('change',function(){
		var ini = $("#id_pendidikan option:selected").text();
		if($(this).val()!=''){
			$("#namapendidikan").val(ini);
		}else{
			$("#namapendidikan").val('');
		}
	})
	$("#id_statuskawin").on('change',function(){
		var ini = $("#id_statuskawin option:selected").text();
		if($(this).val()!=''){
			$("#namastatus").val(ini);
		}else{
			$("#namastatus").val('');
		}
	})
	$("#id_hubkeluarga").on('change',function(){
		var ini = $("#id_hubkeluarga option:selected").text();
		if($(this).val()!=''){
			$("#namahubungan").val(ini);
		}else{
			$("#namahubungan").val('');
		}
	})
</script>