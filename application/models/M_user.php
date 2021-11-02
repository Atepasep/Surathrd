<?php
class M_user extends CI_Model {
	public function getuser(){
		$sql = "select * from usergou";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getdetailuser($id){
		// $sql = $this->db->where('idkey',$id)->get('mperson');
		$sql = $this->db->query("SELECT a.*,b.id AS id_jabat FROM mperson a 
		left join jabatan b ON a.jabatan = b.namajabatan  
		where a.idkey='".$id."' ");
		return $sql->row_array();
	}

	public function getmodul($id=0){
		$sql = "select modul from usergou where id = '".$id."' ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$que = $query->row()->modul;
		}else{
			$que = str_repeat('0', 20);
		}
		return $que;
	}

	public function getmoduldept($id=0){
		$sql = "select moduldept from usergou where id = '".$id."' ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$que = $query->row()->moduldept;
		}else{
			$que = str_repeat('0', 20);
		}
		return $que;
	}

	public function getmodulso($id=0){
		$sql = "select modulsto from usergou where id = '".$id."' ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$que = $query->row()->modulsto;
		}else{
			$que = str_repeat('0', 20);
		}
		return $que;
	}

	public function getnamadep($dep){
		$sql = "select * from dept where dept_id = '".$dep."' ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$que = $query->row()->departemen;
		}else{
			$que = '';
		}
		return $que;
	}

	public function getdepartemen(){
		$query = $this->db->query("select * from dept");
		return $query->result_array();
	}

	public function hapususer($id){
		$temp = $this->db->query("select foto from usergou where id ='".$id."' ")->row();
		if(!empty($temp->foto)){
			$fotodulu = FCPATH."assets/page/images/user/".$temp->foto;
			unlink($fotodulu);
		}
		$sql = "delete from usergou where id = '".$id."' ";
		$query = $this->db->query($sql);
		$url = base_url().'user';
		redirect($url);
	}

	public function simpanuser(){
		$data = $_POST;
		$data['namauser'] = $this->generatePasswordHash(strtoupper($data['username']));
		$data['moduldept'] = str_repeat('0', 20);
		$data['modul'] = str_repeat('0', 20);
		for($l=1;$l<=10;$l++){
			$dek = $this->input->post('cekmoe'.$l);
			if((int)$dek==1){
				$data['modul'] = substr_replace($data['modul'], '1', $l-1,1);
			}
			unset($data['cekmoe'.$l]);
		}
		for($x=1;$x<=18;$x++){
			$cek = $this->input->post('cekmod'.$x);
			if((int)$cek==1){
				$data['moduldept'] = substr_replace($data['moduldept'], '1', $x-1,1);
			}
			unset($data['cekmod'.$x]);
		}
		for($x=1;$x<=15;$x++){
			$cek = $this->input->post('cekso'.$x);
			if((int)$cek==1){
				$data['modulsto'] = substr_replace($data['modulsto'], '1', $x-1,1);
			}
			unset($data['cekso'.$x]);
		}
		$data['foto'] = $this->uploadLogo();
		unset($data['old_logo']);
		unset($data['file_path']);
		$sql = $this->db->query("select * from usergou where namauser = '".$data['namauser']."' and namauser != '' ");
		$usersudahada = $sql->row();
		$usersudahada = is_object($usersudahada) ? $sql->username : FALSE;
		if($usersudahada){
			$this->session->set_flashdata('info','usersudahada');
			$url = base_url().'user';
			redirect($url);
		}
		$data['stat'] = $data['level'];
		$data['pass'] = $this->generatePasswordHash(strtoupper($data['password']));
		$data['nama'] = strtoupper($data['nama']);
		$data['bagian'] = strtoupper($data['bagian']);
		$data['jabatan'] = strtoupper($data['jabatan']);
		unset($data['level']);
		unset($data['username']);
		unset($data['password']);
		$this->db->insert('usergou',$data);
		$url = base_url().'user';
		redirect($url);
	}

	public function updateuser($id=0){
		$data = $_POST;
		$foto = $this->input->post('file_path');
		if(!empty($foto)){
			$fotodulu = FCPATH."assets/page/images/user/".$data['old_logo'];
			unlink($fotodulu);
			$data['foto'] = $this->uploadLogo();
		}else{
			$data['foto'] = $data['old_logo'];
		}
		$data['namauser'] = $this->generatePasswordHash(strtoupper($data['username']));
		$data['moduldept'] = str_repeat('0', 20);
		$data['modul'] = str_repeat('0', 20);
		$data['modulsto'] = str_repeat('0', 20);
		for($l=1;$l<=10;$l++){
			$dek = $this->input->post('cekmoe'.$l);
			if((int)$dek==1){
				$data['modul'] = substr_replace($data['modul'], '1', $l-1,1);
			}
			unset($data['cekmoe'.$l]);
		}
		for($x=1;$x<=18;$x++){
			$cek = $this->input->post('cekmod'.$x);
			if((int)$cek==1){
				$data['moduldept'] = substr_replace($data['moduldept'], '1', $x-1,1);
			}
			unset($data['cekmod'.$x]);
		}
		for($x=1;$x<=15;$x++){
			$cek = $this->input->post('cekso'.$x);
			if((int)$cek==1){
				$data['modulsto'] = substr_replace($data['modulsto'], '1', $x-1,1);
			}
			unset($data['cekso'.$x]);
		}
		unset($data['old_logo']);
		unset($data['file_path']);
		$data['stat'] = $data['level'];
		$data['pass'] = $this->generatePasswordHash(strtoupper($data['password']));
		$data['nama'] = strtoupper($data['nama']);
		$data['bagian'] = strtoupper($data['bagian']);
		$data['jabatan'] = strtoupper($data['jabatan']);
		unset($data['level']);
		unset($data['username']);
		unset($data['password']);
		$this->db->where('id',$id);
		$this->db->update('usergou',$data);
		$url = base_url().'user';
		redirect($url);
	}


	public function uploadLogo(){
		$this->load->library('upload');
		$this->uploadConfig = array(
			'upload_path' => LOK_UPLOAD_USER,
			'allowed_types' => 'gif|jpg|jpeg|png',
			'max_size' => max_upload() * 1024,
		);
		// Adakah berkas yang disertakan?
		$adaBerkas = $_FILES['logo']['name'];
		if (empty($adaBerkas))
		{
			return NULL;
		}
		$uploadData = NULL;
		$this->upload->initialize($this->uploadConfig);
		if ($this->upload->do_upload('logo'))
		{
			$uploadData = $this->upload->data();
			$namaFileUnik = $uploadData['file_name'];
			$fileRenamed = rename(
				$this->uploadConfig['upload_path'].$uploadData['file_name'],
				$this->uploadConfig['upload_path'].$namaFileUnik
			);
			$uploadData['file_name'] = $fileRenamed ? $namaFileUnik : $uploadData['file_name'];
		}
		else
		{
			$_SESSION['success'] = -1;
			$tidakupload = $this->upload->display_errors(NULL, NULL);
			$this->session->set_flashdata('msg',$tidakupload);
		}
		return (!empty($uploadData)) ? $uploadData['file_name'] : NULL;
	}

	private function generatePasswordHash($string)
	{
		// Pastikan inputnya adalah string
		$string = is_string($string) ? $string : strval($string);
		$pwHash = encrypto($string);

		return $pwHash;
	}
}
