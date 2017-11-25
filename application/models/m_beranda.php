<?php 
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_beranda extends CI_Model {
		
		function __construct() {
			parent::__construct();
		}
		
		function get_beranda() {
			$this->db->select('*');
			$this->db->from('wilayah_provinsi');
			$query = $this->db->get();			
			return $query->result();
		}

		function get_all_tahun() {
			$query = $this->db->query("SELECT DISTINCT YEAR(`waktu_mulai`) as tahun FROM `peserta` union SELECT DISTINCT YEAR(`waktu_selesai`) FROM `peserta`;");
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row)
				{
				   $data[]=$row;
				}
				return $data;
			}
		}

	function getdivisi(){
        $this->db->select('id_divisi');		
        $this->db->select('nama');		
		$hasilquery=$this->db->get('divisi');
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}
	}
?>
