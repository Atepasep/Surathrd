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
									<div class="col-sm-6 font-kecil table-responsive">
										<div style="font-size: 14px;"><input type="checkbox" id="cekspv" <?php if ($this->session->userdata('modespv') == 1) {
																												echo "checked";
																											} ?>> Supervisor</div>
										<table class="table table-bordered table-striped table-hover nowrap tabelakses responsive datatable5">
											<thead style="background-color: #D8EFE2;">
												<tr>
													<th class="text-center">No <?= $this->session->userdata('modespv') ?></th>
													<th class="text-center">Bagian</th>
													<th class="text-center">Group</th>
												</tr>
											</thead>
											<tbody>
												<?php $no = 0;
												foreach ($databag->result_array() as $data) : $no++; ?>
													<tr id="rekuser<?= $data['id'] ?>" rel="<?= $data['id'] ?>" rel2="<?= $data['id_bagian'] ?>" rel3="<?= $data['id_grp'] ?>" class="<?php if ($no == 1) {
																																															echo "aktif";
																																														} ?>">
														<td style="padding: 3px 4px;"><?= $no ?></td>
														<td style="padding: 3px 4px;"><?= $data['bagian'] ?></td>
														<td style="padding: 3px 4px;"><?= $data['nama_group'] ?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<input type="text" id="idbagianx" class="hilang">
										<input type="text" id="idgrpx" class="hilang">
									</div>
									<div class="col-sm-6">
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Validasi Ke</label>
												<div class="col-md-8">
													<select class="form-control input-sm font-kecil" name="xvalid" id="xvalid" name="xvalid">
														<option value="1">Approve</option>
														<option value="2">Release</option>
													</select>
												</div>
											</div>
											<div class="formakses font-kecil" style="border: 1px dashed #fc6e2d !important; padding: 5px;">
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">No Induk</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="noinduk" name="noinduk">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Nama</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="nama" name="nama">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Jabatan</label>
													<div class="col-md-8">
														<input type="text" class="form-control input-sm" id="Jabatan" name="Jabatan">
													</div>
												</div>
												<div class="text-center" id="formtombol" style="margin-top: 10px;">
													<a class="btn btn-xs btn-success btn-flat" id="addvalid" rel="" data-remote="false" data-toggle="modal" data-title="View Data" data-target="#modalBox" title="View Data"><i class="fa fa-plus"></i> Add Validator</a>
													<a class="btn btn-xs btn-info btn-flat" id="editvalid" rel=""><i class="fa fa-check"></i> Edit Validator</a>
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