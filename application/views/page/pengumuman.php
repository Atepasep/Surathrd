	<div id="ifn-main">
		<div class="main-page">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-dark-ifn">
					  <div class="panel-heading">
					    <h3 class="panel-title"><?= $judul ?>
							<div style="float: right; font-size: 12px; padding-top: 3px;">
								<a href="<?= base_url() ?>"><i class="fa fa-arrow-left text-red"></i> kembali</a>
							</div>
						</h3>
					  </div>
					  <div class="panel-body pan">
					    <div class="row">
							<div class="col-sm-12">
								<div class="col-sm-4">
									Daftar Pengumuman <?= $this->session->flashdata('tahsurat') ?>
									<hr class="small">
									<select class="form-control input-sm" name="tahsurat" id="tahsurat" >
										<?php for($x=date('Y')-2; $x <= date('Y'); $x++ ): ?>
											<option value="<?= $x ?>" <?php if($this->session->flashdata('tahsurat')==$x){ echo 'selected'; } ?>><?= $x ?></option>
										<?php endfor; ?>
									</select>
									<hr class="small">
									<ul id="lapdok" class="font-kecil" style="list-style: none; padding-left: 10px; font-size: 10px;">
										<li class="text-gray"><i class="fa fa-circle"></i><a class="<?php if($this->session->flashdata('nodok')=='x.pdf'){ echo 'text-red'; } ?>" id="nodok" rel="0" href="#"> HOME</a></li>
										<?php foreach($pengumuman->result_array() as $data): ?>
											<li class="<?= sudahbacapengumuman($data['id'])  ?>">
												<i class="fa fa-circle"></i> 
												<a class="<?php if($this->session->flashdata('nodok')==$data['nodok']){ echo 'text-red'; } ?>" id="nodok" rel=<?= $data['id'] ?> kode="<?= sudahbacapengumuman($data['id'])  ?>" href="#"><?= $data['nomor'].' - '.$data['judul'] ?></a>
												<?php if($data['revisi']==1): ?>
													<ul style="list-style: none; padding-left: 25px; font-size: 10px;">
												<?php foreach(getdokrevisi($data['id'])->result_array() as $revisi): ?>
													<li class="<?= sudahbacapengumuman($revisi['id'])  ?>">
														<i class="fa fa-circle"></i> 
														<a class="<?php if($this->session->flashdata('nodok')==$revisi['nodok']){ echo 'text-red'; } ?>" id="nodok" rel=<?= $revisi['id'] ?> kode="<?= sudahbacapengumuman($revisi['id'])  ?>" href="#"><?= $revisi['nomor'].' - '.$revisi['judul'] ?></a>
														<?php if($revisi['revisi']==1): ?>
															<ul style="list-style: none; padding-left: 20px; font-size: 10px;">
														<?php foreach(getdokrevisi($revisi['id'])->result_array() as $revisi2): ?>
															<li class="<?= sudahbacapengumuman($revisi2['id'])  ?>">
																<i class="fa fa-circle"></i> 
																<a class="<?php if($this->session->flashdata('nodok')==$revisi2['nodok']){ echo 'text-red'; } ?>" id="nodok" rel=<?= $revisi2['id'] ?> kode="<?= sudahbacapengumuman($revisi2['id'])  ?>" href="#"><?= $revisi2['nomor'].' - '.$revisi2['judul'] ?></a>
															</li>
														<?php endforeach; ?>
															</ul>
														<?php  endif; ?>
													</li>
												<?php endforeach; ?>
													</ul>
												<?php  endif; ?>
											</li>
										<?php endforeach; ?>
									</ul>
									<hr class="small">
								</div>
								<div class="col-sm-8">
									<div id="untukpdfx" style="text-align: center;"></div>
									<?php if($this->session->flashdata('nodok') != 'x.pdf'){ ?>
										<script>PDFObject.embed("<?= base_url()."assets/page/pdf/".$this->session->flashdata('nodok') ?>", "#untukpdfx");</script>
									<?php }else{ ?>
										<div class="infohalaman" style="line-height:30px; font-size: 25px;">Pilih Pengumuman yang akan kamu Lihat</div>	
									<?php } ?>
								</div>
							</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>