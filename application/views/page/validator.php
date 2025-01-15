	<div id="ifn-main">
		<div class="main-page">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-dark-ifn">
						<div class="panel-heading">
							<h3 class="panel-title"><?= $judul ?></h3>
						</div>
						<div class="panel-body pan">
							<div style="font-size: 14px;margin-bottom:10px;" class="row">
								<div class="col-sm-2">
									<select class="form-control input-sm" name="nmbagian" id="nmbagian">
										<option value="">-- Pilih Bagian --</option>
										<?php foreach ($databagian->result_array() as $databag) { ?>
											<option value="<?= $databag['bagian'] ?>" <?php if ($this->session->userdata('bagianvalidator') == $databag['bagian']) {
																							echo "selected";
																						} ?>><?= $databag['bagian'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-2">
									<select class="form-control input-sm" name="nmgrp" id="nmgrp">
										<option value="">-- Pilih Group --</option>
										<?php foreach ($datagrp->result_array() as $datagrp) { ?>
											<option value="<?= $datagrp['grp'] ?>" <?php if ($this->session->userdata('grpvalidator') == $datagrp['grp']) {
																						echo "selected";
																					} ?>><?= $datagrp['grp'] ?></option>
										<?php } ?>
									</select>
								</div>
								<a href="#" class="btn btn-sm btn-success" id="caridata">Get Data</a>
							</div>
							<hr class="small">
							<div id="keterangan_tabel" style="text-align: center;" class="<?php if ($this->session->userdata('bagianvalidator') != '') {
																								echo "hilang";
																							} ?>">
								Pilih Bagian untuk Menampilkan Data
							</div>
							<div class="row <?php if ($this->session->userdata('bagianvalidator') == '') {
												echo "hilang";
											} ?>">
								<div class="col-sm-12">
									<div class="col-sm-8 font-kecil table-responsive">
										<div>
											<table class="table table-bordered table-striped table-hover nowrap tabelakses responsive datatableasli">
												<thead style="background-color: #D8EFE2;">
													<tr>
														<th class="text-center">No</th>
														<th class="text-center">Nama</th>
														<th class="text-center">Bagian</th>
														<th class="text-center">Validator</th>
														<th class="text-center">Releaser</th>
													</tr>
												</thead>
												<tbody>
													<?php $no = 0;
													foreach ($datakaryawan->result_array() as $data) : $no++; ?>
														<tr id="rekuser<?= $data['kritkar'] . $data['person_id'] ?>" rel="<?= $data['kritkar'] . $data['person_id'] ?>" class="<?php if ($no == 1) {
																																													echo "aktif";
																																												} ?>">
															<td style="padding: 3px 4px;"><?= $no ?></td>
															<td style="padding: 3px 4px;"><?= $data['noinduk'] . ' # ' . $data['nama'] ?></td>
															<td style="padding: 3px 4px;"><?= $data['bagian'] ?></td>
															<td style="padding: 3px 4px;" id="xnamavalid<?= $data['kritkar'] . $data['person_id'] ?>"><?= $data['namavalid'] ?></td>
															<td style="padding: 3px 4px;" id="xnamarilis<?= $data['kritkar'] . $data['person_id'] ?>"><?= $data['namarilis'] ?></td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
										<input type="text" id="idbagianx" class="hilang">
										<input type="text" id="idgrpx" class="hilang">
									</div>
									<div class="col-sm-4">
										<div class="form-horizontal">
											<div class="formakses font-kecil" style="border: 1px dashed #fc6e2d !important; padding: 5px;">
												<div class="col-sm-12 bg-green" style="text-align:center;margin-bottom:5px;color:white;">Data KARYAWAN</div>
												<table class="borderless">
													<tr>
														<td>Nama</td>
														<td>:</td>
														<td id="namkar" class="bold">

														</td>
													</tr>
													<tr>
														<td>Bagian</td>
														<td>:</td>
														<td id="bagkar">

														</td>
													</tr>
													<tr>
														<td>Jabatan</td>
														<td>:</td>
														<td id="jabkar">

														</td>
													</tr>
												</table>
											</div>
											<div class="formakses font-kecil" style="border: 1px dashed #fc6e2d !important; padding: 5px;">
												<div class="col-sm-12 bg-green" style="text-align:center;margin-bottom:5px;color:white;">Data Validator</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">No Induk</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="noindukvalid" name="noindukvalid">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Nama</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="namavalid" name="namavalid">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Jabatan</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="jabatanvalid" name="jabatanvalid">
													</div>
												</div>
												<div class="text-center" id="formtombol" style="margin-top: 10px;">
													<a href="" class="btn btn-xs btn-success btn-flat" id="addvalid" data-remote="false" data-toggle="modal" data-title="ADD Validator" data-target="#modalBox" title="ADD Validator"><i class="fa fa-plus"></i> Add</a>
													<a href="" class="btn btn-xs btn-info btn-flat" id="editvalid" data-remote="false" data-toggle="modal" data-title="EDIT Validator" data-target="#modalBox" title="ADD Validator"><i class="fa fa-check"></i> Edit</a>
													<a href="#" id="hapusvalid" class="btn btn-xs btn-danger btn-flat" data-href="" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus Data"><i class="fa fa-trash"></i> Delete</a>
												</div>
											</div>
										</div>
										<div class="form-horizontal">
											<div class="formakses font-kecil" style="border: 1px dashed #fc6e2d !important; padding: 5px;">
												<div class="col-sm-12 bg-green" style="text-align:center;margin-bottom:5px;color:white;">Data Releaser</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">No Induk</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="noindukrilis" name="noindukrilis">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Nama</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="namarilis" name="namarilis">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Jabatan</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="jabatanrilis" name="jabatanrilis">
													</div>
												</div>
												<div class="text-center" id="formtombol" style="margin-top: 10px;">
													<a href="" class="btn btn-xs btn-success btn-flat" id="addrilis" data-remote="false" data-toggle="modal" data-title="ADD Releaser" data-target="#modalBox" title="ADD Releaser"><i class="fa fa-plus"></i> Add</a>
													<a href="" class="btn btn-xs btn-info btn-flat" id="editrilis" data-remote="false" data-toggle="modal" data-title="EDIT Releaser" data-target="#modalBox" title="EDIT Releaser"><i class="fa fa-check"></i> Edit</a>
													<a href="#" id="hapusrilis" class="btn btn-xs btn-danger btn-flat" data-href="" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus Data"><i class="fa fa-trash"></i> Delete</a>
												</div>
											</div>
										</div>
										<div class="form-horizontal">
											<div class="formakses font-kecil" style="border: 1px dashed #fc6e2d !important; padding: 5px;">
												<div class="col-sm-12 bg-green" style="text-align:center;margin-bottom:5px;color:white;"></div>
												<div class="form-group">
													<label class="col-md-5 control-label" style="text-align: left;" for="inputDefault">Hanya Releaser</label>
													<input type="text" id="idkaryawan" value="" class="hilang">
													<div class="col-md-7">
														<input type="checkbox" id="spc" style="margin-top: 12px;">
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
	</div>