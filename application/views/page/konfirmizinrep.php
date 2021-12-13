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
													<label class="col-md-2 control-label" style="text-align: left;" for="inputDefault">Tanggal</label>
													<div class="col-md-7">
														<input type="text" class="form-control font-kecil input-sm tglpilih" id="tglizin" name="tglizin" value="<?= $this->session->flashdata('tglizin') ?>">
														
													</div>
													<div class="col-md-3" style="padding-top: 3px; font-size: 16px; font-style: bolder;">
														<?= namahari(tglmysql($this->session->flashdata('tglizin'))) ?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<input type="text" id="urltujuan" value="<?= $urltujuan ?>" class="hilang">
										</div>
										<div class="col-sm-4" style="text-align: right; padding-top:6px;">
										</div>
									</div>
								</div>	
								<hr class="small">		
								<div class="col-sm-12 font-kecil table-responsive"> 
									<table class="table table-bordered table-striped table-hover nowrap responsive datatable">
										<thead class="bg-primary">
										<tr>
											
											<th class="text-center">No </th>
											<th class="text-center">Nama</th>
											<th class="text-center">Jenis Izin</th>
											<th class="text-center">Status</th>
											<th class="text-center">Keterangan</th>
										</tr>
										</thead>
										<tbody>
											<?php $no=0; foreach($datakonfirm->result_array() as $data): $no++; ?>
												<tr>
													<td><?= $no ?></td>
													<td><?= $data['noinduk'].'/'.$data['nama_karyawan'].'( '.trim($data['xbagian']).' )' ?></td>
													<td><?= '<strong>'.$data['keterangan'].'</strong> Pkl : '.$data['pulang'].$data['keluar'] ?></td>
													<td><?= 'Cek oleh : '.$data['nama_satpam'] ?></td>
													<td>
														<?php if($data['jnizin']=='IE'){ echo 'Kembali Pkl : '.$data['kembali']; }?>
													</td>
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