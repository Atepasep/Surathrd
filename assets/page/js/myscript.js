$(document).ready(function(){
	function blink_text() {
        $('.blink').fadeOut(500);
        $('.blink').fadeIn(500);
    }
    setInterval(blink_text, 1000);
	$("#file_browser").click(function(e){
		e.preventDefault();
		$("#file").click();
	});
	$('#file_path').click(function(){
		$("#file_browser").click();
	});
	$("#file").change(function(){
		$("#file_path").val($(this).val());
	});

	modalBox();
	modalBox3();

	$(".tglpilih").datepicker({
      autoclose : true,
      format : 'dd-mm-yyyy'
    })

    $(".tglpilih2").datepicker({
      autoclose : true,
      format : 'dd-mm-yyyy',
      endDate : '+1d'
    })
    $(".datatableasli").DataTable();
	$(".datatable").DataTable({
		paging : false,
		searching: false,
		info: false,
		scrollY: false
	});
	$(".datatable2").DataTable({
		paging : true,
		searching: false,
		info: true,
		ordering : false,
		scrollY: false
	});
	$(".datatable3").DataTable({
		paging : true,
		searching: false,
		info: true,
		scrollY: false,
		ordering : false,
		pageLength : 50
	});
	$(".datatable4").DataTable({
		paging : false,
		searching: false,
		info: true,
		scrollY: false,
		ordering : false
	});
	$(".datatable5").DataTable({
		paging : false,
		searching: true,
		info: false,
		scrollY: false
	});

	$('#confirm-delete').on('show.bs.modal', function(e) {
		var string = document.getElementById("confirm-delete").innerHTML;
		var hasil = string.replace("fa fa-text-width text-yellow","fa fa-exclamation-triangle text-red");
		document.getElementById("confirm-delete").innerHTML = hasil;

		var string2 = document.getElementById("confirm-delete").innerHTML;
		var hasil2 = string2.replace("Konfirmasi", "&nbspKonfirmasi");
		document.getElementById("confirm-delete").innerHTML = hasil2;
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	$('#confirm-task').on('show.bs.modal', function(e) {
		var string2 = document.getElementById("confirm-delete").innerHTML;
		var hasil2 = string2.replace("Konfirmasi", "&nbspKonfirmasi");
		document.getElementById("confirm-delete").innerHTML = hasil2;
		document.getElementById("test").innerHTML = $(e.relatedTarget).data('news');
		$(this).find('.btn-oke').attr('href', $(e.relatedTarget).data('href'));
	});
	
	$("#viewpass").mousedown(function(){
		$("#password").attr('type','text');
	});
	$("#viewpass").mouseup(function(){
		$("#password").attr('type','password');
	});

	$("#kodebagian").change(function(){
		var kata = $(this).val();
		var text = $("#kodebagian option:selected").text();
		$("#bagian").val(text.substr(4,30));
	})

	$("#selekbondari").change(function(){
		var hh = $("#selekbondari").val();
		$.ajax({
	        type : "POST",
	        url : 'in/insertsesi',
	        data : {ses : hh },
	        success : function(data){
	   			location.reload();
	        }
      	})
	})
	$("#bulanini").change(function(){
		var d = new Date();
		var n = d.getMonth();
		var m = d.getFullYear();
		var bul = $("#bulanini").val();
		var tah = $("#tahunini").val();
		if(bul <= (n+1)){
			$.ajax({
		        type : "POST",
		        url : 'gou/isikondisi',
		        data : {bl : bul, th : tah },
		        success : function(data){
		   			location.reload();
		        }
      		})
		}
	})
	$("#tahunini").change(function(){
		$("#bulanini").change();
	})
	//document.getElementById("ejam").textContent=
})
function cekcik(){
	var x = $(this).val();
	alert('OKE');
}
function formAction(formname,action){
	$('#'+formname).attr('action',action);
	$('#'+formname).submit();
}
function modalBox(){
	$('#modalBox').on('show.bs.modal', function(e){
		var link = $(e.relatedTarget);
		var title = link.data('title');
		var modal = $(this)
		modal.find('.modal-title').text(title)
		$(this).find('.fetched-data').load(link.attr('href'));
	});
	return false;
}
function modalBox3(){
	$('#modalBox3').on('show.bs.modal', function(e){
		var link = $(e.relatedTarget);
		var title = link.data('title');
		var modal = $(this)
		modal.find('.modal-title').text(title)
		$(this).find('.fetched-data').load(link.attr('href'));
	});
	return false;
}
function angkaJam(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 58))
  
	  return false;
	return true;
  }
//function modalBox2(){
//	$('#modalBox2').on('show.bs.modal', function(e){
//		var link = $(e.relatedTarget);
//		var title = link.data('title');
//		var modal = $(this)
//		modal.find('.modal-title').text(title)
//		$(this).find('.fetched-data').load(link.attr('href'));
//	});
//	return false;
//}
function pesan(pesan,jenis){
	if(jenis = 'info'){
		var head = 'Information';
	}
	$.toast({
			heading: head,
			text: pesan,
			showHideTransition: 'slide',
			icon: jenis,
			hideAfter: 5000,
			position: 'bottom-right',
			bgColor: ' 	#17A2B8'
		});
}
