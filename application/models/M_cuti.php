<?php
class M_cuti extends CI_Model {
	public function getdata(){
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("SELECT a.*,b.keterangan AS namacuti FROM cuti a
		LEFT JOIN jeniscuti b ON a.jncuti = b.kode
		WHERE a.noinduk = '".$noinduk."' order by a.dibuat desc ");
		return $query; //->result_array();
	}
	public function getdatacuti(){
		$hakdep = $this->session->userdata('hakdep');
		$idjabat = $this->session->userdata('id_jabatan');
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.id as id_jabat from cuti a 
		left join mperson b on b.noinduk = a.noinduk
		left join jeniscuti c on a.jncuti = c.kode
		left join jabatan d on b.jabatan = d.namajabatan
		where a.approve=0 and b.bagian in (".$hakdep.") and d.id < ".$idjabat."  order by a.dibuat asc");
		return $query->result_array();
	}
	public function getdatadetailcuti($id){
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.nama AS nama_setuju,e.nama AS nama_terima from cuti a 
		left join mperson b on b.noinduk = a.noinduk
		left join jeniscuti c on a.jncuti = c.kode
		left join mperson d on d.noinduk = a.disetujui
		left join mperson e on e.noinduk = a.diterima
		where id='".$id."' ");
		return $query->row_array();		
	}
	public function hapusdatacuti($id){
		$query = $this->db->query("delete from cuti where id ='".$id."' ");
		return $query;
	}
	public function getdataizin(){
		$hakdep = $this->session->userdata('hakdep');
		$idjabat = $this->session->userdata('id_jabatan');
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.id as id_jabat from izin a 
		left join mperson b on b.noinduk = a.noinduk
		left join jeniscuti c on a.jnizin = c.kode
		left join jabatan d on b.jabatan = d.namajabatan
		where a.approve=0 and b.bagian in (".$hakdep.") and d.id < ".$idjabat." order by a.dibuat asc");
		return $query->result_array();
	}
	public function getdatadetailizin($id){
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.nama AS nama_setuju,e.nama AS nama_terima from izin a 
		left join mperson b on b.noinduk = a.noinduk
		left join jeniscuti c on a.jnizin = c.kode
		left join mperson d on d.noinduk = a.disetujui
		left join mperson e on e.noinduk = a.diterima
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
		unset($data['jnsuratx']);
		unset($data['tglik']);
		$this->db->insert('cuti',$data);
		$url = base_url().'apps';
		redirect($url);
	}
	public function simpanizin(){
		$data = $_POST;
		$data['noinduk'] = $this->session->userdata('noinduk');
		$data['dibuat'] = date("Y-m-d H:i:s"); 
		$data['jnizin'] = $data['jnizinx'];
		$data['tgl_izin'] = tglmysql($data['tgl_izin']);
 		unset($data['jnizinx']);
		$this->db->insert('izin',$data);
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
				'kunci'=>'cuti/'.$datacuti['id']
			);
			$mdarray[] = $databaru;
		}
		foreach($izin as $dataizin){
			$databaru = array(
				'keterangan'=>$dataizin['keterangan'],
				'dibuat'=>$dataizin['dibuat'],
				'approve'=>$dataizin['approve'],
				'kunci'=>'izin/'.$dataizin['id']
			);
			$mdarray[] = $databaru;
		}
		foreach($absen as $dataabsen){
			$databaru = array(
				'keterangan'=>$dataabsen['keterangan'],
				'dibuat'=>$dataabsen['dibuat'],
				'approve'=>$dataabsen['approve'],
				'kunci'=>'ketabsen/'.$dataabsen['id']
			);
			$mdarray[] = $databaru;
		}
		$col = array_column( $mdarray, "dibuat" );
		array_multisort( $col, SORT_DESC, $mdarray );
		return $mdarray;
	}
	function gettaskcuti(){
		$bag = $this->session->userdata('bagian');
		$idjabat = $this->session->userdata('id_jabatan');
		$hakdep = $this->session->userdata('hakdep');
		$query = $this->db->query("SELECT COUNT(a.jncuti) as cuti FROM cuti a
		LEFT JOIN jeniscuti b ON a.jncuti = b.kode
		LEFT JOIN mperson c ON a.noinduk = c.noinduk 
		LEFT JOIN jabatan d on c.jabatan = d.namajabatan
		WHERE a.approve=0 AND c.bagian IN (".$hakdep.") AND d.id < ".$idjabat."
		GROUP BY c.bagian ");
		if($query->num_rows() == 0){
			return array('cuti'=>'0');
		}else{
			return $query->row_array();
		}
	}
	function getriwayatcuti(){
		$bag = $this->session->userdata('bagian');
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("SELECT a.*,b.keterangan,c.bagian,c.jabatan FROM cuti a
		LEFT JOIN jeniscuti b ON a.jncuti=b.kode
		LEFT JOIN mperson c ON a.noinduk = c.noinduk
		WHERE c.bagian = '".$bag."' and a.noinduk = '".$noinduk."' ");
		return $query->result_array();
	}
	function gettaskizin(){
		$bag = $this->session->userdata('bagian');
		$idjabat = $this->session->userdata('id_jabatan');
		$query = $this->db->query("SELECT COUNT(a.jnizin) as izin FROM izin a
		LEFT JOIN jeniscuti b ON a.jnizin = b.kode
		LEFT JOIN mperson c ON a.noinduk = c.noinduk 
		LEFT JOIN jabatan d on c.jabatan = d.namajabatan
		WHERE a.approve=0 AND c.bagian = '".$bag."' AND d.id < ".$idjabat."
		GROUP BY c.bagian ");
		if($query->num_rows() == 0){
			return array('izin'=>'0');
		}else{
			return $query->row_array();
		}
	}
	function getriwayatizin(){
		$bag = $this->session->userdata('bagian');
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("SELECT a.*,b.keterangan,c.bagian,c.jabatan FROM izin a
		LEFT JOIN jeniscuti b ON a.jnizin=b.kode
		LEFT JOIN mperson c ON a.noinduk = c.noinduk
		WHERE c.bagian = '".$bag."' and a.noinduk = '".$noinduk."' ");
		return $query->result_array();
	}
	function gettaskabsen(){
		$bag = $this->session->userdata('bagian');
		$idjabat = $this->session->userdata('id_jabatan');
		$query = $this->db->query("SELECT COUNT(a.jnabsen) as absen FROM ketabsen a
		LEFT JOIN jeniscuti b ON a.jnabsen = b.kode
		LEFT JOIN mperson c ON a.noinduk = c.noinduk 
		LEFT JOIN jabatan d on c.jabatan = d.namajabatan
		WHERE a.approve=0 AND c.bagian = '".$bag."' AND d.id < ".$idjabat."
		GROUP BY c.bagian ");
		if($query->num_rows() == 0){
			return array('absen'=>'0');
		}else{
			return $query->row_array();
		}
	}
	function getriwayatabsen(){
		$bag = $this->session->userdata('bagian');
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("SELECT a.*,b.keterangan,c.bagian,c.jabatan FROM ketabsen a
		LEFT JOIN jeniscuti b ON a.jnabsen=b.kode
		LEFT JOIN mperson c ON a.noinduk = c.noinduk
		WHERE c.bagian = '".$bag."' and a.noinduk = '".$noinduk."' ");
		return $query->result_array();
	}
	public function isiapprove($id){
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("update cuti set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		return $query;
	}
	public function isiapproveizin($id){
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("update izin set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		return $query;
	}
	public function tolakdata($id,$alasan){
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("update cuti set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		return $query;
	}
	public function tolakdataizin($id,$alasan){
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("update izin set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		return $query;
	}
}
