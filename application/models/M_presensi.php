<?php
class M_presensi extends CI_Model{
	public function tambahpresensi($data){
		$hsail =  $this->db->insert('tb_presensi',$data);
		return $hsail;
	}
	public function getdatapresensi(){
		$this->db->select('*');
		$this->db->from('tb_presensi');
		$this->db->where('concat(tb_presensi.kritkar,tb_presensi.person_id)',$this->session->userdata('kritper'));
		return $this->db->get();
	}
}
