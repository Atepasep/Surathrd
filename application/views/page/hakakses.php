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
									<table class="table table-bordered table-striped table-hover nowrap tabelakses responsive datatable5">
										<thead style="background-color: #D8EFE2;">
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">No Induk</th>
											<th class="text-center">Nama</th>
										</tr>
										</thead>
										<tbody>
										<?php $no=0; foreach($datauser as $data): $no++; ?>
											<tr id="rekuser<?= $data['idkey'] ?>" rel="<?= $data['idkey'] ?>" class="<?php if($no==1){ echo "aktif"; } ?>">
												<td style="padding: 3px 4px;"><?= $no ?></td>
												<td style="padding: 3px 4px;"><?= $data['noinduk'] ?></td>
												<td style="padding: 3px 4px;"><?= $data['nama'] ?></td>
											</tr>
										<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<div class="col-sm-6">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">No Induk</label>
											<div class="col-md-8">
												<input type="text" class="form-control input-sm" id="noinduk" name="noinduk">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Nama</label>
											<div class="col-md-8">
												<input type="text" class="form-control input-sm" id="namauser" name="nama">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Jabatan</label>
											<div class="col-md-8">
												<input type="text" class="form-control input-sm" id="jabatan" name="jabatan">
											</div>
										</div>
										<div class="formakses font-kecil" style="border: 1px dashed #fc6e2d !important; padding: 5px;">
											<div class="text-center" style="border-bottom: 1px solid black; margin: 5px;">Daftar Departemen</div>
											<div class="row">
												<?php $num = $bagian->num_rows(); $xnum = floor($num/2)+1; $no=0; foreach($bagian->result_array() as $databagian): $no++; ?>
													<?php if($no==$xnum){ ?>
														</div>
													<?php } ?>
													<?php if($no==1 || $no==$xnum){ ?>
														<div class="col-sm-6">
													<?php } ?>
													<a href="#" style="text-decoration: none;" class="text-black" id="cekbagian<?= $databagian['id'] ?>" rel="<?= $databagian['id'] ?>" onclick="Editakses(<?= $databagian['id'] ?>)">
														<i class="fa text-yellow "></i> <?= ucwords($databagian['bagian']) ?> <br>
													</a>
													<?php if($no==$num){ ?>
														</div>
													<?php } ?>
												<?php endforeach; ?>
											</div>
										</div>
										<div style="text-align: right; font-size:10px;">
											<small>Klik pada Nama Bagian untuk Hak Akses, Warna merah <i class="fa fa-circle text-red"></i> Aktif</small>
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