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
							<div class="col-sm-12 font-kecil">
								<table class="table table-bordered table-striped table-hover nowrap responsive">
									<thead style="background-color: #D8EFE2;">
									<tr>
										<th class="text-center">Tgl</th>
										<th class="text-center">Jumlah Orang</th>
										<th class="text-center">Detail</th>
									</tr>
									</thead>
									<tbody>			
										<?php 
											$date=date('Y-m-d');
											for($x=0;$x<=7;$x++){
										?>
											<tr>
												<td><?= tglpanjang(date('Y-m-d', strtotime($date. ' + '.$x.' days'))) ?></td>
												<td><?= carikaryabsen(date('Y-m-d', strtotime($date. ' + '.$x.' days'))) ?></td>
												<td><a href="<?= base_url().'Apps/viewkaryabsen/'.date('Y-m-d', strtotime($date. ' + '.$x.' days')) ?>" data-remote="false" data-toggle="modal" data-title="View Data" data-target="#modalBox" title="View Data">detail <i class="fa fa-arrow-circle-right"></i></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
								<hr class="small">
								<div style="text-align: center;">
									<a href="<?= base_url() ?>" class="btn btn-sm btn-success btn-flat" ><i class="fa fa-arrow-left"></i> Kembali</a>
								</div>
							</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>