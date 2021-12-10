$("#adddokumen").click(function(e){
    e.preventDefault();
    $("#dokumen").click();
});
$("#batalfotoprofile").click(function(){
	$("#dokumen").val('');
    $("#dokumen").change();
})
$("#simpanfotoprofile").click(function(){
	document.formprofile.submit();
})
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