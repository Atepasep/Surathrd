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
									<?php $tg=''; $appr=0; $kata1=''; $kata2=''; foreach($dataada as $data): ?>	
										<?php if($tg != $data['tanggal']){ $appr=0; ?>
											<li class="time-label">
												<span class="bg-red">
													<?= tglpanjang($data['tanggal']) ?>
												</span>
											</li>
											<?php } ?>
											<?php 
												$logo = $data['approve'] <= 2 ? 'fa-check bg-green' : 'fa-times bg-red';
												$kete = $data['approve'] <= 2 ? 'Approve ' : 'Tolak ';
											?>
											<li>
												<i class="fa <?= $logo ?>"></i>
												<div class="timeline-item">
													<span class="time"><i class="fa fa-clock-o"></i> <?= substr($data['tgl'],10,6) ?></span>
													<!-- <h3 class="timeline-header">Approve</h3> -->
													<div class="timeline-body">
														<?= '<strong>'.$kete.$data['jenis'].'</strong> '.$data['nama'] ?>
													</div>
												</div>
											</li>
									<?php $tg = $data['tanggal']; ?>
									<?php  endforeach; ?>
								</ul>
							</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>