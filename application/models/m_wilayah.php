<?php 
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_wilayah extends CI_Model {
		
		function __construct() {
			parent::__construct();
		}
		
		function get_all_provinsi() {
			$this->db->select('*');
			$this->db->from('wilayah_provinsi');
			$query = $this->db->get();
			
			return $query->result();
		}

		function get_all_lembagapt() {
			$this->db->select('*');
			$this->db->from('pendidikan');
			$this->db->where('jenis', 1);
			$query = $this->db->get();
			
			return $query->result();
		}

		function get_all_lembagasekolah() {
			$this->db->select('*');
			$this->db->from('pendidikan');
			$this->db->where('jenis', 0);
			$query = $this->db->get();
			
			return $query->result();
		}

		function get_all_divisi() {
			$this->db->select('*');
			$this->db->from('divisi');
			$query = $this->db->get();
			
			return $query->result();
		}
	}
?>
