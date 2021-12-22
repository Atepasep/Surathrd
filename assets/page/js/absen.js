$("#batalabsen").click(function(){
    var rel = $("#kirimabsen").attr('rel');
    if(rel=='Simpan'){
        kosongkanform();
    }else{
        window.location.href = "../../";
    }
})
$("#kirimabsen").on('click',function(){
    if($("#jnabsen").val()=='' || $("#tgldari").val()=='' || $("#tglsampai").val()=='' || $("#ket").val()==''){
        pesan('Isi data dengan lengkap !');
    }else{
        if(validasitgl($("#tgldari").val(),"#tgldari","Tanggal dari") && validasitgl($("#tglsampai").val(),"#tglsampai","Tanggal sampai")){
            document.formabsen.submit();
        }
    }
})
$("#adddokumen").click(function(e){
    e.preventDefault();
    $("#dokumen").click();
});
$("#tgldari").on('change',function(){
    // var a = $(this).val();
    // var b = $("#tglsampai").val();
    // var c = ceklamahari(a,b,1,'#tgldari','#tglsampai');
})
$("#tglsampai").on('change',function(){
    if($("#jnabsen").val()=='SD'){
        var a = $("#tgldari").val();
        var b = $(this).val();
        ceklamahari(a,b,1,'#tgldari','#tglsampai');
    }
})
$("#tgldari").on('blur',function(){

})
function kosongkanform(){
    $("#jnabsen").val('');
    $("#tgldari").val('');
    $("#tglsampai").val('');
    $("#ket").val('');
    $("#dokumen").val('');
    $("#dokumen").change();
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