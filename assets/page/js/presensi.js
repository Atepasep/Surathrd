$(document).ready(function () {
	// alert("MASUKKKK");
	$("#button").click();
	// alert(srvTime());
});
var jaraktitik = 0;
// seleksi elemen video
// var video = document.querySelector("#video-webcam");

// // minta izin user
// navigator.getUserMedia =
// 	navigator.getUserMedia ||
// 	navigator.webkitGetUserMedia ||
// 	navigator.mozGetUserMedia ||
// 	navigator.msGetUserMedia ||
// 	navigator.oGetUserMedia;

// // jika user memberikan izin
// if (navigator.getUserMedia) {
// 	// jalankan fungsi handleVideo, dan videoError jika izin ditolak
// 	navigator.getUserMedia({ video: true }, handleVideo, videoError);
// }

// // fungsi ini akan dieksekusi jika  izin telah diberikan
// function handleVideo(stream) {
// 	video.srcObject = stream;
// }

// // fungsi ini akan dieksekusi kalau user menolak izin
// function videoError(e) {
// 	// do something
// 	alert("Izinkan menggunakan webcam untuk demo!");
// }
window.setTimeout("waktu()", 1000);

function waktu() {
	var waktu = new Date();
	setTimeout("waktu()", 1000);
	// document.getElementById("jam").innerHTML = waktu.getHours();
	// document.getElementById("menit").innerHTML = waktu.getMinutes();
	// document.getElementById("detik").innerHTML = waktu.getSeconds();
	var jam = waktu.getHours() < 10 ? "0" + waktu.getHours() : waktu.getHours();
	var menit =
		waktu.getMinutes() < 10 ? "0" + waktu.getMinutes() : waktu.getMinutes();
	var detik =
		waktu.getSeconds() < 10 ? "0" + waktu.getSeconds() : waktu.getSeconds();
	var jamnya = jam + ":" + menit + ":" + detik;
	document.querySelector("#jam-masukkeluar").innerHTML = jamnya;
}

$("#synclokasi").click(function () {
	$("#button").click();
});

$("#statusjarak").on("dblclick", function () {
	$("#button").click();
});

$("#button").click(function () {
	document.querySelector("#jarakanda").innerHTML = "Cek Jarak (Loading ...)";
	document.querySelector("#statusjarak").innerHTML = "Not Allowed";
	function success(position) {
		var s = document.querySelector("#status");
		var i = document.querySelector("#jarakanda");
		var k = document.querySelector("#statusjarak");

		if (s.className == "success") {
			// not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back
			return;
		}

		i.innerHTML =
			"Jarak Anda adalah : <span class='text-primary'><b>" +
			jarak(position.coords.latitude, position.coords.longitude).toFixed(2) +
			"</b></span> Meter";
		s.innerHTML =
			"Lokasi telah ditemukan " +
			"Lat :" +
			position.coords.latitude +
			" Long :" +
			position.coords.longitude +
			" Jarak : " +
			jarak(position.coords.latitude, position.coords.longitude);
		s.className = "success";

		$("#lokasinya").val(
			position.coords.latitude + ", " + position.coords.longitude
		);
		if (
			jarak(position.coords.latitude, position.coords.longitude).toFixed(2) <
			300
		) {
			k.innerHTML = "Allowed";
			k.removeClass = "text-danger";
			k.addClass = "text-primary";
		} else {
			k.innerHTML = "Not Allowed";
			k.removeClass = "text-primary";
			k.addClass = "text-danger";
		}
		jaraktitik = jarak(
			position.coords.latitude,
			position.coords.longitude
		).toFixed(2);
		// var mapcanvas = document.createElement("div");
		// mapcanvas.id = "mapcanvas";
		// mapcanvas.addClass = "hilang";
		// mapcanvas.style.height = "400px";
		// mapcanvas.style.width = "auto";

		// document.querySelector("#status").appendChild(mapcanvas);

		var latlng = new google.maps.LatLng(
			position.coords.latitude,
			position.coords.longitude
		);
		var myOptions = {
			zoom: 15,
			center: latlng,
			mapTypeControl: false,
			navigationControlOptions: {
				style: google.maps.NavigationControlStyle.SMALL,
			},
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		};
		var map = new google.maps.Map(
			document.getElementById("mapcanvas"),
			myOptions
		);

		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			title: "Anda ada di radius " + position.coords.accuracy + ")",
		});
	}

	function error(msg) {
		var s = document.querySelector("#status");
		s.innerHTML = typeof msg == "string" ? msg : "failed";
		s.className = "fail";

		// console.log(arguments);
	}

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(success, error);
	} else {
		error("not supported");
	}
});

function jarak(lat2, lon2) {
	var lat1 = "-6.966254537214371"; //point tengah pabrik
	var lon1 = "107.8058826228893"; //point tengah pabrik
	var unit = "K";
	if (lat1 == lat2 && lon1 == lon2) {
		return 0;
	} else {
		var radlat1 = (Math.PI * lat1) / 180;
		var radlat2 = (Math.PI * lat2) / 180;
		var theta = lon1 - lon2;
		var radtheta = (Math.PI * theta) / 180;
		var dist =
			Math.sin(radlat1) * Math.sin(radlat2) +
			Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		if (dist > 1) {
			dist = 1;
		}
		dist = Math.acos(dist);
		dist = (dist * 180) / Math.PI;
		dist = dist * 60 * 1.1515;
		if (unit == "K") {
			dist = dist * 1.609344 * 1000;
		}
		if (unit == "N") {
			dist = dist * 0.8684;
		}
		return dist;
	}
}

var xmlHttp;
function srvTime() {
	try {
		//FF, Opera, Safari, Chrome
		xmlHttp = new XMLHttpRequest();
	} catch (err1) {
		//IE
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (err2) {
			try {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (eerr3) {
				//AJAX not supported, use CPU time.
				alert("AJAX not supported");
			}
		}
	}
	xmlHttp.open("HEAD", window.location.href.toString(), false);
	xmlHttp.setRequestHeader("Content-Type", "text/html");
	xmlHttp.send("");
	return xmlHttp.getResponseHeader("Date");
}

$("#kirimpresensi").click(function () {
	var jn = $("#jnabsen").val();
	var pkl = $("#jam-masukkeluar").text();
	if ($("#statusjarak").text() == "Not Allowed") {
		pesan("Jarak Presensi tidak diperkenankan, sync lokasi", "info");
		return false;
	}
	if (jn == "") {
		pesan("Pilih Jenis absensi !", "info");
		return false;
	}
	$.ajax({
		type: "POST",
		url: "presensi/tambahpresensi",
		data: {
			jenis: jn,
			jam: pkl,
			tgl: $("#tglku").val(),
			lokasi: $("#lokasinya").val(),
			jarak: jaraktitik,
		},
		success: function (data) {
			// alert(data);
			window.location.reload();
		},
	});
});
$("#blpresensi").change(function () {
	$.ajax({
		type: "POST",
		url: "presensi/ubahperiode",
		data: {
			blpresensi: $(this).val(),
			thpresensi: $("#thpresensi").val(),
		},
		success: function (data) {
			window.location.reload();
		},
	});
});

$("#thpresensi").change(function () {
	$("#blpresensi").change();
});
