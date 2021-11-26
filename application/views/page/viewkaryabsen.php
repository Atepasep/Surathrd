<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-dark-ifn">
			<div class="panel-body pan">
				<table class="table borderless font-kecil">
					<tr>
						<td style="width: 20%;">Bagian</td>
						<td style="width: 4%;">:</td>
						<td><?= $this->session->userdata('bagian') ?></td>
					</tr>
					<tr>
						<td>Tgl</td>
						<td>:</td>
						<td><?= tglpanjang($tgl) ?></td>
					</tr>
				</table>
				<div class="row">
					<div class="col-sm-12 font-kecil">
						<table class="table table-bordered table-striped table-hover nowrap responsive">
							<thead style="background-color: #D8EFE2;">
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Noinduk</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Group</th>
								<th class="text-center">Cuti / Absen</th>
							</tr>
							</thead>
							<tbody>	
								<?php $jml = $datacuti->num_rows()+$dataabsen->num_rows(); if( $jml == '0'){ ?>
								<tr>
									<td colspan="5" style="text-align: center;">Data kosong</td>
								</tr>
								<?php 
								}else{
									$no = 0;
									if($dataabsen->num_rows() > 0){
										foreach($dataabsen->result_array() as $databs):
											$no++;
								?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $databs['noinduk'] ?></td>
										<td><?= $databs['nama'] ?></td>
										<td><?= $databs['grp'] ?></td>
										<td><?= $databs['keterangan'] ?></td>
									</tr>
								<?php endforeach; } 
									if($datacuti->num_rows() > 0){
										foreach($datacuti->result_array() as $datcut):
											$no++;
								?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $datcut['noinduk'] ?></td>
										<td><?= $datcut['nama'] ?></td>
										<td><?= $datcut['grp'] ?></td>
										<td><?= $datcut['keterangan'] ?></td>
									</tr>
								<?php endforeach; } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="text-center" style="margin-top: 20px;">
				<a href="#" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Keluar</a>
			</div>
		</div>
	</div>
</div>
