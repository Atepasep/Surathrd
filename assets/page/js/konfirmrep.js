$("#tglizin").on('change',function(){
    var dattgl = $(this).val();
    var url = $("#urltujuan").val();
    $.ajax({
        dataType: 'json',
        type : "POST",
        url : url,
        data : {tgl : dattgl },
        success : function(data){
            if(data=1){
                document.location.reload();
            }
        },
        error : function(xhr, status, error){
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
      })
})