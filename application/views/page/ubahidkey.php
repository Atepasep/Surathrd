<div class="inner-wrapp">
	<div class="row">
		<div class="col-sm-12 font-kecil">
			<div class="panel panel-dark-ifn">
			<div class="panel-body pan modalket">
				<div class="row">
					<div class="form-group" id="formtgldari">
						<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">ID Key Lama</label>
						<div class="col-md-8">
							<input type="text" class="form-control input-sm " id="idkey" name="idkey" value="" style="text-transform: uppercase;">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top: 2px;">
					<div class="form-group" id="formtgldari">
						<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">ID Key Baru</label>
						<div class="col-md-8">
							<input type="text" class="form-control input-sm " id="idkeybaru" name="idkeybaru" value="" style="text-transform: uppercase;">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top: 2px;">
					<div class="form-group" id="formtgldari">
						<label class="col-md-4 control-label" style="text-align: left;" for="inputDefault">Konfirmasi ID Key</label>
						<div class="col-md-8">
							<input type="text" class="form-control input-sm tglpilih" id="konfidkey" name="konfidkey" value="" style="text-transform: uppercase;">
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="text-center" style="margin-top: 20px;">
				<a href="#" class="btn btn-sm btn-success" id="cekidkey"><i class="fa fa-check"></i> Update</a>
				<a href="#" class="btn btn-sm btn-warning" data-dismiss="modal" id="tutupform"><i class="fa fa-times"></i> Tutup</a>
			</div>
		</div>
	</div>
</div>
<script>
	$("#cekidkey").click(function(){
		if($("#idkey").val()=='' || $("#idkeylama").val()=='' || $("#konfidkey").val()=='' ){
			pesan('Isi data dengan lengkap');
			return false;
		}
		if($("#idkeybaru").val() != $("#konfidkey").val()){
			pesan('ID Key baru dan konfirmasi tidak sama');
			return false;
		}
		var kod = $("#idkey").val();
		var idu = "<?= $this->session->userdata('iduser') ?>";
		if(kod.toUpperCase() != idu){
			pesan('ID key lama tidak sesuai');
			return false;
		}
		cekidkey();
	})
	function ubahidkey(){
		var ax = $("#idkeybaru").val();
		var ay = $("#konfidkey").val();
		$.ajax({
        dataType: 'json',
        type : "POST",
        url : "<?= base_url().'Profile/updateidkey' ?>",
        data : {idkey : ax },
        success : function(data){
              if(data.length > 0){
				pesan('Berhasil Simpan data');
				$("#tutupform").click();
              }
        }
      })   
	}
	function cekidkey(){
		var ax = $("#idkeybaru").val();
		var ay = $("#konfidkey").val();
		$.ajax({
        dataType: 'json',
        type : "POST",
        url : "<?= base_url().'Profile/cekidkey' ?>",
        data : {idkey : ax },
        success : function(data){
              if(data.length > 0){
				pesan('ID Key baru sudah digunakan, ganti ID Key baru');
              }else{
				  ubahidkey();
			  }
        }
      })
	}
</script>