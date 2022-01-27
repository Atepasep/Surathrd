$("#periodekk").on('change',function(){
    var ini = $(this).val();
    $.ajax({
        type : "POST",
        url : base_url+"profile/ubahperiode",
        data : {period : ini },
        success : function(data){
            if(data==1){
                location.reload();
            }
        }
      })
})
var asal = '';
$("#nokk").on("focus",function(){
    asal = $(this).val();
})
$("#nokk").on("blur",function(){
    var jadi = $(this).val();
    if(asal!=jadi){
        $.ajax({
            type : "POST",
            url : base_url+"profile/updatekk",
            data : {nokk : jadi},
            success : function(data){
                if(data==1){
                    console.log('Berhasil simpan nomor kk');
                }
            }
            ,
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
              }
          })
    }
})
$("#validasidata").on('click',function(){
    $("#nokk").blur();
    if($("#nokk").val()==''){
        pesan('Isi dahulu nomor KK','info');
        return false;
    }
})