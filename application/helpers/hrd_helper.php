<?php
	define('LOK_PAGE',base_url().'assets/page/');
	define('LOK_UPLOAD_USER',"./assets/page/images/user/");
	define('LOK_FOTO_USER',base_url().'assets/page/images/user/');
	define('LOK_FOTO',base_url().'assets/page/images/');
	define('LOK_UPLOAD_MESIN',"./assets/page/images/user/FOTO/");

	function querydep($data){
		$CI = & get_instance();
		$string = 'GMGPGFGWGSSPRRNTFGFNUTPCITPGMKRDPPAK';
		$data = $CI->session->userdata('moduldept');
		$tampung = "";
		for($m=1;$m<=18;$m++){
			$ok = substr($data, $m-1,1);
			if($ok=='1'){
				$tampung .= '"'.substr($string, ($m*2)-2,2).'",';
			}
		}
		return substr($tampung,0,strlen($tampung)-1);
	}

	function max_upload(){
		$max_filesize = (int) (ini_get('upload_max_filesize'));
		$max_post     = (int) (ini_get('post_max_size'));
		$memory_limit = (int) (ini_get('memory_limit'));
		return min($max_filesize, $max_post, $memory_limit);
	}

	function selected($a,$b){
		if($a==$b){
			echo "selected";
		}
	}

	function cekmod($a,$id){
		$CI = & get_instance();
		$nan = $CI->m_user->getmoduldept($id);
		if($nan == null){
			$nan = str_repeat('0', 20);
		}
		if(substr($nan, $a, 1)==1){
			echo "checked";
		}		
	}

	function cekmoe($a,$id){
		$CI = & get_instance();
		$nan = $CI->m_user->getmodul($id);
		if($nan == null){
			$nan = str_repeat('0', 20);
		}
		if(substr($nan, $a, 1)==1){
			echo "checked";
		}		
	}
	function cekso($a,$id){
		$CI = & get_instance();
		$nan = $CI->m_user->getmodulso($id);
		if($nan == null){
			$nan = str_repeat('0', 20);
		}
		if(substr($nan, $a, 1)==1){
			echo "checked";
		}		
	}

	function cekmoe2($a,$id){
		$hasil = '';
		$CI = & get_instance();
		$nan = $CI->m_user->getmodul($id);
		if($nan == null){
			$nan = str_repeat('0', 20);
		}
		if(substr($nan, $a, 1)==1){
			$hasil = "checked";
		}		

		return $hasil;
	}

	function deptuju($dep){
		$dp = '';
		if($dep != ''){
			switch ($dep) {
				case 'GP':
					$dp = 'Gudang GIP';
					break;
				case 'GM':
					$dp = 'Gudang Material';
					break;
				case 'GS':
					$dp = 'Gudang Sparepart';
					break;
				case 'PG':
					$dp = 'Personalia & GA';
					break;
				case 'IT':
					$dp = 'Information Tech';
					break;
				case 'PC':
					$dp = 'Purchasing';
					break;
				case 'UT':
					$dp = 'Utility';
					break;
				case 'NT':
					$dp = 'Netting';
					break;
				case 'FN':
					$dp = 'Finishing';
					break;
				case 'SP':
					$dp = 'Spinning';
					break;
			}
		}
		return $dp;
	}

	function deptuju2($dep){
		$dp = '';
		$CI = & get_instance();
		$kode = $CI->m_user->getnamadep($dep);
		if($kode==''){
			$dp = 'Error';
		}else{
			$dp = $kode;
		}
		return trim($dp);
	}

	function tglmysql($tgl){
		if($tgl == '' || $tgl == '0000-00-00'){
			$rubah = '';
		}else{
			$x = explode('-',$tgl);
			$rubah = $x[2].'-'.$x[1].'-'.$x[0];
		}
		return $rubah;
	}

	function debon($bon){
		$hasil = str_replace('/', 'Z', $bon);
		return $hasil;
	}

	function undebon($bon){
		$hasil = str_replace('Z', '/', $bon);
		return $hasil;
	}

	function notnol($nol){
		$x = $nol;
		if($nol==0){
			$x = '';
		}
		return $x;
	}

	function cekmod2($mod,$no){
		$hasil = '';
		if(substr($mod, $no, 1) != '1'){
			$hasil = " hilang";
		}
		return $hasil;
	}

	function carishift($k){
		$hasil = '';
		switch ($k) {
			case $k>=1 && $k<=9:
				$hasil = 'MALAM';
				break;
			case ($k>= 10 && $k<=18) || ($k>= 28 && $k<=33):
				$hasil = 'PAGI';
				break;
			case ($k>= 19 && $k<=27) || ($k>= 34 && $k<=39):
				$hasil = 'SIANG';
				break;
		}
		return $hasil;
	}

	function rupiah($nomor,$dec){
		if($nomor == '0' || $nomor == ''){
			$hasil = '';
		}else{
			if($nomor < 0){
				$hasil = '('.number_format(abs($nomor),$dec,'.',',').')';
			}else{
				$hasil = number_format($nomor,$dec,'.',',');
			}
		}
		return $hasil;
	}
	function angka($nomor,$dec){
		if($nomor == '0' || $nomor == ''){
			$hasil = '0.00';
		}else{
			$hasil = number_format($nomor,$dec,'.',',');
		}
		return $hasil;
	}
	function kilo($nomor,$dec){
		if($nomor == '0' || $nomor == ''){
			$hasil = '';
		}else{
			$hasil = number_format($nomor,$dec,'.',',').' kgs';
		}
		return $hasil;
	}
	function tglhariini($dt){
		if($dt!=''){
			$x = date('w',strtotime($dt));
			switch ($x) {
				case 0:
					$hari = "Minggu";
					break;
				case 1:
					$hari = "Senin";
					break;
				case 2:
					$hari = "Selasa";
					break;
				case 3:
					$hari = "Rabu";
					break;
				case 4:
					$hari = "Kamis";
					break;
				case 5:
					$hari = "Jumat";
					break;
				case 6:
					$hari = "Sabtu";
					break;
			}
		}else{
			$hari = "tidak diketahui";
		}
	return $hari.', '.$dt;
	}
	function tgl_bulan_indo(){
		$tanggal = date('Y-m-d');
		$hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];
		$bulan = array (1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$pecahkan = explode('-', $tanggal);
		return $hari[date('w')].', '.$pecahkan[2].' '.$bulan[ (int)$pecahkan[1] ].' '.$pecahkan[0];
	}
	function tglpanjang($dt){
		if($dt!='0000-00-00'){
			$hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];
			$bulan = array (1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$pecahkan = explode('-', $dt);
			return $pecahkan[2].' '.$bulan[ (int)$pecahkan[1] ].' '.$pecahkan[0];
		}else{
			return '-';
		}
	}
 	function header_dids(){
 		$bulan = array (1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
 		return $bulan[(int) date('m')].', '.date('Y');
 	}
	function umur($tanggal_lahir){
		$birthDate = new DateTime($tanggal_lahir);
		$today = new DateTime("today");
		if ($birthDate > $today) { 
			exit("0 tahun, 0 bulan, 0 hari");
		}
		$y = $today->diff($birthDate)->y;
		$m = $today->diff($birthDate)->m;
		$d = $today->diff($birthDate)->d;
		return $y." tahun, ".$m." bulan, ".$d." hari";
	}
	function selisihhari($awal,$tglakhir){
		$tgl1 = strtotime($awal); 
		$tgl2 = strtotime($tglakhir); 
		$jarak = ($tgl2 - $tgl1) +1;
		$hari = $jarak / 60 / 60 / 24;
		return ceil($hari).' hari';
	}
	function prosedursurat($nomor,$nom2){
		if($nom2==0){
			$ket = 'Menunggu Approve Kepala Shift';
		}else{
			switch($nomor){
				case 1:
					$ket = 'Menunggu di Submit HRD';
					break;
				case 2:
					$ket = 'Selesai';
					break;
				case 3:
					$ket = 'Ditolak';
					break;
				default:
					$ket = 'Menunggu Approve Kepala Departemen';
			}
		}
		return $ket;
	}
	function gethakdep($dep){
		$dp = '';
		//$CI = & get_instance();
		//$kode = $CI->m_user->getnamadep($dep);
		if(is_null($dep)){
			$dp="'X'";
		}else{
			if($dep==''){
				$dp='Error';
			}else{
				$CI = & get_instance();
				for($x=0;$x<=30;$x++){
					$pisah = substr($dep,$x,1);
					if($pisah=='1'){
						$departemen = $CI->m_login->getnamadep($x+1);
						$dp .= "'".$departemen['bagian']."',";
					}
				}
				$dp = substr($dp,0,strlen($dp)-1);
			}
		}
		if($dp == ''){
			$dp="'X'";
		}
		return $dp;
	}
	function ubahpagar($kata){
		$hasil = '';
		for($x=1;$x<=strlen($kata);$x++){
			$hasil .= '#';
		}
		return $hasil;
	}

	function carikaryabsen($tgl){
		$CI = & get_instance();
		$nan = $CI->m_cuti->getkaryabsen($tgl)->row_array();
		$nam = $CI->m_cuti->getkarycuti($tgl)->row_array();
		$jml = $nam['jml']+$nan['jml'];
		if($jml==0){
			return  '-';
		}else{
			return $jml.' Orang';
		}
	}

	function getidentitas($kritper){
		$CI = & get_instance();
		$nan = $CI->m_user->getdatauserkrit($kritper)->row_array();
		return $nan;
	}
?>