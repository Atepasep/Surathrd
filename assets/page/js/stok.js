$("#selekdept").change(function(){
	var hh = $("#selekdept").val();
	$.ajax({
	        type : "POST",
	        url : 'stok/insertsesi',
	        data : {ses : hh },
	        success : function(data){
	   			location.reload();
	        }
      	})
})