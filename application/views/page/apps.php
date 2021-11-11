		<div id="ifn-main" >
			<div class="font-kecil" style="margin-top: 10px;">
				<!-- <div class="col-sm-12"> -->
					<div class="col-sm-4">
						<div class="info-user">
							Selamat Datang,<br>
							<div style="font-weight: normal;">
								Login terakhir <?= tglhariini($this->session->userdata('lastlogin')); ?>
							</div>
							<div class="tasklist font-kecil <?php if($this->session->userdata('hakdep') == "'X'"){ echo 'hilang'; } ?>">
								<?php 
									$data0 =0;$data1=0;$data2=0;$data3=0;
									// print_r($getriwayat);
									// echo $this->session->userdata('hakdep');
								?>
								<table style="width: 100%;">
									<tr class="bg-aqua bold">
										<td colspan="4">Your Task List</td>
									</tr>
									<tr>
										<td class="text-yellow">CUTI</td>
										<td class="text-red">P/L/K</td>
										<td class="text-green">ABSEN</td>
										<td class="text-aqua">OT</td>
									</tr>
									<tr>
										<td><?= $gettask['cuti'] ?></td>
										<td><?= $gettask['izin'] ?></td>
										<td><?= $gettask['absen'] ?></td>
										<td><?= $data3 ?></td>
									</tr>
									<tr>
										<td class="bg-yellow"><a href="<?= base_url().'cuti/detcuti' ?>" style="color: black;">Lihat <i class="fa fa-arrow-circle-right"></i></a></td>
										<td class="bg-red"><a href="<?= base_url().'izin/detizin' ?>" style="color: white;">Lihat <i class="fa fa-arrow-circle-right"></i></a></td>
										<td class="bg-green"><a href="<?= base_url().'absen/detabsen' ?>" style="color: white;">Lihat <i class="fa fa-arrow-circle-right"></i></a></td>
										<td class="bg-aqua"><a href="" style="color: black;">Lihat <i class="fa fa-arrow-circle-right"></i></a></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-sm-8" id="halaman-profile">
						<div class="col-sm-12">
							<div id="foto-profile" class="col-sm-3 text-center">
								<img src="<?= base_url() ?>assets/images/noimageava.png">
							</div>
							<div id="ket-profile" class="col-sm-8">
								<table class="table borderless">
									<tr>
										<td colspan="3" class="bg-yellow" style="text-align: center;">Profile # <?= $this->session->userdata('id_jabatan') ?></td>
									</tr>
									<tr>
										<td style="width: 70px;">Nama</td>
										<td style="width: 10px;">:</td>
										<td style="font-weight: bold;"><?= $profileuser['nama'] ?></td>
									</tr>
									<tr>
										<td>No Induk</td>
										<td>:</td>
										<td><?= $profileuser['noinduk'] ?></td>
									</tr>
									<tr>
										<td>Bagian</td>
										<td>:</td>
										<td><?= $profileuser['bagian'] ?></td>
									</tr>
									<tr>
										<td>Jabatan</td>
										<td>:</td>
										<td><?= $profileuser['jabatan'] ?></td>
									</tr>
									<tr>
										<td>Tgl Lahir</td>
										<td>:</td>
										<td><?= tglmysql($profileuser['tglahirp']) ?></td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>:</td>
										<td><?= $profileuser['alamat'] ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				<!-- </div> -->
				<div class="col-sm-12" style="margin-top: 20px;">
					<table class="table table-bordered table-striped table-hover responsive nowrap">
						<tr>
							<th colspan="6" class="bg-green text-center">Riwayat Permohonan Surat</th>
						</tr>
						<?php if(sizeof($getriwayat)=='0'){ ?>
							<tr>
								<td colspan="6" class="text-center">Data kosong</td>
							</tr>
						<?php }else{$no=-1; foreach($getriwayat as $data){ $no++; ?>
							<tr>
								<td><?= $no+1 ?></td>
								<td class="bold"><?= $data['keterangan']; ?></td>
								<td>dibuat <?= tglhariini(date('d-m-Y', strtotime($data['dibuat']))); ?></td>
								<td><?= prosedursurat($data['approve']) ?></td>
									<?php 
										switch (substr($data['kunci'],0,4)) {
											case 'cuti':
												$repo = 'apps/cetakrep/';
												break;
											case 'izin':
												$repo = 'apps/cetakform/';
												break;
										}
									?>
									<td style="text-align: center;">
										<?php if($data['approve']<=0){ ?>
											<a href="#" data-href="<?= 'cuti/hapusdata/'.$data['kunci'] ?>" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus Data"><i class="fa fa-trash-o"></i></a>
										<?php }else{ ?>
											<a href="<?= base_url().$repo.$data['kunci'] ?>" class="text-black"><i class="fa fa-file-pdf-o" title="View PDF"></i></a>
										<?php } ?>
									</td>
								<td style="text-align: center;"><a href="<?= 'cuti/viewdata/'.$data['kunci'] ?>" data-remote="false" data-toggle="modal" data-title="View Data" data-target="#modalBox" title="View Data">detail <i class="fa fa-arrow-circle-right"></i></a></td>
							</tr>
						<?php }} ?>
					</table>
				</div>
			</div>
		</div>
	</div>
