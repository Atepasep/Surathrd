$(document).ready(function(){
	var nomes = $("#nomes").val();
	$(".panel-title").html('Input Rpm Netting, Nomor Mesin : '+nomes);
})
$("#nomes").change(function(){
	$(".panel-title").html('Input Rpm Netting, Nomor Mesin : '+$(this).val());
	getdatarpm($(this).val(),$("#tglrpm").val(),$("#shipt").val());
})
$("#tglrpm").change(function(){
	getdatarpm($("#nomes").val(),$(this).val(),$("#shipt").val());	
})
$("#shipt").change(function(){
	getdatarpm($("#nomes").val(),$("#tglrpm").val(),$(this).val());		
})
$("#tambahrpm").click(function(){
	var tglx = $("#tglrpm").val();
	var shi = $("#shipt").val();
	var nom = $("#nomes").val();
	$.ajax({
        type : "POST",
        url : 'rpm/adddata',
        data : {tgl : tglx,ihs : shi,mon : nom },
        success : function(data){
   			location.reload();
        }
  	})
})

function getdatarpm(mesin,tanggal,sip){
	$.ajax({
	        type : "POST",
	        url : 'rpm/getdatamesin',
	        data : {x1 : mesin,x2 : tanggal,x3 : sip },
	        success : function(data){
	   			location.reload();
	        }
      	})
}