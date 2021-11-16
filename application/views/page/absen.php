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
									<div class="col-sm-4"></div>
									<div class="col-sm-4"></div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-md-6 control-label" for="inputDefault">Tanggal Pengajuan</label>
											<div class="col-md-6">
												<input type="text" class="form-control input-sm" value="<?= tglhariini(date('d-m-Y')); ?>" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr class="small">
							<div class="col-sm-12 bg-abu" style="padding-top: 5px;">
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
								<form method="POST" id="formabsen" name="formabsen" action="<?= $formaction ?>" enctype="multipart/form-data">
									<div class="col-sm-5 font-kecil" id="setjeniscuti">
										<input type="text" id="jnizinx" name="jnizinx" hidden value="<?= $jnabsen ?>">
										<input type="text" id="idx" name="idx" hidden value="<?= $idx ?>">
										<div class="form-horizontal">
											<div class="row">
												<div class="form-group" id="formjncuti">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Alasan Absen</label>
													<div class="col-md-8">
														<select class="form-control input-sm" name="jnabsen" id="jnabsen" >
															<option value="">--Pilih--</option>
															<option value="SD" <?php if($jnabsen=='SD'){ echo 'selected'; } ?>>Surat Dokter</option>
															<option value="OP" <?php if($jnabsen=='OP'){ echo 'selected'; } ?>>Opname</option>
															<option value="DS" <?php if($jnabsen=='DS'){ echo 'selected'; } ?>>Dispensasi</option>
															<option value="I" <?php if($jnabsen=='I'){ echo 'selected'; } ?>>Izin</option>
														</select>
													</div>
												</div>
												<div class="form-group" id="formtgldari">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Dari Tanggal</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm tglpilih" id="tgldari" name="dari" value="<?= $dari ?>">
													</div>
												</div>
												<div class="form-group" id="formtglsampai">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Sampai dengan</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm tglpilih" id="tglsampai" name="sampai" value="<?= $sampai ?>">
													</div>
												</div>
												<div class="form-group" id="formketerangan">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Keterangan</label>
													<div class="col-md-8">
														<textarea class="form-control input-sm" id="ket" name="ket"><?= $ket ?></textarea>
													</div>
												</div>
												<div class="form-group" id="formketerangan">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Bukti dokumen (bila ada)</label>
													<div class="col-md-8 text-center">
														<div style="border: 2px dashed #adadad;" id="adddokumen">
															<a href="" style="text-decoration: none;">
																<img src="<?=LOK_PAGE ?>images/add-files.svg" style="width: 100%; height: 150px; min-height: 150px;" id="gbimage" >
																<div style="font-size: 10px; color:black;">Tarik gambar kesini atau <strong class="text-red"><u>Cari</u></strong></div>
															</a>
														</div>
														<input type="file" class="hidden" accept="image/*" id="dokumen" name="dokumen" onchange="loadFile(event)">
													</div>
												</div>
											</div>
										</div>
										<hr class="small">
										</form>
										<div class="text-center" id="formtombol" style="margin-top: 10px;">
											<a class="btn btn-xs btn-success btn-flat" id="kirimabsen" rel="<?= $kode ?>"><i class="fa fa-check"></i> <?= $kode ?></a>
											<a class="btn btn-xs btn-danger btn-flat" id="batalabsen"><i class="fa fa-times"></i> Batal</a>
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