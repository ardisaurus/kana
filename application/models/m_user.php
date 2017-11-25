<?php
class M_user extends CI_Model{

// =========================== Login Section ================================
    function cek($email,$password){
        $this->db->where("email",$email);
        $this->db->where("password",$password);    
        return $this->db->get("user");
    }

    function goPageUser()
	{			
		$email=$this->session->userdata('email');
		$this->db->where('email',$email);
		$query=$this->db->get('user');		
        $this->session->set_userdata('email',$email);
		redirect('beranda/');
	}

	function daftar($data){
		$this->db->insert('user', $data);
		return;
	}

	function cekemail($email){
		$this->db->where('email', $email);
        return $this->db->get("user");
	}

	function getEmail($email)
	{			
        $this->db->where("email",$email);
        $this->db->select('email');
		$query=$this->db->get('user');
		foreach ($query->result() as $user) {
			$email_user=$user->email;
		}
		return $email_user;
	}

// =========================== Login Section End =============================

// =========================== Setting Section ===============================

	function getUser(){		
		$email=$this->session->userdata('email');
        $this->db->select('nama');
        $this->db->select('email');
		$this->db->where('email', $email);
		$hasilquery=$this->db->get('user');
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function ubahAkun($email, $data){
		$this->db->where('email', $email);
		$this->db->update('user', $data);
	}

	function hapusAkun($email){
		$this->db->where('email', $email);
		$this->db->delete('user');
	}

	function admin_num(){
        $this->db->select("email");		
		$hasilquery=$this->db->get("user");
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function ubahEmail($emaillama, $data){
		$this->db->where('email', $emaillama);
		$this->db->update('user', $data);
	}

// =========================== Setting Section End =============================

// =========================== Admin Section End ===============================

	function getpengurus($config){
        $this->db->select('nama');		
        $this->db->select('email');		
		$hasilquery=$this->db->get('user', $config['per_page'], $this->uri->segment(3));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function tambah($data){
		$this->db->insert('user', $data);
		return;
	}

// =========================== Admin Section End ===============================
}
?>