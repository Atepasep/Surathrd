	<div id="ifn-main">
		<div class="main-page">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-dark-ifn">
					  <div class="panel-heading">
					    <h3 class="panel-title">Permohonan Cuti dan Izin Khusus</h3>
					  </div>
					  <div class="panel-body pan">
					    <div class="row">
						<div class="col-sm-12">
							<div class="form-horizontal">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-md-4 control-label" for="inputDefault">Jenis Cuti</label>
											<div class="col-md-7">
												<select class="form-control input-sm" name="jnsurat" id="jnsurat" >
													<option value="">--Pilih--</option>
													<option value="C" <?php if($jncuti=='C'){ echo 'selected'; } ?>>Cuti Tahunan</option>
													<option value="CP" <?php if($jncuti=='CP'){ echo 'selected'; } ?>>Cuti Panjang</option>
													<?php if($this->session->userdata('kel')=='P'){ ?>
														<option value="CH" <?php if($jncuti=='CH'){ echo 'selected'; } ?>>Cuti Haid</option>
													<?php } ?>
													<option value="IK" <?php if($jncuti=='IK'){ echo 'selected'; } ?>>Izin Khusus</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-4"></div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-md-6 control-label" for="inputDefault">Tanggal Pengajuan</label>
											<div class="col-md-6">
												<input type="text" class="form-control input-sm" value="<?= !isset($tgldibuat) ? tglhariini(date('d-m-Y')) :tglhariini(date('d-m-Y', strtotime($tgldibuat)));  ?>" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr class="small">
							<div class="col-sm-12 bg-abu">
								<div class="col-sm-7">
									<div id="foto-profile-kecil" class="col-sm-2 text-center" style="padding-top: 12px;">
										<img src="<?= base_url() ?>assets/images/noimageava.png">
									</div>
									<div id="ket-profile" class="col-sm-10 font-kecil">
										<table class="table borderless">
											<!-- <tr>
												<td colspan="3" class="bg-yellow" style="text-align: center;">Profile</td>
											</tr> -->
											<tr>
												<td style="width: 70px;">Nama</td>
												<td style="width: 10px;">:</td>
												<td style="font-weight: bold;"><?= $profileuser['nama'] ?></td>
											</tr>
											<tr>
												<td>No Induk</td>
												<td>:</td>
												<td><?= $profileuser['noinduk'] ?></td>
											</tr>
											<tr>
												<td>Bagian</td>
												<td>:</td>
												<td><?= $profileuser['bagian'] ?></td>
											</tr>
											<tr>
												<td>Jabatan</td>
												<td>:</td>
												<td><?= $profileuser['jabatan'] ?></td>
											</tr>
											<tr>
												<td>Tgl Masuk</td>
												<td>:</td>
												<td><?= tglmysql($profileuser['tglmasuk']).' ('.umur($profileuser['tglmasuk']).')'; ?></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="col-sm-5" id="notsetjeniscuti">
									PILIH JENIS CUTI
								</div>
								<form method="POST" id="formcuti" name="formcuti" action="<?= $formaction ?>">
									<div class="col-sm-5 font-kecil hilang" id="setjeniscuti">
										<input type="text" id="jnsuratx" name="jnsuratx" hidden value="<?= $jncuti ?>">
										<input type="text" id="idx" name="idx" hidden value="<?= $idx ?>" >
										<div class="form-horizontal">
											<div class="row">
												<div class="form-group" id="formjncuti">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Pilihan Cuti</label>
													<div class="col-md-8">
														<select class="form-control input-sm" name="jncuti" id="jncuti" name="jncuti" >
															<option value="">--Pilih--</option>
															<option value="1" <?php if($ambil==1){ echo 'selected'; } ?>>Ambil Cuti</option>
															<option value="2" <?php if($ambil==2){ echo 'selected'; } ?>>Tidak ambil Cuti</option>
														</select>
													</div>
												</div>
												<div class="form-group" id="formtgldari">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Dari Tanggal</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm tglpilih3" id="tgldari" name="dari" value="<?= $dari ?>">
													</div>
												</div>
												<div class="form-group" id="formtglsampai">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Sampai dengan</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm tglpilih3" id="tglsampai" name="sampai" value="<?= $sampai ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Selama</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="selama" name="lama" readonly value="<?= $jmhari ?>">
													</div>
												</div>
												<div class="form-group" id="formmasakerja">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Masa kerja ke</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="masakerja" name="masakerja" value="<?= $masakerja ?>">
													</div>
												</div>
												<div class="form-group" id="formalasan">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Alasan cuti</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="alasan" name="alasan" value="<?= $xalasan ?>">
													</div>
												</div>
												<div class="form-group" id="formtglik">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Tanggal</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm tglpilih" id="tglik" name="tglik" value="<?= $tglik ?>">
													</div>
												</div>
												<div class="form-group" id="formhariik">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Hari</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="hariik" name="hari" value="<?= $hariik ?>">
													</div>
												</div>
												<div class="form-group" id="formjamik">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Jam</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="jamik" name="jam" value="<?= $jamik ?>">
													</div>
												</div>
												<div class="form-group" id="formtempatik">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Tempat</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="tempatik" name="tempat" value="<?= $tempatik ?>">
													</div>
												</div>
											</div>
										</div>
										<hr class="small">
										</form>
										<div class="text-center" id="formtombol" style="margin-top: 10px;">
											<a class="btn btn-xs btn-success btn-flat" id="kirimcuti" rel="<?= $kode ?>"><i class="fa fa-check"></i> <?= $kode ?></a>
											<a class="btn btn-xs btn-danger btn-flat" id="batalcuti"><i class="fa fa-times"></i> Batal</a>
										</div>
									</div>
								
							</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>