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
						<div class="col-sm-6">
							<a class="btn btn-xs btn-success" id="kembali" href="<?= base_url() ?>" ><i class="fa fa-arrow-left"></i> Kembali</a>
						</div> 
						<div class="col-sm-6 hilang" style="text-align: right;">
							<a href="#" class="btn btn-xs btn-danger" id="isisemuaapprove" data-href="<?= base_url().'absen/approvesemuadata' ?>" data-news="Yakin anda akan menyetujui semua data ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Approve Data"><i class="fa fa-check"></i> Approve Semua</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr class="small">
							<div class="table-responsive tabler">
								<table class="table table-bordered table-striped table-hover responsive nowrap datatable">
									<thead class="bg-primary">
										<tr>
											<th>No</th>
											<th>Tgl</th>
											<th>No induk / Nama</th>
											<th>Absen</th>
											<th>Tgl Absen</th>
											<th>Keterangan</th>
											<th>Dok</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=0; foreach($dataabsen as $data): $no++; ?>
											<tr>
												<td><?= $no ?></td>
												<td><?= tglhariini(date('d-m-Y', strtotime($data['dibuat']))); ?></td>
												<td><?= $data['noinduk'].'/'.$data['nama'] ?></td>
												<td><?= $data['keterangan'] ?></td>
												<td><?= tglmysql($data['dari']).' s/d '.tglmysql($data['sampai']) ?><strong class="text-green"><?=' ('.selisihhari($data['dari'],$data['sampai']).')' ?></strong></td>
												<td><?= $data['ket'] ?></td>
												<td><?php 
													if($data['dok']!=''){ ?>
														<a href="<?= base_url().'absen/viewfoto/'.$data['id'] ?>" class="btn btn-xs btn-danger btn-flat" data-remote="false" data-toggle="modal" data-title="View Dokumen" data-target="#modalBox" title="View Data" ><i class="fa fa-picture-o"></i> View</a>
													<?php }else{
														echo 'Kosong';
													}
												?></td>
												<td>
													<a href="<?= base_url().'absen/isiapproveabsen/'.$data['id'] ?>" class="btn btn-xs btn-success btn-flat" id="apprcuti" >Approve</a>
													<a href="<?= base_url().'absen/tolakabsen/'.$data['id'] ?>" class="btn btn-xs btn-danger btn-flat" data-remote="false" data-toggle="modal" data-title="View Data" data-target="#modalBox" title="View Data" ><i class="fa fa-times"></i> Tolak</a>
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
