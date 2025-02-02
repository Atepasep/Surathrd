$(document).ready(function () {
	//setinput('');
	$("#jnsurat").change();
	$("#jncuti").change();

	$("#jamik").on("change click keyup input paste", function (event) {
		$(this).val(function (index, value) {
			return value
				.replace(/(?!\.)\D/g, "")
				.replace(/(?<=\..*)\./g, "")
				.replace(/(?<=\.\d\d).*/g, "")
				.replace(/\B(?=(\d{2})+(?!\d))/g, ":");
		});
	});
});
$("#selama").on("blur", function () {
	var cek = document.getElementById("selama").readOnly;
	if (!cek) {
		if ($(this).val != "") {
			var isi = $(this).val();
			var xe = isi.substring(isi.length - 4);
			if (xe.toUpperCase() == "HARI") {
				$(this).val(isi);
			} else {
				$(this).val(isi + " Hari");
			}
		}
	}
});
$("#selama").on("focus", function () {
	var cek = document.getElementById("selama").readOnly;
	if (!cek) {
		if ($(this).val != "") {
			var isi = $(this).val();
			var xe = isi.substring(isi.length - 4);
			if (xe.toUpperCase() == "HARI") {
				$(this).val(isi.substring(0, isi.length - 5));
			}
		}
	}
});
$("#jamik").on("blur", function () {
	var kata = $(this).val();
	if (kata.substr(0, 2) > 24) {
		alert("jam harus kurang dari 24");
		$(this).val("");
	} else {
		if (kata != "") {
			if (kata.includes(".")) {
				kata = kata.replace(".", ":");
				$(this).val(kata);
			}
			var panjang = kata.length;
			if (panjang < 5) {
				if (panjang > 2) {
					kata = "0" + kata;
				}
				kata = kata.replace(":", "");
				for (dari = panjang; dari <= 4; dari++) {
					kata += "0";
				}
			}
			var pisah1 = kata.substr(0, 2);
			var pisah2 = kata.substr(2, 2);
			if (!kata.includes(":")) {
				$(this).val(pisah1 + ":" + pisah2);
			}
		}
	}
});
$("#tgldari").on("change textInput Input", function () {
	cekhari($(this).val(), $("#tglsampai").val());
});
$("#tglsampai").on("change texInput Input", function () {
	$("#tgldari").change();
});
$("#jnsurat").change(function () {
	var hh = $(this).val();
	setinput(hh);
	$("#jnsuratx").val(hh);
});
$("#jncuti").on("change", function () {
	if ($(this).val() == "") {
		$("#formtombol").addClass("hilang");
	} else {
		$("#formtombol").removeClass("hilang");
		$("#selama").prop("readonly", true);
		if ($(this).val() == "2") {
			$("#selama").prop("readonly", false);
			$("#alasan").val("Diuangkan");
			$("#formtgldari").addClass("hilang");
			$("#formtglsampai").addClass("hilang");
		} else {
			$("#formtgldari").removeClass("hilang");
			$("#formtglsampai").removeClass("hilang");
		}
	}
});
$("#batalcuti").click(function () {
	var rel = $("#kirimcuti").attr("rel");
	if (rel == "Update") {
		window.location.href = "../../";
	} else {
		kosongkanform();
	}
});
$("#kirimcuti").click(function () {
	var jncuti = $("#jncuti").val();
	var jmlama = $("#selama").val().trim();
	if (jncuti == "2") {
		if (
			$("#masakerja").val() == "" ||
			$("#selama").val() == "" ||
			jmlama == "Hari"
		) {
			pesan(
				"Isi masa kerja tahun ke berapa dan selama berapa lama cuti diuangkan ?"
			);
		} else {
			document.formcuti.submit();
		}
	} else {
		var jnsurat = $("#jnsuratx").val();
		if (jnsurat == "CH") {
			if ($("#tgldari").val() == "" || $("#tglsampai").val() == "") {
				pesan("Isi data demgan lengkap");
			} else {
				if (
					validasitgl($("#tgldari").val(), "#tgldari", "Tanggal dari") &&
					validasitgl($("#tglsampai").val(), "#tglsampai", "Tanggal sampai")
				) {
					document.formcuti.submit();
				}
			}
		} else {
			if (jnsurat != "IK") {
				if (
					$("#tgldari").val() == "" ||
					$("#tglsampai").val() == "" ||
					$("#masakerja").val() == "" ||
					$("#alasan").val() == ""
				) {
					pesan("Isi data demgan lengkap");
				} else {
					if (
						validasitgl($("#tgldari").val(), "#tgldari", "Tanggal dari") &&
						validasitgl($("#tglsampai").val(), "#tglsampai", "Tanggal sampai")
					) {
						document.formcuti.submit();
					}
				}
			} else {
				if (
					$("#tgldari").val() == "" ||
					$("#tglsampai").val() == "" ||
					$("#masakerja").val() == "" ||
					$("#alasan").val() == "" ||
					$("#tglik").val() == "" ||
					$("#hariik").val() == "" ||
					$("#jamik").val() == "" ||
					$("#tempatik").val() == ""
				) {
					pesan("Isi data dengan lengkap");
				} else {
					if (
						validasitgl($("#tgldari").val(), "#tgldari", "Tanggal dari") &&
						validasitgl(
							$("#tglsampai").val(),
							"#tglsampai",
							"Tanggal sampai"
						) &&
						validasitgl($("#tglik").val(), "#tglik", "Tanggal izin")
					) {
						document.formcuti.submit();
					}
				}
			}
		}
	}
});
function setinput(jnsurat) {
	// kosongkanform();
	$("#setjeniscuti").addClass("hilang");
	$("#notsetjeniscuti").addClass("hilang");
	$("#formtgldari").addClass("hilang");
	$("#formtglsampai").addClass("hilang");
	$("#formmasakerja").addClass("hilang");
	$("#formalasan").addClass("hilang");
	$("#formtglik").addClass("hilang");
	$("#formhariik").addClass("hilang");
	$("#formjamik").addClass("hilang");
	$("#formtempatik").addClass("hilang");
	$("#formtombol").addClass("hilang");
	switch (jnsurat) {
		case "C":
			$("#setjeniscuti").removeClass("hilang");
			$("#formtgldari").removeClass("hilang");
			$("#formtglsampai").removeClass("hilang");
			$("#formmasakerja").removeClass("hilang");
			$("#formalasan").removeClass("hilang");
			$("#jnsuratx").val("CT");
			break;
		case "CP":
			$("#setjeniscuti").removeClass("hilang");
			$("#formtgldari").removeClass("hilang");
			$("#formtglsampai").removeClass("hilang");
			$("#formmasakerja").removeClass("hilang");
			$("#formalasan").removeClass("hilang");
			break;
		case "CH":
			$("#setjeniscuti").removeClass("hilang");
			$("#formtgldari").removeClass("hilang");
			$("#formtglsampai").removeClass("hilang");
			break;
		case "IK":
			$("#setjeniscuti").removeClass("hilang");
			$("#formtgldari").removeClass("hilang");
			$("#formtglsampai").removeClass("hilang");
			$("#formmasakerja").removeClass("hilang");
			$("#formalasan").removeClass("hilang");
			$("#formtglik").removeClass("hilang");
			$("#formhariik").removeClass("hilang");
			$("#formjamik").removeClass("hilang");
			$("#formtempatik").removeClass("hilang");
			break;
		default:
			$("#notsetjeniscuti").removeClass("hilang");
	}
}
function kosongkanform() {
	$("#setjeniscuti").val("");
	$("#notsetjeniscuti").val("");
	$("#jncuti").val("");
	$("#tgldari").val("");
	$("#tglsampai").val("");
	$("#masakerja").val("");
	//$("#alasan").val('');
	$("#tglik").val("");
	$("#hariik").val("");
	$("#jamik").val("");
	$("#tempatik").val("");
	$("#selama").val("");
	$("#selama").prop("readonly", true);
}
function cekhari(tglawal, tglakhir) {
	if (tglawal == "" || tglakhir == "") {
		$("#selama").val("");
	} else {
		var satuhari = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
		var pisah1 = tglawal.split("-");
		var pisah2 = tglakhir.split("-");
		var tgl1 = new Date(pisah1[2], pisah1[1], pisah1[0]);
		var tgl2 = new Date(pisah2[2], pisah2[1], pisah2[0]);
		var diffDays = Math.round(
			Math.round((tgl1.getTime() - tgl2.getTime()) / satuhari) - 1
		);
		if (diffDays > 0) {
			alert("Tgl dari harus lebih kecil dari tgl sampai");
			$("#tgldari").val("");
			$("#tglsampai").val("");
			$("#selama").val("");
		} else {
			var hasil = diffDays * -1;
			$("#selama").val(hasil + " Hari");
		}
	}
}
