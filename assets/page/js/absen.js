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
        document.formabsen.submit();
    }
})
$("#adddokumen").click(function(e){
    e.preventDefault();
    $("#dokumen").click();
});
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