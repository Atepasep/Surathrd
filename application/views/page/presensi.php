	<div id="ifn-main">
		<div class="main-page">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-dark-ifn">
						<div class="panel-heading">
							<h3 class="panel-title">Presensi Karyawan</h3>
						</div>
						<div class="panel-body pan">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-horizontal">
										<div class="row">
											<div class="col-sm-4">
											</div>
											<div class="col-sm-4"></div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-md-6 control-label" for="inputDefault">Tanggal Presensi</label>
													<div class="col-md-6">
														<input type="text" class="form-control input-sm" value="<?= !isset($tgldibuat) ? tglhariini(date('d-m-Y')) : tglhariini(date('d-m-Y', strtotime($tgldibuat)));  ?>" readonly>
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr class="small">
									<div class="col-sm-12 bg-abu">
										<div class="col-sm-7">
											<div id="foto-profile-kecil" class="col-sm-2 text-center font-kecil" style="padding-top: 12px;">
												<?php $fotoprofile = $this->session->userdata('foto') == '' ? base_url() . 'assets/images/noimageava.png' : LOK_FOTO_MESIN . $this->session->userdata('foto'); ?>
												<img src="<?= $fotoprofile ?>" alt="<?= $this->session->userdata('foto'); ?>" >
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
														<td><?= tglmysql($profileuser['tglmasuk']) . ' (' . umur($profileuser['tglmasuk']) . ')'; ?></td>
													</tr>
												</table>
												<div id="formgs" class="hilang">
													<?php 
														if(isset($gps['latitude'])){
															$latitude = $gps['latitude'];
															$longitude = $gps['longitude'];
															$jarak = $gps['jarak'];
														}else{
															$latitude = 0;
															$longitude = 0;
															$jarak = 0;
														}
													 ?>
													<input type="text" id="latitude" value="<?= $latitude ?>">
													<input type="text" id="longitude" value="<?= $longitude; ?>">
													<input type="text" id="jarak" value="<?= $jarak; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-5 text-center">
											<input type="text" id="lokasinya" value="" class="hilang">
											<input type="text" id="tglku" value="<?= date('Y-m-d'); ?>" class="hilang">
											<div id="jam-masukkeluar" class="text-center" style="margin: auto; margin-top:10px; margin-bottom: 10px; border-bottom: 1px dashed rgba(0,0,0,0.2);">
												00:00
											</div>
											<span style="font-size: 12px;" id="jarakanda">Cek Jarak (Loading ...)</span><br>
											<span style="font-size: 16px;" class="text-danger" id="statusjarak">Not Allowed</span>
											<article class="hilang">
												<span id="button" class="hilang"><a href="#" id="ahref">Klik</a></span><br>
												<span id="status"></span>
											</article>
											<div class="text-center">
												<select class="form-control input-sm" name="jnabsen" id="jnabsen" style="width:50%;  margin: auto;" >
													<option value="">--Pilih--</option>
													<option value="masuk">ABSEN MASUK</option>
													<option value="pulang">ABSEN PULANG</option>
													<option value="keluar">ABSEN KELUAR</option>
													<option value="kembali">ABSEN KEMBALI</option>
												</select>
											</div>
											<div class="text-center mb-2" id="formtombol" style="margin-top: 10px;">
												<a class="btn btn-xs btn-success btn-flat disabled" id="kirimpresensi"><i class="fa fa-check"></i> SIMPAN PRESENSI</a>
												<a class="btn btn-xs btn-info btn-flat" id="synclokasi"><i class="fa fa-map-marker"></i> SYNC</a>
											</div>
											<div class="text-center mb-2 <?php if(trim($bagian['bagian']) != 'IT'){ echo 'hilang';} ?>" id="formtombol">
												<a href="<?= base_url().'presensi/setlatitude'; ?>" class="btn btn-xs btn-warning btn-flat text-black" data-remote="false" data-toggle="modal" data-title="Edit LAT LONG & RADIUS" data-target="#modalBox" title="Edit LAT LONG & RADIUS" id="setgps"><i class="fa fa-map-pin"></i> SET LAT LONG & RADIUS</a>
											</div>
											<div style="font-size: 8px !important; margin-bottom: 20px !important; line-height: 9px; margin-top: 5px;">
												<?= $latitude; ?>, <?= $longitude; ?> <br> Radius diperbolehkan <?= rupiah($jarak,1); ?> meter
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr class="small">
							<div class="bg-abu" style="padding: 5px 10px">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-horizontal">
											<div class="row">
												<div class="col-sm-4">
												</div>
												<div class="col-sm-4"></div>
												<div class="col-sm-4">
													<div class="form-group font-kecil">
														<label class="col-md-4 control-label" for="inputDefault">Periode</label>
														<div class="col-md-8">
															<div class="row">
																<div class="col-sm-8">
																	<select class="form-control input-sm" id="blpresensi">
																		<?php $bulan = isibulan(); for($x=1;$x<count($bulan);$x++): ?>
																		<option value="<?= $x; ?>" <?php if($this->session->userdata('blpresensi')==$x){ echo "selected"; } ?>><?= $bulan[$x]; ?></option>
																		<?php endfor; ?>
																	</select>
																</div>
																<div class="col-sm-4">
																	<input type="text" class="form-control input-sm" id="thpresensi" style="background-color: white;" value="<?= $this->session->userdata('thpresensi'); ?>">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?= $this->session->flashdata('pesan'); ?>
									<div class="col-sm-12 font-kecil table-responsive" style="padding: 10px 5px !important;">
										<table class="table table-bordered table-striped table-hover nowrap responsive">
											<thead style="background-color: #D8EFE2;">
												<tr>
													<th class="text-center">Tgl</th>
													<th class="text-center">Jenis Presensi</th>
													<th class="text-center">Jam</th>
													<th class="text-center">Lokasi Presensi</th>
													<th class="text-center">Jarak (m)</th>
													<th class="text-center">Jam Normal</th>
												</tr>
											</thead>
											<tbody>			
												<?php foreach ($data->result_array() as $dat): ?>
													<tr>
														<td><?= tglpanjang($dat['tgl'],1); ?></td>
														<td><?= ucwords($dat['jenis']); ?></td>
														<td><?= $dat['jam']; ?></td>
														<td><?= $dat['lokasi']; ?></td>
														<td class="text-right"><?= rupiah($dat['jarak'],2); ?></td>
														<td></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>