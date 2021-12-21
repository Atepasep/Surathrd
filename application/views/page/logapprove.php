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
									<?php $tl=''; $t1=0; $departemen = array("SPINNING","NETTING","FINISHING","RING"); 
									foreach($dataada as $datalog):  
										if(!in_array($this->session->userdata('bagian'),$departemen)){
											$per = $datalog['tanggal'];
											$rep = $datalog['approve'];
											$gll = substr($datalog['tgl'],10,6);
										}else{
											if($this->session->userdata('id_jabatan') > 4){
												$per = $datalog['tanggal'];
												$rep = $datalog['approve'];
												$gll = substr($datalog['tgl'],10,6);
											}else{
												// $per = $datalog['tglcek'];
												$per = $datalog['tanggal'];
												$rep = $datalog['appcol'];
												// $gll = substr($datalog['jamcek'],0,5);
												$gll = substr($datalog['tgl'],10,6);
											}
										}
									?>
										<?php if($tl != $per){ ?>
											<?php if($tl != ''){ ?>
													</div>
												</div>
											</li>
											<?php } ?>
											<li class="time-label">
												<span class="bg-red">
													<?= tglpanjang($per); ?>
												</span>
											</li>
											<li>
												<i style="color: black !important;" class="fa fa-file-text-o bg-primary"></i>
													<div class="timeline-item">
														<div class="timeline-body">
										<?php } $tl = $per; $t1 = $rep; ?>
										<?php 
											if(!in_array($this->session->userdata('bagian'),$departemen)){
												if($datalog['approve']<=2){
													echo '<i class="fa fa-check text-green"></i> <i class="fa fa-clock-o text-gray"></i> '.$gll.' <strong>Approve ';
												}else{
													echo '<i class="fa fa-times text-red"></i> <i class="fa fa-clock-o text-gray"></i> '.$gll.' <strong>Menolak ';
												}
											}else{
												$kolom = $this->session->userdata('id_jabatan') > 4 ? $datalog['approve'] : $datalog['appcol'];
												$jam = $this->session->userdata('id_jabatan') > 4 ? substr($datalog['tgl'],10,6) : $gll;
												if($kolom<=2){
													echo '<i class="fa fa-check text-green"></i> <i class="fa fa-clock-o text-gray"></i> '.$jam.' <strong>Approve ';
												}else{
													echo '<i class="fa fa-times text-red"></i> <i class="fa fa-clock-o text-gray"></i> '.$jam.' <strong>Menolak ';
												}
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