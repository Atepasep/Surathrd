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
										<tr>
											<td>No Hp</td>
											<td>:</td>
											<td><?= $profileuser['nohp'] ?></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>:</td>
											<td><?= $profileuser['alamat'] ?></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-sm-5 kolom-idkey-pertama">
								<div class="kolom-idkey">
									<div class="form-horizontal">
										<div class="row">
											<div class="form-group" id="formtgldari">
												<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">ID Key</label>
												<div class="col-md-8">
													<input type="text" class="form-control input-sm" id="idkey" name="idkey" value="<?= ubahpagar($profileuser['idkey']) ?>" readonly>
													<div style="margin-top: 5px;">
														<a href="<?= base_url().'profile/ubahidkey' ?>" class="btn btn-xs btn-success" id="ubahidkey" data-remote="false" data-toggle="modal" data-title="View Data" data-target="#modalBox" title="View Data"><i class="fa fa-key"></i> Ubah ID Key</a>
													</div>	
												</div>
											</div>
										</div>
									</div>
									<hr class="small">
									Foto Profile (Under Construction)
									<div class="form-horizontal">
										<div class="row">
											<div class="form-group">
												<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault"></label>
												<div class="col-md-8">
													<div style="border: 2px dashed #adadad; text-align:center;" id="adddokumen">
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
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>