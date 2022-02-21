$(document).ready(function(){
	
})
$(document).on('click','#nodok',function(){
	var xx = $(this).attr('rel');
	var yy = $(this).attr('kode');
	$.ajax({
	    type : "POST",
		url : 'pengumuman/ubahdok',
		data : {ses : xx,ser : yy },
		success : function(data){
			location.reload();
		}
	})
})
$("#tahsurat").on('change',function(){
	var tah = $(this).val();
	$.ajax({
	    type : "POST",
		url : 'pengumuman/ubahtahun',
		data : {ses : tah },
		success : function(data){
			location.reload();
		}
	})
})