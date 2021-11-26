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
								<div class="font-kecil">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-horizontal">
												<div class="form-group font-kecil" id="formtgldari">
													<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Tanggal</label>
													<div class="col-md-5">
														<input type="text" class="form-control font-kecil input-sm tglpilih" id="tglabsen" name="tglabsen" value="<?= $this->session->flashdata('tglabsen') ?>">
													</div>
													<div class="col-md-3">
														
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-4"></div>
										<div class="col-sm-4" style="text-align: right; padding-top:6px;">
											<a href="<?= base_url().'busabsen/addabsenbus' ?>" class="btn btn-xs btn-success btn-flat" id="tambahabsenbus" data-remote="false" data-toggle="modal" data-title="Add Absen Bus Jemputan" data-target="#modalBox" title="Add Absen"><i class="fa fa-plus"></i> Tambah Absen Bus</a>
										</div>
									</div>
								</div>	
								<hr class="small">	
								<div class="col-sm-12 font-kecil table-responsive"> 
									<table class="table table-bordered table-striped table-hover nowrap responsive">
										<thead style="background-color: #D8EFE2;">
										<tr>
											
											<th class="text-center">Nama Jemputan</th>
											<th class="text-center">Shift</th>
											<th class="text-center">Masuk</th>
											<th class="text-center">Pulang</th>
											<th class="text-center">Aksi</th>
										</tr>
										</thead>
										<tbody>
											<?php if($dataabsen->num_rows() == 0){ ?>
												<tr>
													<td colspan="6" style="text-align: center;" class="font-kecil">Tidak ada Data</td>
												</tr>
											<?php }else{ ?>
											<?php $no=0; $nmpo=''; foreach($dataabsen->result_array() as $data): $no++; ?>
												<tr>
													
													<?php if($nmpo != $data['nmpo']){ ?>
														<td style="padding: 3px 4px; font-weight: bold;"><?= $data['nmpo'] ?></td>
													<?php }else{ ?>
														<td style="padding: 3px 4px;"></td>
													<?php } $nmpo=$data['nmpo']; ?>
													<td style="padding: 3px 4px;"><?= $data['namashift'] ?></td>
													<td style="padding: 3px 4px; font-size : 13px; text-align: center;"><?php if($data['masuk']==1){ echo '<i class="fa fa-check text-success"></i>'; }else{ echo '<i class="fa fa-times text-red"></i>'; } ?></td>
													<td style="padding: 3px 4px; font-size : 13px; text-align: center;"><?php if($data['pulang']==1){ echo '<i class="fa fa-check text-success"></i>'; }else{ echo '<i class="fa fa-times text-red"></i>'; } ?></td>
													<td style="padding: 3px 4px; text-align: center;">
														<?php if($data['loc']!=1){ ?>
															<a href="<?= base_url().'busabsen/editabsen/'.$data['id'] ?>" data-remote="false" data-toggle="modal" data-title="Edit Absen Bus Jemputan" data-target="#modalBox" title="Edit Absen" style="color: green !important;" >
																<i class="fa fa-pencil"></i> edit
															</a>
														<?php } ?>
													</td>
												</tr>
											<?php endforeach; } ?>
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