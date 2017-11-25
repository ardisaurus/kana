<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
	}
	
	public function index()
	{
		$this->load->view('v_beranda');
	}

	public function detail()
	{
		$hr=$this->uri->segment(5);
		if (isset($hr) AND is_numeric($hr) AND $hr>=1 AND $hr<=31) {
		    $data['hariini']=$this->uri->segment(5);
		    $data['bulanini']=$this->uri->segment(4);
		    $data['tahunini']=$this->uri->segment(3);
			date_default_timezone_set('Asia/Jakarta');
			$data['tanggal']=date("Y-m-d");
	        $data['datadivisi']=$this->m_beranda->getdivisi();
	        $data['title']='Divisi';               
	        $data['page']='v_tabelpesertaperdivisi';
			$this->load->view('v_dashboard', $data);
			
		}else{
			$bln=$this->uri->segment(4);
			if (isset($bln) AND is_numeric($bln) AND $bln>=1 AND $bln<=12) {
				$thn=$this->uri->segment(3);
				if (isset($thn)) {
					$cek=$this->db->query("SELECT YEAR(`waktu_mulai`) as `tahun` FROM `peserta` WHERE YEAR(`waktu_mulai`)=$thn union SELECT DISTINCT YEAR(`waktu_selesai`) FROM `peserta` WHERE YEAR(`waktu_selesai`)=$thn");
					;
		            if($cek->num_rows()>0){ 
		        		$data['tahunini']=$this->uri->segment(3);

		            }else{           
		        		redirect("beranda"); 
		            }
				}else{
		        	$data['tahunini']=date("Y");
				}
		        $data['bulanini']=$this->uri->segment(4);
		        $data['title']='Tabel Jumlah Peserta';               
		        $data['page']='v_tabelhari';
		        $data['tahun']=$this->m_beranda->get_all_tahun();
				$this->load->view('v_dashboard', $data);
			}else{
				$thn=$this->uri->segment(3);
				if (isset($thn)) {
					$cek=$this->db->query("SELECT YEAR(`waktu_mulai`) as `tahun` FROM `peserta` WHERE YEAR(`waktu_mulai`)=$thn union SELECT DISTINCT YEAR(`waktu_selesai`) FROM `peserta` WHERE YEAR(`waktu_selesai`)=$thn");
					;
		            if($cek->num_rows()>0){ 
		        		$data['tahunini']=$this->uri->segment(3);

		            }else{           
		        		redirect("beranda"); 
		            }
				}else{
		        	$data['tahunini']=date("Y");
				}
		        $data['title']='Tabel Jumlah Peserta';               
		        $data['page']='v_tabelbulan';
		        $data['tahun']=$this->m_beranda->get_all_tahun();
				$this->load->view('v_dashboard', $data);
			}
		}		
	}

	public function caritahun()
	{
        if(isset($_POST['submit'])){
        	$tahunini=$this->input->post('tahun');
        }else{
        	$tahunini=date("Y");        	
        }
        redirect("beranda/detail/$tahunini");
	}
}