<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12 font-kecil">
			<div class="panel panel-dark-ifn">
				<div class="panel-body pan modalket">
					<?php if($getdata['approve']!=0){ ?>
						<div class="<?php if($getdata['approve']==3){ echo 'pitaketx'; }else{ echo 'pitaket'; } ?>"><span><?php if($getdata['approve']==3){ echo 'Ditolak'; }elseif($getdata['approve']==1){ echo 'On Progress'; }else{ echo 'Done'; } ?></span></div>
					<?php } ?>
					<?php if($mode=='cuti'){ ?>
						<table class="table borderless">
							<tr>
								<td style="width: 20%;">Jenis</td>
								<td style="width: 4%;">:</td>
								<td><?= $getdata['keterangan'] ?></td>
							</tr>
							<tr>
								<td>Tgl</td>
								<td>:</td>
								<td><?= tglmysql($getdata['dari']).' s/d '.tglmysql($getdata['sampai']) ?></td>
							</tr>
							<tr>
								<td>Ambil Cuti</td>
								<td>:</td>
								<td><?php if($getdata['ambil']==1){ echo "Diambil Cuti"; }else{ echo "Tidak Diambil Cuti"; } ?></td>
							</tr>
							<?php if($getdata['jncuti']!= 'CH' || $getdata['jncuti']!= 'IK'){ ?>
								<tr>
									<td>Masa Kerja</td>
									<td>:</td>
									<td><?= $getdata['masakerja'] ?></td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td>:</td>
									<td><?= $getdata['alasan'] ?></td>
								</tr>
								<?php if($getdata['jncuti']=='IK'){ ?>
									<tr>
										<td>Tanggal Izin</td>
										<td>:</td>
										<td><?= tglmysql($getdata['tgl_khusus']) ?></td>
									</tr>
									<tr>
										<td>Hari</td>
										<td>:</td>
										<td><?=  $getdata['hari'] ?></td>
									</tr>
									<tr>
										<td>Jam</td>
										<td>:</td>
										<td><?= $getdata['jam'] ?></td>
									</tr>
									<tr>
										<td>Tempat</td>
										<td>:</td>
										<td><?= $getdata['tempat'] ?></td>
									</tr>
								<?php } ?>
							<?php } ?>
							<?php if($getdata['approve']!=0){ ?>
								<tr>
									<td><?php if($getdata['approve']==3){ echo "Ditolak"; }else{ echo "Approve"; } ?></td>
									<td>:</td>
									<td><?= $getdata['nama_setuju'] ?><br><?= date('d-m-Y', strtotime($getdata['disetujui_tgl'])) ?></td>
								</tr>
							<?php } ?>
							<?php if($getdata['diterima']!=''){ ?>
								<tr>
									<td>Submit</td>
									<td>:</td>
									<td><?= $getdata['nama_terima'] ?><br><?=date('d-m-Y', strtotime($getdata['diterima_tgl'])) ?></td>
								</tr>
							<?php } ?>
							<?php if($getdata['approve']==3){ ?>
								<tr>
									<td>Alasan </td>
									<td>:</td>
									<td><?= $getdata['alasan_tolak'] ?></td>
								</tr>
							<?php } ?>
						</table>
					<?php }elseif($mode=='izin'){ ?>
						<table class="table borderless">
							<tr>
								<td style="width: 20%;">Jenis</td>
								<td style="width: 4%;">:</td>
								<td><?= $getdata['keterangan'] ?></td>
							</tr>
							<tr>
								<td>Tanggal</td>
								<td>:</td>
								<td><?= tglhariini(tglmysql($getdata['tgl_izin'])) ?></td>
							</tr>
							<tr>
								<td><?php if($getdata['jnizin']=='IP'){ echo 'Pulang Pkl';}elseif($getdata['jnizin']=='IT'){ echo 'Masuk Pkl';}else{ echo 'Keluar Pkl'; } ?></td>
								<td>:</td>
								<td><?= $getdata['masuk'].$getdata['pulang'].$getdata['keluar'].$getdata['kembali'].' WIB' ?></td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>:</td>
								<td><?= $getdata['alasan'] ?></td>
							</tr>
							<?php if($getdata['approve']!=0){ ?>
								<tr>
									<td><?php if($getdata['approve']==3){ echo "Ditolak"; }else{ echo "Approve"; } ?></td>
									<td>:</td>
									<td><?= $getdata['nama_setuju'] ?><br><?= date('d-m-Y', strtotime($getdata['disetujui_tgl'])) ?></td>
								</tr>
							<?php } ?>
							<?php if($getdata['approve']==3){ ?>
								<tr>
									<td>Alasan Tolak</td>
									<td>:</td>
									<td><?= $getdata['alasan_tolak'] ?></td>
								</tr>
							<?php } ?>
						</table> 
					<?php }elseif($mode=='absen'){ ?>
						<table class="table borderless">
							<tr>
								<td style="width: 20%;">Jenis Absen</td>
								<td style="width: 4%;">:</td>
								<td><?= $getdata['keterangan'] ?></td>
							</tr>
							<tr>
								<td>Tgl</td>
								<td>:</td>
								<td><?= tglmysql($getdata['dari']).' s/d '.tglmysql($getdata['sampai']) ?></td>
							</tr>
							<tr>
								<td>Keterangan <?= $getdata['keterangan'] ?> </td>
								<td>:</td>
								<td><?= $getdata['ket'] ?></td>
							</tr>
							<?php if($getdata['approve']!=0){ ?>
								<tr>
									<td><?php if($getdata['approve']==3){ echo "Ditolak"; }else{ echo "Approve"; } ?></td>
									<td>:</td>
									<td><?= $getdata['nama_setuju'] ?><br><?= date('d-m-Y', strtotime($getdata['disetujui_tgl'])) ?></td>
								</tr>
							<?php } ?>
							<?php if($getdata['approve']==3){ ?>
								<tr>
									<td>Alasan Tolak</td>
									<td>:</td>
									<td><?= $getdata['alasan_tolak'] ?></td>
								</tr>
							<?php } ?>
						</table>
					<?php } ?>
			</div>
			<div class="text-center" style="margin-top: 20px;">
					<a href="#" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</a>
			</div>
		</div>
	</div>
</div>