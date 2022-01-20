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
                                            <select class="form-control input-sm" name="jncuti" id="jncuti" name="jncuti" >
                                                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                                <option value="<?= date('Y')+1 ?>"><?= date('Y')+1 ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="text-align: left; padding-top: 5px;" for="inputDefault">No KK</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control input-sm" id="nokk" name="nokk" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr class="small">
                                        <a href="#" class="btn btn-sm btn-success flat"><i class="fa fa-plus"></i> Tambah data</a>
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
                                                <th>Status</th>
                                                <th>Hubungan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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