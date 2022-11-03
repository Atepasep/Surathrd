$(document).ready(function () {
    $(".tabelakses tr.aktif").click();

})
$("#caridata").on('click', function () {
    var bag = $("#nmbagian").val();
    var grp = $("#nmgrp").val();
    $.ajax({
        type: "POST",
        url: "validator/getdata",
        data: { bg: bag, gr: grp },
        success: function (data) {
            window.location.reload()
        }
    })
})
$(".tabelakses tr").on('click', function () {
    var rel = $(this).attr('rel');
    $(".tabelakses tr").removeClass('aktif');
    $("#rekuser" + rel).addClass('aktif');
    $("#addvalid").addClass("hilang");
    $("#editvalid").addClass("hilang");
    $("#hapusvalid").addClass("hilang");
    $("#addrilis").addClass("hilang");
    $("#editrilis").addClass("hilang");
    $("#hapusrilis").addClass("hilang");
    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "validator/getvalid",
        data: { kritper: rel },
        success: function (data) {
            $("#noindukvalid").val(data.nikvalid);
            $("#namavalid").val(data.namavalid);
            $("#jabatanvalid").val(data.jabatanvalid);
            $("#noindukrilis").val(data.nikrilis);
            $("#namarilis").val(data.namarilis);
            $("#jabatanrilis").val(data.jabatanrilis);
            $("#namkar").html(data.nama);
            $("#bagkar").html(data.bagian);
            $("#jabkar").html(data.jabatan);
            if (data.nikvalid == null) {
                $("#addvalid").removeClass("hilang");
                $("#addvalid").attr('href', base_url + 'validator/addvalid/' + rel);
            } else {
                $("#hapusvalid").removeClass("hilang");
                $("#hapusvalid").attr('data-href', base_url + 'validator/delvalid/' + rel);
                $("#editvalid").removeClass("hilang");
                $("#editvalid").attr('href', base_url + 'validator/addvalid/' + rel);
            }
            if (data.nikrilis == null) {
                $("#addrilis").removeClass("hilang");
                $("#addrilis").attr('href', base_url + 'validator/addrilis/' + rel);
            } else {
                $("#hapusrilis").removeClass("hilang");
                $("#hapusrilis").attr('data-href', base_url + 'validator/delrilis/' + rel);
                $("#editrilis").removeClass("hilang");
                $("#editrilis").attr('href', base_url + 'validator/addrilis/' + rel);
            }
        }
    })
})
