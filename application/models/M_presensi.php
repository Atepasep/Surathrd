<?php
class M_presensi extends CI_Model{
	public function tambahpresensi($data){
		$this->db->where('jenis',$data['jenis']);
		$this->db->where('tgl',$data['tgl']);
		$this->db->where('kritkar',$data['kritkar']);
		$this->db->where('person_id',$data['person_id']);
		$query = $this->db->get('tb_presensi');
		if($query->num_rows() > 0){
			$hsail = 2;
		}else{
			$hsail =  $this->db->insert('tb_presensi',$data);
		}
		return $hsail;
	}
	public function getdatapresensi(){
		$this->db->select('*');
		$this->db->from('tb_presensi');
		$this->db->where('concat(tb_presensi.kritkar,tb_presensi.person_id)',$this->session->userdata('kritper'));
		$this->db->where('month(tgl)',$this->session->userdata('blpresensi'));
		$this->db->where('year(tgl)',$this->session->userdata('thpresensi'));
		return $this->db->get();
	}
	public function getgps(){
		return $this->db->get('tb_gps');
	}
	public function setlatitude(){
		return $this->db->get('tb_gps');
	}
	public function simpanlatitude(){
		$data = $_POST;
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('id',$id);
		return $this->db->update('tb_gps',$data);
	}
	public function getbagianuser(){
		$this->db->select('bagian');
		$this->db->from('mperson');
		$this->db->where('idkey',$this->session->userdata('iduser'));
		return $this->db->get();
	}
}
