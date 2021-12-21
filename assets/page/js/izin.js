$(document).ready(function(){
	//setinput('');
	$("#jnizin").change();
})
$('#masuk').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{2})+(?!\d))/g, ":");
    });
}));
$('#pulang').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{2})+(?!\d))/g, ":");
    });
}));
$('#keluar').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{2})+(?!\d))/g, ":");
    });
}));
$('#kembali').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{2})+(?!\d))/g, ":");
    });
}));
$("#masuk").on('blur',function(){
	var kata = $(this).val();
	if(kata.substr(0,2)>24){
		alert('jam harus kurang dari 24');
		$(this).val('');
	}else{
		if(kata != ''){
			if(kata.includes('.')){
				kata = kata.replace('.',':');
				$(this).val(kata);
			}
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
	}
})
$("#pulang").on('blur',function(){
	var kata = $(this).val();
	if(kata.substr(0,2)>24){
		alert('jam harus kurang dari 24');
		$(this).val('');
	}else{
		if(kata != ''){
			if(kata.includes('.')){
				kata = kata.replace('.',':');
				$(this).val(kata);
			}
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
	}
})
$("#keluar").on('blur',function(){
	var kata = $(this).val();
	if(kata.substr(0,2)>24){
		alert('jam harus kurang dari 24');
		$(this).val('');
	}else{
		if(kata != ''){
			if(kata.includes('.')){
				kata = kata.replace('.',':');
				$(this).val(kata);
			}
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
	}
})
$("#kembali").on('blur',function(){
	var kata = $(this).val();
	if(kata.substr(0,2)>24){
		alert('jam harus kurang dari 24');
		$(this).val('');
	}else{
		if(kata != ''){
			if(kata.includes('.')){
				kata = kata.replace('.',':');
				$(this).val(kata);
			}
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
	}
})
$("#jnizin").change(function(){
	var hh = $(this).val();
	setinput(hh);
	$("#jnizinx").val(hh);
})
$("#batalizin").click(function(){
	var rel = $("#kirimizin").attr('rel');
	if(rel=='Simpan'){
		kosongkanform();
	}else{
		window.location.href = "../../";
	}
})
$("#kirimizin").click(function(){
	var jnsurat = $("#jnizinx").val();
	if(jnsurat=='IP'){
		if($("#masuk").val()=='' || $("#pulang").val()=='' || $("#alasan").val()==''){
			pesan('Isi data dengan lengkap');
		}else{
			document.formizin.submit();
		}
	}else if(jnsurat=='IT'){
		if($("#masuk").val()=='' || $("#alasan").val()==''){
			pesan('Isi data dengan lengkap');
		}else{
			document.formizin.submit();
		}
	}else{
		if($("#keluar").val()=='' || $("#alasan").val()==''){
			pesan('Isi data dengan lengkap');
		}else{
			document.formizin.submit();
		}
	}
})
function setinput(jnsurat){
	//kosongkanform();
	$("#setjeniscuti").addClass('hilang');
	$("#notsetjeniscuti").addClass('hilang');
	$("#formmasuk").addClass('hilang');
	$("#formkeluar").addClass('hilang');
	$("#formpulang").addClass('hilang');
	$("#formkembali").addClass('hilang');
	$("#formkeluar").addClass('hilang');
	if(jnsurat!= ''){
		$("#setjeniscuti").removeClass('hilang');
		switch (jnsurat) {
			case 'IP':
				$("#formmasuk").removeClass('hilang');
				$("#formpulang").removeClass('hilang');
				break;
			case 'IT':
				$("#formmasuk").removeClass('hilang');
				break;
			case 'IE':
				$("#formkembali").removeClass('hilang');
				$("#formkeluar").removeClass('hilang');
				break;
		}
	}else{
		$("#notsetjeniscuti").removeClass('hilang');
	}
}
function kosongkanform(){
	$("#masuk").val('');
	$("#keluar").val('');
	$("#pulang").val('');
	$("#kembali").val('');
	$("#alasan").val('');
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
function cekjam(){
	var kata = $(this).val();
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