	<div id="ifn-main">
		<div class="main-page">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-dark-ifn">
					  <div class="panel-heading">
					    <h3 class="panel-title"><?= $judul ?></h3>
					  </div>
					  <div class="panel-body pan">
					    <div class="row">
						<div class="col-sm-12">
							<div class="form-horizontal">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-md-4 control-label" for="inputDefault">Jenis Izin</label>
											<div class="col-md-7">
												<select class="form-control input-sm" name="jnizin" id="jnizin" >
													<option value="">--Pilih--</option>
													<option value="IT" <?php if($jnizin=='IT'){ echo 'selected'; } ?>>Terlambat</option>
													<option value="IP" <?php if($jnizin=='IP'){ echo 'selected'; } ?>>Pulang</option>
													<option value="IE" <?php if($jnizin=='IE'){ echo 'selected'; } ?>>Keluar</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-4"></div>
									<div class="col-sm-4">
										<!-- <div class="form-group">
											<label class="col-md-6 control-label" for="inputDefault">Tanggal Pengajuan</label>
											<div class="col-md-6">
												<input type="text" class="form-control input-sm" value="" readonly>
											</div>
										</div> -->
									</div>
								</div>
							</div>
							<hr class="small">
							<div class="col-sm-12 bg-abu">
								<div class="col-sm-7">
									<div id="foto-profile-kecil" class="col-sm-2 text-center" style="padding-top: 12px;">
										<?php $fotoprofile = $this->session->userdata('foto')=='' ? base_url().'assets/images/noimageava.png' : LOK_FOTO_MESIN.$this->session->userdata('foto'); ?>
										<img src="<?= $fotoprofile ?>">
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
									PILIH IZIN
								</div>
								<form method="POST" id="formizin" name="formizin" action="<?= $formaction ?>">
									<div class="col-sm-5 font-kecil hilang" id="setjeniscuti">
										<input type="text" id="jnizinx" name="jnizinx" hidden value="<?= $jnizin ?>">
										<input type="text" id="idx" name="idx" hidden value="<?= $idx ?>">
										<div class="form-horizontal">
											<div class="row">
												<div class="form-group" id="formtgldari">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Tanggal</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="tgl_izin" name="tgl_izin" value="<?php if(!isset($tglizin)) { echo date('d-m-Y'); }else{ echo tglmysql($tglizin); } ?>" readonly>
													</div>
												</div>
												<div class="form-group" id="formmasuk">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Masuk</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="masuk" name="masuk" maxlength="5" value="<?= $masuk ?>"> 
													</div>
												</div>
												<div class="form-group" id="formpulang">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Pulang</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="pulang" name="pulang" maxlength="5" value="<?= $pulang ?>">
													</div>
												</div>
												<div class="form-group" id="formkeluar">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Keluar</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="keluar" name="keluar" maxlength="5" value="<?= $keluar ?>">
													</div>
												</div>
												<div class="form-group" id="formkembali">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Kembali</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="kembali" name="kembali" maxlength="5" value="<?= $kembali ?>">
													</div>
												</div>
												<div class="form-group" id="formketerangan">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Keterangan</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="alasan" name="alasan" value="<?= $alasan ?>">
													</div>
												</div>
											</div>
										</div>
										<hr class="small">
										</form>
										<div class="text-center" id="formtombol" style="margin-top: 10px;">
											<a class="btn btn-xs btn-success btn-flat" id="kirimizin" rel="<?= $kode ?>"><i class="fa fa-check"></i> <?= $kode ?></a>
											<a class="btn btn-xs btn-danger btn-flat" id="batalizin"><i class="fa fa-times"></i> Batal</a>
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