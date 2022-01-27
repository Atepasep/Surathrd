<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12 font-kecil">
			<div class="panel panel-dark-ifn">
			<div class="panel-body pan modalket">
				<div class="row" style="margin-top: 2px;">
					<div class="form-group" id="formtgldari">
						<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">No Handphone Baru</label>
						<div class="col-md-8">
							<input type="number" class="form-control input-sm " id="nohpbaru" name="nohpbaru" value="" style="text-transform: uppercase;">
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="text-center" style="margin-top: 20px;">
				<a href="#" class="btn btn-sm btn-success" id="ceknohp"><i class="fa fa-check"></i> Update</a>
				<a href="#" class="btn btn-sm btn-warning" data-dismiss="modal" id="tutupform"><i class="fa fa-times"></i> Tutup</a>
			</div>
		</div>
	</div>
</div>
<script>
	$("#ceknohp").click(function(){
		if($("#nohpbaru").val()==''){
			pesan('Isi data dengan lengkap');
			return false;
		}
		ubahidkey();
	})
	function ubahidkey(){
		var ax = $("#nohpbaru").val();
		$.ajax({
        dataType: 'json',
        type : "POST",
        url : "<?= base_url().'Profile/updatenohp' ?>",
        data : {idkey : ax },
        success : function(data){
              if(data.length > 0){
				pesan('Berhasil Simpan data','info');
				$("#nohp").val(ax);
				$("#tutupform").click();
              }
        }
      })   
	}
</script>