<?php
class M_validator extends CI_Model
{
	public function getdata()
	{
		$bag = $this->session->userdata('bagianvalidator') == '' ? '' : $this->session->userdata('bagianvalidator');
		$grp = $this->session->userdata('grpvalidator') == '' ? '' : $this->session->userdata('grpvalidator');
		if ($bag == '') {
			$tambah = '';
		} else {
			$tambah = 'WHERE bagian = "' . $bag . '" ';
			$tambah .= $grp == '' ? '' : ' AND grp = "' . $grp . '" ';
		}
		$query = $this->db->query("SELECT a.*,b.noinduk as noindukvalid,b.nama as namavalid,c.noinduk as noindukrilis,c.nama as namarilis FROM mperson a
		LEFT JOIN validator b ON b.id = a.valid
		LEFT JOIN validator c ON c.id = a.rilis " . $tambah . "
		ORDER BY bagian,grp");
		return $query;
	}

	public function getbagianmperson()
	{
		$query = $this->db->query("Select bagian from mperson group by bagian order by bagian");
		return $query;
	}
	public function getgrpmperson()
	{
		$query = $this->db->query("Select grp from mperson group by grp order by grp");
		return $query;
	}
	public function getdatavalid($kode)
	{
		$query = $this->db->query("SELECT a.nama,a.bagian,a.jabatan,a.valid,a.rilis,b.noinduk as nikvalid,b.nama AS namavalid,d.jabatan AS jabatanvalid,
		c.noinduk as nikrilis,c.nama AS namarilis,e.jabatan AS jabatanrilis,a.spc FROM mperson a
		LEFT JOIN validator b ON a.valid = b.id
		LEFT JOIN validator c ON a.rilis = c.id
		LEFT JOIN mperson d ON CONCAT(b.kritkar,b.person_id) = CONCAT(d.kritkar,d.person_id)
		LEFT JOIN mperson e ON CONCAT(c.kritkar,c.person_id) = CONCAT(e.kritkar,e.person_id)
		WHERE CONCAT(a.kritkar,a.person_id) = '" . $kode . "'");
		return $query;
	}
	public function getdatavalidator()
	{
		$query = $this->db->query("Select a.*,b.nama,b.bagian,b.grp from validator a
		LEFT JOIN mperson b ON concat(b.kritkar,a.person_id) = concat(b.kritkar,b.person_id)
		ORDER BY b.nama,b.bagian");
		return $query;
	}
	public function simpanvalid($id, $isi)
	{
		$query = $this->db->query("update mperson set valid = $isi where concat(kritkar,person_id)='" . $id . "' ");
		if ($query) {
			$query2 = $this->db->query("select a.*,b.nama as namavalid,c.nama as namarilis from mperson a
			left join validator b on b.id = a.valid 
			left join validator c on c.id = a.rilis
			where concat(a.kritkar,a.person_id)='" . $id . "'");
		}
		return $query2;
	}
	public function delvalid($isi)
	{
		$query = $this->db->query("update mperson set valid = 0 where concat(kritkar,person_id)='" . $isi . "' ");
		if ($query) {
			$query2 = $this->db->query("select * from mperson where concat(kritkar,person_id)='" . $isi . "' ");
		}
		return $query2;
	}
	public function simpanrilis($id, $isi)
	{
		$query = $this->db->query("update mperson set rilis = $isi where concat(kritkar,person_id)='" . $id . "' ");
		if ($query) {
			$query2 = $this->db->query("select a.*,b.nama as namavalid,c.nama as namarilis from mperson a
			left join validator b on b.id = a.valid 
			left join validator c on c.id = a.rilis
			where concat(a.kritkar,a.person_id)='" . $id . "'");
		}
		return $query2;
	}
	public function delrilis($isi)
	{
		$query = $this->db->query("update mperson set rilis = 0 where concat(kritkar,person_id)='" . $isi . "' ");
		if ($query) {
			$query2 = $this->db->query("select * from mperson where concat(kritkar,person_id)='" . $isi . "' ");
		}
		return $query2;
	}
	public function inputspc($data){
		$this->db->where('person_id',$data['id']);
		$query = $this->db->update('mperson',['spc'=>$data['spc']]);
		return $query;
	}
}
