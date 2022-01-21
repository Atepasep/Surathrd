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
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="text-align: left; padding-top: 5px;" for="inputDefault">Periode</label>
                                        <div class="col-md-8">
                                            <select class="form-control input-sm" name="periodekk" id="periodekk" name="periodekk" >
                                                <?php for($xe = date('Y')-2;$xe<=date('Y')+1;$xe++){ ?>
                                                <option value="<?= $xe ?>" <?php if($xe==$this->session->flashdata('periodekk')){ echo "selected";} ?>><?= $xe ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="text-align: left; padding-top: 5px;" for="inputDefault">No KK</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control input-sm" style="font-weight: bold;" id="nokk" name="nokk" value="<?php if($kk==null){echo ''; }else{ echo $kk['nokk']; } ?>">
                                            <a href="#" id="updatekk" class="btn btn-sm flat hilang"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr class="small">
                                        <a href="<?= base_url().'profile/addkeluarga' ?>" class="btn btn-xs btn-success flat" data-remote="false" data-toggle="modal" data-title="Add Anggota Keluarga" data-target="#modalBox" title="Add Anggota Keluarga"><i class="fa fa-plus"></i> Tambah data</a>
                                        <a href="#" class="btn btn-xs btn-warning flat text-black" style="float: right;" id="validasidata" data-href="<?= base_url().'profile/validasikeluarga' ?>" data-news="Yakin anda akan memvalidasi data ini ?, data tidak bisa di edit kembali." data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Validasi data"><i class="fa fa-save"></i> Validasi Data</a> 
                                    <hr class="small">
                                    <div class="table-responsive tabler">
                                    <table class="table table-bordered table-striped table-hover responsive nowrap datatable">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>L/P</th>
                                                <th>Tgl Lahir</th>
                                                <th>Pendidikan</th>
                                                <th>Pekerjaan</th>
                                                <th>Status</th>
                                                <th>Hubungan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=0; foreach($keluarga->result_array() as $datakeluarga): $no++; ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?php if($datakeluarga['noinduk']!=''){ echo '<i class="fa fa-check text-green"></i>  '; } ?><?= $datakeluarga['nama'] ?></td>
                                                    <td><?= $datakeluarga['jenkel'] ?></td>
                                                    <td><?= $datakeluarga['tmplahir'].', '.tglpanjang($datakeluarga['tgllahir']) ?></td>
                                                    <td><?= $datakeluarga['pendidikan'] ?></td>
                                                    <td><?= $datakeluarga['pekerjaan'] ?></td>
                                                    <td><?= $datakeluarga['status'] ?></td>
                                                    <td><?= $datakeluarga['hubungan'] ?></td>
                                                    <td>
                                                        <?php if($datakeluarga['valid']!=1){ ?>
                                                        <a href="<?= base_url().'profile/editkeluarga/'.$datakeluarga['id'] ?>" class="btn btn-xs btn-info flat" data-remote="false" data-toggle="modal" data-title="Edit Anggota Keluarga" data-target="#modalBox" title="Edit Anggota Keluarga">Edit</a>
                                                        <a href="#" class="btn btn-xs btn-danger flat" id="hapuskeluarga" data-href="<?= base_url().'profile/hapuskeluarga/'.$datakeluarga['id'] ?>" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus">Hapus</a> 
                                                        <?php } ?>
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
</div>