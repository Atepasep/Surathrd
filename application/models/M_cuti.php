<?php
class M_cuti extends CI_Model {
	public function getdata(){
		$noinduk = $this->session->userdata('noinduk');
		$krit = substr($this->session->userdata('kritper'),0,1);
		$pers = substr($this->session->userdata('kritper'),1,8);
		$query = $this->db->query("SELECT a.*,b.keterangan AS namacuti FROM cuti a
		LEFT JOIN jeniscuti b ON a.jncuti = b.kode
		WHERE a.kritkar = ".$krit." and a.person_id = '".$pers."' order by a.dibuat desc ");
		return $query; //->result_array();
	}
	public function getdatacuti(){
		$hakdep = $this->session->userdata('hakdep');
		$idjabat = $this->session->userdata('id_jabatan');
		// $grp = $this->session->userdata('grp');
		if($this->session->userdata('hakgrp') == "'X'"){
			$grp = "'".$this->session->userdata('grp')."'";
		}else{
			$grp = $this->session->userdata('hakgrp');
		}
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.id as id_jabat from cuti a 
		left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
		left join jeniscuti c on a.jncuti = c.kode
		left join jabatan d on b.jabatan = d.namajabatan
		where if(".$idjabat." <= 4 and b.bagian IN ('SPINNING','NETTING','FINISHING','RING') ,a.appcol=0 and a.approve=0,a.appcol=1 and a.approve=0) and b.bagian in (".$hakdep.") and if(".$idjabat." <= 4, d.id < ".$idjabat." and grp IN (".$grp."),d.id < ".$idjabat.")  order by a.dibuat asc");
		return $query->result_array();
	}
	public function getdepcuti(){
		$hakdep = $this->session->userdata('hakdep');
		$idjabat = $this->session->userdata('id_jabatan');
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.id as id_jabat,b.bagian from cuti a 
		left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
		left join jeniscuti c on a.jncuti = c.kode
		left join jabatan d on b.jabatan = d.namajabatan
		where a.approve=0 and b.bagian in (".$hakdep.") and d.id < ".$idjabat." group by b.bagian order by a.dibuat asc");
		return $query->result_array();
	}
	public function getdatadetailcuti($id){
		$query = $this->db->query("select a.*,b.nama,b.noinduk,f.id as id_jabat,b.jabatan,b.bagian,b.tglmasuk,c.keterangan,d.nama AS nama_setuju,e.nama AS nama_terima,g.nama as nama_cek from cuti a 
		left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
		left join jeniscuti c on a.jncuti = c.kode
		left join mperson d on concat(d.kritkar,d.person_id) = a.disetujui
		left join mperson e on concat(e.kritkar,e.person_id) = a.diterima
		left join mperson g on concat(g.kritkar,g.person_id) = a.cekshift
		left join jabatan f on f.namajabatan = b.jabatan
		where a.id='".$id."' ");
		return $query->row_array();		
	}
	public function hapusdatacuti($id){
		$query = $this->db->query("delete from cuti where id ='".$id."' ");
		return $query;
	}
	public function getdataizin(){
		$hakdep = $this->session->userdata('hakdep');
		$idjabat = $this->session->userdata('id_jabatan');
		// $grp = $this->session->userdata('grp');
		if($this->session->userdata('hakgrp') == "'X'"){
			$grp = "'".$this->session->userdata('grp')."'";
		}else{
			$grp = $this->session->userdata('hakgrp');
		}
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.id as id_jabat from izin a 
		left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
		left join jeniscuti c on a.jnizin = c.kode
		left join jabatan d on b.jabatan = d.namajabatan
		where if(".$idjabat." <= 4 and b.bagian IN ('SPINNING','NETTING','FINISHING','RING'),a.appcol=0 and a.approve=0,a.appcol=1 and a.approve=0) and b.bagian in (".$hakdep.") and if(".$idjabat." <= 4, d.id < ".$idjabat." and b.grp IN (".$grp."),d.id < ".$idjabat.") order by a.dibuat asc");
		return $query->result_array();
	}
	public function getdatadetailizin($id){
		$query = $this->db->query("select a.*,b.nama,b.jabatan,b.bagian,c.keterangan,d.nama AS nama_setuju,e.nama AS nama_terima,f.nama as nama_cek from izin a 
		left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
		left join jeniscuti c on a.jnizin = c.kode
		left join mperson d on concat(d.kritkar,d.person_id) = a.disetujui
		left join mperson e on concat(e.kritkar,e.person_id) = a.diterima
		left join mperson f on concat(f.kritkar,f.person_id) = a.cekshift
		where id='".$id."' ");
		return $query->row_array();
	}
	public function hapusdataizin($id){
		$query = $this->db->query("delete from izin where id ='".$id."' ");
		return $query;
	}
	public function simpancuti(){
		$data= $_POST;
		$data['noinduk'] = $this->session->userdata('noinduk');
		$data['ambil'] = $data['jncuti'];
		$data['jncuti'] = $data['jnsuratx'];
		$data['tgl_khusus'] = tglmysql($data['tglik']);
		$data['dari'] = tglmysql($data['dari']);
		$data['sampai'] = tglmysql($data['sampai']);
		$data['dibuat'] = date("Y-m-d H:i:s");
		$data['kritkar'] = substr($this->session->userdata('kritper'),0,1);
		$data['person_id'] = substr($this->session->userdata('kritper'),1,8);
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
			$data['appcol'] = 1;
		}
		if($this->session->userdata('hakdep') != "'X'"){
			$data['appcol'] = 1;
		}
		unset($data['jnsuratx']);
		unset($data['tglik']);
		unset($data['idx']);
		$this->db->insert('cuti',$data);
		$url = base_url().'apps';
		redirect($url);
	}
	public function updatecuti(){
		$data= $_POST;
		$data['noinduk'] = $this->session->userdata('noinduk');
		$data['ambil'] = $data['jncuti'];
		$data['jncuti'] = $data['jnsuratx'];
		$data['tgl_khusus'] = tglmysql($data['tglik']);
		$data['dari'] = tglmysql($data['dari']);
		$data['sampai'] = tglmysql($data['sampai']);
		$data['dibuat'] = date("Y-m-d H:i:s");
		$data['kritkar'] = substr($this->session->userdata('kritper'),0,1);
		$data['person_id'] = substr($this->session->userdata('kritper'),1,8);
		unset($data['jnsuratx']);
		unset($data['tglik']);
		$dataid = $data['idx'];
		unset($data['idx']);
		$this->db->where('id',$dataid);
		$this->db->update('cuti',$data);
		$url = base_url().'apps';
		redirect($url);
	}
	public function simpanizin(){
		$data = $_POST;
		$data['noinduk'] = $this->session->userdata('noinduk');
		$data['dibuat'] = date("Y-m-d H:i:s"); 
		$data['jnizin'] = $data['jnizinx'];
		$data['tgl_izin'] = tglmysql($data['tgl_izin']);
		$data['kritkar'] = substr($this->session->userdata('kritper'),0,1);
		$data['person_id'] = substr($this->session->userdata('kritper'),1,8);
		$data['appcol'] = 0;
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
			$data['appcol'] = 1;
		}
		if($this->session->userdata('hakdep') != "'X'"){
			$data['appcol'] = 1;
		}
 		unset($data['jnizinx']);
		 unset($data['idx']);
		$this->db->insert('izin',$data);
		$url = base_url().'apps';
		redirect($url);
	}
	public function updateizin(){
		$data = $_POST;
		$data['noinduk'] = $this->session->userdata('noinduk');
		$data['dibuat'] = date("Y-m-d H:i:s"); 
		$data['jnizin'] = $data['jnizinx'];
		$data['tgl_izin'] = tglmysql($data['tgl_izin']);
		$data['kritkar'] = substr($this->session->userdata('kritper'),0,1);
		$data['person_id'] = substr($this->session->userdata('kritper'),1,8);
 		unset($data['jnizinx']);
		$dataid = $data['idx'];
		unset($data['idx']);
		$this->db->where('id',$dataid);
		$this->db->update('izin',$data);
		$url = base_url().'apps';
		redirect($url);
	}
	public function gettask(){
		$arrartask = array();
		$arraycuti = $this->gettaskcuti();
		$arrayizin = $this->gettaskizin();
		$arrayabsen = $this->gettaskabsen();
		return array_merge($arrartask,$arraycuti,$arrayizin,$arrayabsen);
	}
	public function getriwayat(){
		$mdarray = array();
		$cuti = $this->getriwayatcuti();
		$izin = $this->getriwayatizin();
		$absen = $this->getriwayatabsen();
		foreach($cuti as $datacuti){
			$databaru = array(
				'keterangan'=>$datacuti['keterangan'],
				'dibuat'=>$datacuti['dibuat'],
				'approve'=>$datacuti['approve'],
				'appcol'=>$datacuti['appcol'],
				'kunci'=>'cuti/'.$datacuti['id']
			);
			$mdarray[] = $databaru;
		}
		foreach($izin as $dataizin){
			$databaru = array(
				'keterangan'=>$dataizin['keterangan'],
				'dibuat'=>$dataizin['dibuat'],
				'approve'=>$dataizin['approve'],
				'appcol'=>$dataizin['appcol'],
				'kunci'=>'izin/'.$dataizin['id']
			);
			$mdarray[] = $databaru;
		}
		foreach($absen as $dataabsen){
			$databaru = array(
				'keterangan'=>$dataabsen['keterangan'],
				'dibuat'=>$dataabsen['dibuat'],
				'approve'=>$dataabsen['approve'],
				'appcol'=>$dataabsen['appcol'],
				'kunci'=>'absen/'.$dataabsen['id']
			);
			$mdarray[] = $databaru;
		}
		$col = array_column( $mdarray, "dibuat" );
		array_multisort( $col, SORT_DESC, $mdarray );
		return $mdarray;
	}
	public function gethistory(){
		$mdarray = array();
		$cuti = $this->gethistorycuti();
		$izin = $this->gethistoryizin();
		$absen = $this->gethistoryabsen();
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		foreach($cuti as $datacuti){
			$databaru = array(
				'tanggal' => tglmysql(date('d-m-Y',strtotime($datacuti['disetujui_tgl']))),
				'jam' => date('H:i:s',strtotime($datacuti['disetujui_tgl'])),
				'nama' => $datacuti['nama'],
				'jenis' => $datacuti['keterangan'],
				'approve' =>$datacuti['approve'],
				'appcol' =>$datacuti['appcol'],
				'tgl' => $datacuti['disetujui_tgl'],
				'tglcek' => tglmysql(date('d-m-Y',strtotime($datacuti['cekshift_tgl']))),
				'jamcek' => date('H:i:s',strtotime($datacuti['cekshift_tgl']))
			);
			$mdarray[] = $databaru;
		}
		foreach($izin as $dataizin){
			$databaru = array(
				'tanggal' => tglmysql(date('d-m-Y',strtotime($dataizin['disetujui_tgl']))),
				'jam' => date('H:i:s',strtotime($dataizin['disetujui_tgl'])),
				'nama' => $dataizin['nama'],
				'jenis' => $dataizin['keterangan'],
				'approve' =>$dataizin['approve'],
				'appcol' =>$dataizin['appcol'],
				'tgl' => $dataizin['disetujui_tgl'],
				'tglcek' => tglmysql(date('d-m-Y',strtotime($dataizin['cekshift_tgl']))),
				'jamcek' => date('H:i:s',strtotime($dataizin['cekshift_tgl']))
			);
			$mdarray[] = $databaru;
		}
		foreach($absen as $dataabsen){
			$databaru = array(
				'tanggal' => tglmysql(date('d-m-Y',strtotime($dataabsen['disetujui_tgl']))),
				'jam' => date('H:i:s',strtotime($dataabsen['disetujui_tgl'])),
				'nama' => $dataabsen['nama'],
				'jenis' => $dataabsen['keterangan'],
				'approve' =>$dataabsen['approve'],
				'appcol' =>$dataabsen['appcol'],
				'tgl' => $dataabsen['disetujui_tgl'],
				'tglcek' => tglmysql(date('d-m-Y',strtotime($dataabsen['cekshift_tgl']))),
				'jamcek' => date('H:i:s',strtotime($dataabsen['cekshift_tgl']))
			);
			$mdarray[] = $databaru;
		}
		$col = array_column( $mdarray, "tanggal" );
		if(!in_array($this->session->userdata('bagian'),$departemen)){
			$col2 = array_column( $mdarray, "jam" );
		}else{
			if($this->session->userdata('id_jabatan') > 4){
				$col2 = array_column( $mdarray, "jam" );
			}else{
				$col2 = array_column( $mdarray, "jamcek" );
			}
		}
		array_multisort( $col, SORT_DESC, $col2, SORT_ASC, $mdarray );
		return $mdarray;
	}
	function gethistorycuti(){
		$kritper = $this->session->userdata('kritper');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		$idjabat = $this->session->userdata('id_jabatan');
		$grp = $this->session->userdata('grp');
		if(!in_array($this->session->userdata('bagian'),$departemen)){
			$query = $this->db->query("select * from cuti a
			left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
			left join jeniscuti c on a.jncuti = c.kode
			where a.disetujui ='".$kritper."' and a.approve > 0 AND disetujui_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY) ");
		}else{
			$query = $this->db->query("select * from cuti a
			left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
			left join jeniscuti c on a.jncuti = c.kode
			where if(".$idjabat." > 4,a.disetujui ='".$kritper."' and a.approve > 0 AND disetujui_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY),a.cekshift ='".$kritper."' and a.appcol > 0 AND b.grp = '".$grp."' AND a.cekshift_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY)) ");
		}
		return $query->result_array();
	}
	function gethistoryizin(){
		$kritper = $this->session->userdata('kritper');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		$idjabat = $this->session->userdata('id_jabatan');
		$grp = $this->session->userdata('grp');
		if(!in_array($this->session->userdata('bagian'),$departemen)){
			$query = $this->db->query("select * from izin a
			left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
			left join jeniscuti c on a.jnizin = c.kode
			where a.disetujui ='".$kritper."' and a.approve > 0 AND disetujui_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY) ");
		}else{
			$query = $this->db->query("select * from izin a
			left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
			left join jeniscuti c on a.jnizin = c.kode
			where if(".$idjabat." > 4, a.disetujui ='".$kritper."' and a.approve > 0 AND disetujui_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY),a.cekshift ='".$kritper."' and a.appcol > 0 AND b.grp = '".$grp."' AND a.cekshift_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY)) ");
		}
		return $query->result_array();
	}
	function gethistoryabsen(){
		$kritper = $this->session->userdata('kritper');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		$idjabat = $this->session->userdata('id_jabatan');
		$grp = $this->session->userdata('grp');
		if(!in_array($this->session->userdata('bagian'),$departemen)){
			$query = $this->db->query("select * from ketabsen a
			left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
			left join jeniscuti c on a.jnabsen = c.kode
			where a.disetujui ='".$kritper."' and approve > 0 AND disetujui_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY) ");
		}else{
			$query = $this->db->query("select * from ketabsen a
			left join mperson b on concat(b.kritkar,b.person_id) = concat(a.kritkar,a.person_id)
			left join jeniscuti c on a.jnabsen = c.kode
			where if(".$idjabat." > 4, a.disetujui ='".$kritper."' and a.approve > 0 AND disetujui_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY),a.cekshift ='".$kritper."' and a.appcol > 0 AND b.grp = '".$grp."' AND a.cekshift_tgl >= DATE_ADD(NOW(), INTERVAL -7 DAY)) ");
		}
		return $query->result_array();
	}
	function gettaskcuti(){
		$idjabat = $this->session->userdata('id_jabatan');
		$hakdep = $this->session->userdata('hakdep');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if($this->session->userdata('hakgrp') == "'X'"){
			$grp = "'".$this->session->userdata('grp')."'";
		}else{
			$grp = $this->session->userdata('hakgrp');
		}
		$query = $this->db->query("SELECT COUNT(a.jncuti) as cuti FROM cuti a
		LEFT JOIN jeniscuti b ON a.jncuti = b.kode
		LEFT JOIN mperson c ON concat(a.kritkar,a.person_id) = concat(c.kritkar,c.person_id) 
		LEFT JOIN jabatan d on c.jabatan = d.namajabatan
		WHERE if(".$idjabat." <=4 and c.bagian IN ('SPINNING','NETTING','FINISHING','RING') ,a.appcol=0 AND a.approve=0,a.appcol=1 AND a.approve=0) AND c.bagian IN (".$hakdep.") AND if(".$idjabat." <= 4, d.id < ".$idjabat." and c.grp IN (".$grp."),d.id < ".$idjabat.") ");
		if($query->num_rows() == 0){
			return array('cuti'=>'0');
		}else{
			return $query->row_array();
		}
	}
	function getriwayatcuti(){
		$bag = $this->session->userdata('bagian');
		$noinduk = $this->session->userdata('noinduk');
		$krit = substr($this->session->userdata('kritper'),0,1);
		$pers = substr($this->session->userdata('kritper'),1,8);
		$query = $this->db->query("SELECT a.*,b.keterangan,c.bagian,c.jabatan FROM cuti a
		LEFT JOIN jeniscuti b ON a.jncuti=b.kode
		LEFT JOIN mperson c ON concat(a.kritkar,a.person_id) = concat(c.kritkar,c.person_id)
		WHERE c.bagian = '".$bag."' and a.person_id = '".$pers."' and a.kritkar = ".$krit);
		return $query->result_array();
	}
	function gettaskizin(){
		$bag = $this->session->userdata('bagian');
		$idjabat = $this->session->userdata('id_jabatan');
		// $grp = $this->session->userdata('grp');
		if($this->session->userdata('hakgrp') == "'X'"){
			$grp = "'".$this->session->userdata('grp')."'";
		}else{
			$grp = $this->session->userdata('hakgrp');
		}
		$hakdep = $this->session->userdata('hakdep');
		$query = $this->db->query("SELECT COUNT(a.jnizin) as izin FROM izin a
		LEFT JOIN jeniscuti b ON a.jnizin = b.kode
		LEFT JOIN mperson c ON concat(a.kritkar,a.person_id) = concat(c.kritkar,c.person_id) 
		LEFT JOIN jabatan d on c.jabatan = d.namajabatan
		WHERE if(".$idjabat." <=4 and c.bagian IN ('SPINNING','NETTING','FINISHING','RING') ,a.appcol=0 AND a.approve=0,a.appcol=1 AND a.approve=0) AND c.bagian in (".$hakdep.") AND if(".$idjabat." <= 4, d.id < ".$idjabat." and grp IN (".$grp."),d.id < ".$idjabat.")");
		if($query->num_rows() == 0){
			return array('izin'=>'0');
		}else{
			return $query->row_array();
		}
	}
	function getriwayatizin(){
		$bag = $this->session->userdata('bagian');
		$noinduk = $this->session->userdata('noinduk');
		$krit = substr($this->session->userdata('kritper'),0,1);
		$pers = substr($this->session->userdata('kritper'),1,8);
		$query = $this->db->query("SELECT a.*,b.keterangan,c.bagian,c.jabatan FROM izin a
		LEFT JOIN jeniscuti b ON a.jnizin=b.kode
		LEFT JOIN mperson c ON concat(a.kritkar,a.person_id) = concat(c.kritkar,c.person_id) 
		WHERE c.bagian = '".$bag."' and a.person_id = '".$pers."' and a.kritkar = ".$krit);
		return $query->result_array();
	}
	function gettaskabsen(){
		$hakdep = $this->session->userdata('hakdep');
		$bag = $this->session->userdata('bagian');
		$idjabat = $this->session->userdata('id_jabatan');
		// $grp = $this->session->userdata('grp');
		if($this->session->userdata('hakgrp') == "'X'"){
			$grp = "'".$this->session->userdata('grp')."'";
		}else{
			$grp = $this->session->userdata('hakgrp');
		}
		$query = $this->db->query("SELECT COUNT(a.jnabsen) as absen FROM ketabsen a
		LEFT JOIN jeniscuti b ON a.jnabsen = b.kode
		LEFT JOIN mperson c ON concat(a.kritkar,a.person_id) = concat(c.kritkar,c.person_id)
		LEFT JOIN jabatan d on c.jabatan = d.namajabatan
		WHERE if(".$idjabat." <=4 and c.bagian IN ('SPINNING','NETTING','FINISHING','RING') ,a.appcol=0 AND a.approve=0,a.appcol=1 AND a.approve=0) AND c.bagian in (".$hakdep.") AND if(".$idjabat." <= 4, d.id < ".$idjabat." and grp IN (".$grp."),d.id < ".$idjabat.") ");
		if($query->num_rows() == 0){
			return array('absen'=>'0');
		}else{
			return $query->row_array();
		}
	}
	function getriwayatabsen(){
		$bag = $this->session->userdata('bagian');
		$noinduk = $this->session->userdata('noinduk');
		$krit = substr($this->session->userdata('kritper'),0,1);
		$pers = substr($this->session->userdata('kritper'),1,8);
		$query = $this->db->query("SELECT a.*,b.keterangan,c.bagian,c.jabatan FROM ketabsen a
		LEFT JOIN jeniscuti b ON a.jnabsen=b.kode
		LEFT JOIN mperson c ON a.noinduk = c.noinduk
		WHERE c.bagian = '".$bag."' and a.person_id = '".$pers."' and a.kritkar = ".$krit);
		return $query->result_array();
	}
	public function isiapprove($id){
		$noinduk = $this->session->userdata('kritper');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if($jabat >= 5){
			$query = $this->db->query("update cuti set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		}else{
			if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
				$query = $this->db->query("update cuti set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
			}else{
				$query = $this->db->query("update cuti set appcol = 1,cekshift='".$noinduk."',cekshift_tgl = now() where id = '".$id."' ");
			}
		}
		return $query;
	}
	public function isiapproveizin($id){
		$noinduk = $this->session->userdata('kritper');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if($jabat >= 5){
			$query = $this->db->query("update izin set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		}else{
			if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
				$query = $this->db->query("update izin set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
			}else{
				$query = $this->db->query("update izin set appcol = 1,cekshift='".$noinduk."',cekshift_tgl = now() where id = '".$id."' ");
			}
		}
		return $query;
	}
	public function tolakdata($id,$alasan){
		$noinduk = $this->session->userdata('kritper');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if($jabat >= 5){
			$query = $this->db->query("update cuti set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		}else{
			if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
				$query = $this->db->query("update cuti set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
			}else{
				$query = $this->db->query("update cuti set alasan_tolak = '".$alasan."',appcol=3,cekshift='".$noinduk."',cekshift_tgl = now() where id = '".$id."' ");
			}
		}
		return $query;
	}
	public function tolakdataizin($id,$alasan){
		$noinduk = $this->session->userdata('kritper');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if($jabat >= 5){
			$query = $this->db->query("update izin set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		}else{
			if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
				$query = $this->db->query("update izin set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");	
			}else{
				$query = $this->db->query("update izin set alasan_tolak = '".$alasan."',appcol=3,cekshift='".$noinduk."',cekshift_tgl = now() where id = '".$id."' ");
			}
		}
		return $query;
	}
	public function approvesemuadatacuti(){
		$noinduk = $this->session->userdata('kritper');
		$hakdep = $this->session->userdata('hakdep');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if($jabat >= 5){
			$query = $this->db->query("update cuti set approve=1,disetujui='".$noinduk."',disetujui_tgl = now() where approve = 0 and appcol = 1 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
		}else{
			if(!in_array($this->session->userdata('bagian'),$departemen)){
				$query = $this->db->query("update cuti set approve=1,disetujui='".$noinduk."',disetujui_tgl = now() where approve = 0 and appcol = 1 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
			}else{
				$query = $this->db->query("update cuti set appcol=1,cekshift='".$noinduk."',cekshift_tgl = now() where approve = 0 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
			}
		}
		return $query;
	}
	public function approvesemuadataizin(){
		$noinduk = $this->session->userdata('kritper');
		$hakdep = $this->session->userdata('hakdep');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if($jabat >= 5){
			$query = $this->db->query("update izin set approve=1,disetujui='".$noinduk."',disetujui_tgl = now() where approve = 0 and appcol = 1 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
		}else{
			if(!in_array($this->session->userdata('bagian'),$departemen)){
				$query = $this->db->query("update izin set approve=1,disetujui='".$noinduk."',disetujui_tgl = now() where approve = 0 and appcol = 1 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
			}else{
				$query = $this->db->query("update izin set appcol=1,cekshift='".$noinduk."',cekshift_tgl = now() where approve = 0 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
			}
		}
		return $query;
	}
	public function getkaryabsen($tgl){
		$bagian = $this->session->userdata('bagian');
		$query = $this->db->query("SELECT COUNT(*) as jml FROM ketabsen a
		LEFT JOIN mperson b ON concat(a.kritkar,a.person_id) = concat(b.kritkar,b.person_id) 
		WHERE (a.dari <= '".$tgl."' AND a.sampai >= '".$tgl."') AND b.bagian = '".$bagian."'
		AND a.approve = 1");
		return $query;
	}
	public function getkarycuti($tgl){
		$bagian = $this->session->userdata('bagian');
		$query = $this->db->query("SELECT COUNT(*) as jml FROM cuti a
		LEFT JOIN mperson b ON concat(a.kritkar,a.person_id) = concat(b.kritkar,b.person_id) 
		WHERE (a.dari <= '".$tgl."' AND a.sampai >= '".$tgl."')  AND b.bagian = '".$bagian."'
		AND a.approve = 1");
		return $query;
	}
	public function getkarycutiperhari($tgl){
		$bagian = $this->session->userdata('bagian');
		$query = $this->db->query("SELECT * FROM cuti a
		LEFT JOIN mperson b ON concat(a.kritkar,a.person_id) = concat(b.kritkar,b.person_id) 
		LEFT JOIN jeniscuti c ON a.jncuti = c.kode
		WHERE (a.dari <= '".$tgl."' AND a.sampai >= '".$tgl."')  AND b.bagian = '".$bagian."'
		AND a.approve = 1");
		return $query;
	}
	public function getkaryabsenperhari($tgl){
		$bagian = $this->session->userdata('bagian');
		$query = $this->db->query("SELECT * FROM ketabsen a
		LEFT JOIN mperson b ON concat(a.kritkar,a.person_id) = concat(b.kritkar,b.person_id) 
		LEFT JOIN jeniscuti c ON a.jnabsen = c.kode
		WHERE (a.dari <= '".$tgl."' AND a.sampai >= '".$tgl."')  AND b.bagian = '".$bagian."'
		AND a.approve = 1");
		return $query;
	}
}
