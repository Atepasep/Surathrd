$(document).ready(function () {
    $(".tabelakses tr.aktif").click();
})
$(".tabelakses tr").on('click', function () {
    var rel = $(this).attr('rel');
    $("#idbagianx").val($(this).attr('rel2'));
    $("#idgrpx").val($(this).attr('rel3'));
    $(".tabelakses tr").removeClass('aktif');
    $("#rekuser" + rel).addClass('aktif');
    $("#xvalid").change();
})
$("#cekspv").on('click', function () {
    if ($(this).prop('checked')) {
        $.ajax({
            type: "POST",
            url: "validator/tospv",
            data: { dt: '1' },
            success: function (data) {
                window.location.reload()
            }
        })
    } else {
        $.ajax({
            type: "POST",
            url: "validator/tospv",
            data: { dt: '0' },
            success: function (data) {
                window.location.reload()
            }
        })
    }
})

$("#xvalid").change(function () {
    var xx = $("#idbagianx").val();
    var yy = $("#idgrpx").val();
    var zz = $("#xvalid").val();
    $("#addvalid").addClass('hilang');
    $("#editvalid").addClass('hilang');
    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "validator/cekvalid",
        data: { bag: xx, grp: yy, lid: zz },
        success: function (data) {
            if (data.len > 0) {
                $("#noinduk").val(data[0].noinduk);
                $("#nama").val(data[0].nama);
                $("#jabatan").val(data[0].jabatan);
                $("#editvalid").removeClass('hilang');
            } else {
                $("#noinduk").val('');
                $("#nama").val('');
                $("#jabatan").val('');
                $("#addvalid").removeClass('hilang');
            }
        }
    })

})

// $(".tabelaksesx tr").on('click', function () {
//     var rel = $(this).attr('rel');
//     $.ajax({
//         dataType: 'json',
//         type: "POST",
//         url: "validator/getdetailuser",
//         data: { idkey: rel },
//         success: function (data) {
//             if (data.length > 0) {
//                 //   $(".tabelakses tr").removeClass('bold');
//                 $(".tabelakses tr").removeClass('aktif');
//                 //   $("#rekuser"+rel).addClass('bold');
//                 $("#rekuser" + rel).addClass('aktif');
//                 $("#noinduk").val(data[0]['noinduk']);
//                 $("#namauser").val(data[0]['nama']);
//                 $("#jabatan").val(data[0]['jabatan']);
//                 if (data[0]['id_jabat'] <= 4) {
//                     $("#aksesgrp").removeClass('hilang');
//                 } else {
//                     $("#aksesgrp").addClass('hilang');
//                 }
//                 isihak(rel);
//                 isigrp(rel);
//             }
//         }
//     })
// })
// function isihak(no) {
//     $.ajax({
//         dataType: 'json',
//         type: "POST",
//         url: "hakakses/gethakuser",
//         data: { noin: no },
//         success: function (data) {
//             if (data.length > 0) {
//                 for (x = 1; x <= 30; x++) {
//                     let kata = data[0]['hakdep'];
//                     if (kata.substr(x - 1, 1) != '0') {
//                         $("#cekbagian" + x).removeClass('text-black');
//                         $("#cekbagian" + x).addClass('text-red');
//                         $("#cekbagian" + x + " i").removeClass('fa-circle-o');
//                         $("#cekbagian" + x + " i").addClass('fa-check-circle-o');
//                         $("#cekbagian" + x).addClass('bold');
//                     } else {
//                         $("#cekbagian" + x).removeClass('text-red');
//                         $("#cekbagian" + x).addClass('text-black');
//                         $("#cekbagian" + x + " i").removeClass('fa-check-circle-o');
//                         $("#cekbagian" + x + " i").addClass('fa-circle-o');
//                         $("#cekbagian" + x).removeClass('bold');
//                     }
//                 }
//             }
//         }
//     })
// }
// function isigrp(no) {
//     $.ajax({
//         dataType: 'json',
//         type: "POST",
//         url: "hakakses/gethakuser",
//         data: { noin: no },
//         success: function (data) {
//             if (data.length > 0) {
//                 for (x = 1; x <= 30; x++) {
//                     let kata = data[0]['hakgrp'];
//                     if (kata.substr(x - 1, 1) != '0') {
//                         $("#cekgrp" + x).removeClass('text-black');
//                         $("#cekgrp" + x).addClass('text-red');
//                         $("#cekgrp" + x + " i").removeClass('fa-circle-o');
//                         $("#cekgrp" + x + " i").addClass('fa-check-circle-o');
//                         $("#cekgrp" + x).addClass('bold');
//                     } else {
//                         $("#cekgrp" + x).removeClass('text-red');
//                         $("#cekgrp" + x).addClass('text-black');
//                         $("#cekgrp" + x + " i").removeClass('fa-check-circle-o');
//                         $("#cekgrp" + x + " i").addClass('fa-circle-o');
//                         $("#cekgrp" + x).removeClass('bold');
//                     }
//                 }
//             }
//         }
//     })
// }
// function Editakses(a) {
//     //var rel = $(this).sibling.attr('rel');
//     var no = $("#noinduk").val();
//     $.ajax({
//         dataType: 'json',
//         type: "POST",
//         url: "hakakses/editakses2",
//         data: { noin: no, ke: a },
//         success: function (data) {
//             $(".tabelakses tr.aktif").click();
//         }
//     })
// }
// function Editaksesgrp(a) {
//     //var rel = $(this).sibling.attr('rel');
//     var no = $("#noinduk").val();
//     $.ajax({
//         dataType: 'json',
//         type: "POST",
//         url: "hakakses/editaksesgrp",
//         data: { noin: no, ke: a },
//         success: function (data) {
//             $(".tabelakses tr.aktif").click();
//         }
//     })
// }

// var loadFile = function (event) {
//     var output = document.getElementById('gbimage');
//     var isifile = event.target.files[0];
//     if (!isifile) {
//         output.src = 'assets/page/images/add-files.svg';
//     } else {
//         output.src = URL.createObjectURL(isifile);
//         output.onload = function () {
//             URL.revokeObjectURL(output.src) // free memory
//         }
//     }
// };