<?php
class M_busabsen extends CI_Model{
	public function getdata(){
		$tgl = $this->session->flashdata('tglabsen');
		$query = $this->db->query("SELECT a.*,b.*,c.namashift FROM jemputkar a
		LEFT JOIN absenbis b ON a.idbus = b.idbus 
		LEFT JOIN kodeshift c ON b.kodeshift = c.kode
		WHERE b.tgl = '".tglmysql($tgl)."' order by a.idbus,b.kodeshift ");
		return $query;
	}
	public function getdatadetail($id){
		$tgl = $this->session->flashdata('tglabsen');
		$query = $this->db->query("SELECT a.*,b.*,c.namashift FROM jemputkar a
		LEFT JOIN absenbis b ON a.idbus = b.idbus 
		LEFT JOIN kodeshift c ON b.kodeshift = c.kode
		WHERE b.tgl = '".tglmysql($tgl)."' and b.id = ".$id." order by a.idbus,b.kodeshift ");
		return $query;
	}
	public function getdatashift(){
		$query = $this->db->query("SELECT * FROM kodeshift");
		return $query;
	}
	public function getdatashifttgl(){
		$tgl = $this->session->flashdata('tglabsen');
		$query = $this->db->query("SELECT * FROM kodeshift where kode not in (select kodeshift from absenbis where tgl = '".tglmysql($tgl)."' )");
		return $query;
	}
	public function getdatajemputkar(){
		$query = $this->db->query("SELECT * FROM jemputkar");
		return $query;
	}
	public function adddata($tgl, $idbus,$kodeshift,$masuk,$pulang){
		$nama = getidentitas($this->session->userdata('kritper'));
		$upd = $nama['nama'].date('d-m-Y H:i:s');
		$data = array(
			'idbus' => $idbus,
			'kodeshift' => $kodeshift,
			'masuk' => $masuk,
			'pulang' => $pulang,
			'tgl' => tglmysql($tgl),
			'update' => $upd
			); 
		$query = $this->db->insert('absenbis',$data);
		return $query;
	}
	public function editdata($id,$masuk,$pulang){
		$nama = getidentitas($this->session->userdata('kritper'));
		$upd = $nama['nama'].date('d-m-Y H:i:s');
		$data = array(
			'masuk' => $masuk,
			'pulang' => $pulang,
			'update' => $upd
			); 
		$this->db->where('id',$id);
		$query = $this->db->update('absenbis',$data);
		return $query;
	}
}
