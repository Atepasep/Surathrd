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
								<ul class="timeline font-kecil">
									<?php $tl=''; $t1=0; foreach($dataada as $datalog): ?>
										<?php if($tl != $datalog['tanggal']){ ?>
											<?php if($tl != ''){ ?>
													</div>
												</div>
											</li>
											<?php } ?>
											<li class="time-label">
												<span class="bg-red">
													<?= tglpanjang($datalog['tanggal']) ?>
												</span>
											</li>
											<li>
												<i style="color: black !important;" class="fa fa-file-text-o bg-primary"></i>
													<div class="timeline-item">
														<div class="timeline-body">
										<?php } $tl = $datalog['tanggal']; $t1 = $datalog['approve']; ?>
										<?php 
											if($datalog['approve']<=2){
												echo '<i class="fa fa-check text-green"></i> <i class="fa fa-clock-o text-gray"></i> '.substr($datalog['tgl'],10,6).' <strong>Approve ';
											}else{
												echo '<i class="fa fa-times text-red"></i> <i class="fa fa-clock-o text-gray"></i> '.substr($datalog['tgl'],10,6).' <strong>Menolak ';
											}
											echo $datalog['jenis'].'</strong> '.$datalog['nama'].'<br>' 
										?>
									<?php endforeach; ?>
								</ul>
							</div>
					    </div>
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