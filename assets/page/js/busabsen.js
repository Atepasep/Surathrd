$(document).on('click','#masuk',function(){
    var rel = $(this).attr('rel');
    var cek = $(this).children().hasClass('fa-square-o');
    if(cek){
        $(this).children().removeClass('fa-square-o');
        $(this).children().addClass('fa-check-square-o');
    }else{
        $(this).children().addClass('fa-square-o');
        $(this).children().removeClass('fa-check-square-o');
    }
})
$(document).on('click','#keluar',function(){
    var rel = $(this).attr('rel');
    var cek = $(this).children().hasClass('fa-square-o');
    if(cek){
        $(this).children().removeClass('fa-square-o');
        $(this).children().addClass('fa-check-square-o');
    }else{
        $(this).children().addClass('fa-square-o');
        $(this).children().removeClass('fa-check-square-o');
    }
})
$("#tglabsen").on('change',function(){
    var dattgl = $(this).val();
    $.ajax({
        dataType: 'json',
        type : "POST",
        url : "busabsen/ubahtglabsen",
        data : {tgl : dattgl },
        success : function(data){
            if(data=1){
                document.location.reload();
            }
        }
      })
})