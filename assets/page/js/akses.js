$(document).on("click","#rekuser",function(){
    var  rel = $(this).attr('rel');
    $.ajax({
        dataType: 'json',
        type : "POST",
        url : "hakakses/getdetailuser",
        data : {idkey : rel },
        success : function(data){
              if(data.length > 0){
                  $("#tabelakses tr").removeClass("activex");
                  $(this).addClass("activex");
                  $("#noinduk").val(data[0]['noinduk']);
                  $("#namauser").val(data[0]['nama']);
                  $("#jabatan").val(data[0]['jabatan']);
                  isihak(rel);
              }
        }
      })
})
function isihak(no){
    $.ajax({
        dataType: 'json',
        type : "POST",
        url : "hakakses/gethakuser",
        data : {noin : no },
        success : function(data){
              if(data.length > 0){
                 for(x=1;x<=30;x++){
                     let kata = data[0]['hakdep'];
                     if(kata.substr(x-1,1)!='0'){
                        $("#cekbagian"+x).removeClass('text-black');
                        $("#cekbagian"+x).addClass('text-red');
                     }else{
                        $("#cekbagian"+x).removeClass('text-red');
                        $("#cekbagian"+x).addClass('text-black');
                     }
                 }
              }
        }
      })
}

var loadFile = function(event) {
    var output = document.getElementById('gbimage');
    var isifile = event.target.files[0];
    if(!isifile){
        output.src = 'assets/page/images/add-files.svg';
    }else{
        output.src = URL.createObjectURL(isifile);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    }
  };