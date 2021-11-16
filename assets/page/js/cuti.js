$(document).ready(function(){
	//setinput('');
	$("#jnsurat").change();
	$("#jncuti").change();

	$('#jamik').on('change click keyup input paste',(function (event) {
		$(this).val(function (index, value) {
			return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{2})+(?!\d))/g, ":");
		});
	}));
})
$("#jamik").on('blur',function(){
	var kata = $(this).val();
	if(kata != ''){
		var panjang = kata.length;
		if(panjang<5){
			if(panjang>2){
				kata = '0'+kata;
			}
			kata = kata.replace(':','');
			for(dari=panjang;dari <= 4;dari++){
				kata += '0';
			}
		}
		var pisah1 = kata.substr(0,2);
		var pisah2 = kata.substr(2,2);
		if(!kata.includes(':')){
			$(this).val(pisah1+':'+pisah2);
		}
	}
})
$("#tgldari").on('change textInput Input', function(){
	cekhari($(this).val(),$("#tglsampai").val());
})
$("#tglsampai").on('change texInput Input',function(){
	$("#tgldari").change();
})
$("#jnsurat").change(function(){
	var hh = $(this).val();
	setinput(hh);
	$("#jnsuratx").val(hh);
})
$("#jncuti").on('change',function(){
	if($(this).val()==''){
		$("#formtombol").addClass('hilang');
	}else{
		$("#formtombol").removeClass('hilang');
		if($(this).val()=='2'){
			$("#alasan").val('Diuangkan');
		}
	}
})
$("#batalcuti").click(function(){
	var rel = $("#kirimcuti").attr('rel');
	if(rel=='Update'){
		window.location.href = "../../";
	}else{
		kosongkanform();
	}
})
$("#kirimcuti").click(function(){
	var jncuti = $("#jncuti").val();
	if(jncuti=='2'){
		if($("#masakerja").val()==''){
			pesan('Isi masa kerja tahun ke berapa ?');
		}else{
			document.formcuti.submit();
		}
	}else{
		var jnsurat = $("#jnsuratx").val();
		if(jnsurat=='CH'){
			if($("#dari").val()=='' || $("#sampai").val()==''){
				pesan('Isi data demgan lengkap');
			}else{
				document.formcuti.submit();
			}
		}else{
			if(jnsurat!='IK'){
				if($("#dari").val()=='' || $("#sampai").val()=='' || $("#masakerja").val()=='' || $("#alasan").val()==''){
					pesan('Isi data demgan lengkap');
				}else{
					document.formcuti.submit();
				}
			}else{
				if($("#dari").val()=='' || $("#sampai").val()=='' || $("#masakerja").val()=='' || $("#alasan").val()=='' || $("#tglik").val()=='' || $("#hariik").val()=='' || $("#jamik").val()=='' || $("#tempatik").val()==''){
					pesan('Isi data dengan lengkap');
				}else{
					document.formcuti.submit();
				}
			}
		}
	}
})
function setinput(jnsurat){
	// kosongkanform();
	$("#setjeniscuti").addClass('hilang');
	$("#notsetjeniscuti").addClass('hilang');
	$("#formtgldari").addClass('hilang');
	$("#formtglsampai").addClass('hilang');
	$("#formmasakerja").addClass('hilang');
	$("#formalasan").addClass('hilang');
	$("#formtglik").addClass('hilang');
	$("#formhariik").addClass('hilang');
	$("#formjamik").addClass('hilang');
	$("#formtempatik").addClass('hilang');
	$("#formtombol").addClass('hilang');
	switch(jnsurat){
		case 'C' :
			$("#setjeniscuti").removeClass('hilang');
			$("#formtgldari").removeClass('hilang');
			$("#formtglsampai").removeClass('hilang');
			$("#formmasakerja").removeClass('hilang');
			$("#formalasan").removeClass('hilang');
			$("#jnsuratx").val('CT');
			break;
		case 'CP' :
			$("#setjeniscuti").removeClass('hilang');
			$("#formtgldari").removeClass('hilang');
			$("#formtglsampai").removeClass('hilang');
			$("#formmasakerja").removeClass('hilang');
			$("#formalasan").removeClass('hilang');
			break;
		case 'CH' :
			$("#setjeniscuti").removeClass('hilang');
			$("#formtgldari").removeClass('hilang');
			$("#formtglsampai").removeClass('hilang');
			break;
		case 'IK':
			$("#setjeniscuti").removeClass('hilang');
			$("#formtgldari").removeClass('hilang');
			$("#formtglsampai").removeClass('hilang');
			$("#formmasakerja").removeClass('hilang');
			$("#formalasan").removeClass('hilang');
			$("#formtglik").removeClass('hilang');
			$("#formhariik").removeClass('hilang');
			$("#formjamik").removeClass('hilang');
			$("#formtempatik").removeClass('hilang');
			break;
		default :
			$("#notsetjeniscuti").removeClass('hilang');
	}
}
function kosongkanform(){
	$("#setjeniscuti").val('');
	$("#notsetjeniscuti").val('');
	$("#jncuti").val('');
	$("#tgldari").val('');
	$("#tglsampai").val('');
	$("#masakerja").val('');
	$("#alasan").val('');
	$("#tglik").val('');
	$("#hariik").val('');
	$("#jamik").val('');
	$("#tempatik").val('');
	$("#selama").val('');
}
function cekhari(tglawal,tglakhir){
	if(tglawal=='' || tglakhir==''){
		$("#selama").val('');
	}else{
		var satuhari = 24*60*60*1000; // hours*minutes*seconds*milliseconds
		var pisah1 = tglawal.split('-');
		var pisah2 = tglakhir.split('-');
		var tgl1 = new Date(pisah1[2],pisah1[1],pisah1[0]);
		var tgl2 = new Date(pisah2[2],pisah2[1],pisah2[0]);
		var diffDays = Math.round(Math.round((tgl1.getTime() - tgl2.getTime()) / (satuhari))-1);
		if(diffDays > 0){
			alert('Tgl dari harus lebih kecil dari tgl sampai');
			$("#tgldari").val('');
			$("#tglsampai").val('');
			$("#selama").val('');
		}else{
			var hasil = diffDays*-1;
			$("#selama").val(hasil+' Hari');
		}
	}
}