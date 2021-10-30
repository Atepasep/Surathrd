$("#selekmesin").change(function(){
	var hh = $("#selekmesin").val();
	$.ajax({
	        type : "POST",
	        url : 'mesin/insertsesi',
	        data : {ses : hh },
	        success : function(data){
	   			location.reload();
	        }
      	})
})