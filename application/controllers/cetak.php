<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function surat()
	{// Load all views as normal
		if ($this->session->userdata('no_surat_keluar') && $this->session->userdata('no_surat_keluar')) {
            $id=$this->session->userdata('id_surat');
            $cek=$this->m_surat->ceksurat($id);
            if($cek->num_rows()>0){                         
                $data['datasurat']=$this->m_surat->getsuratbyid($id);
                $no_surat_keluar = $this->session->userdata('no_surat_keluar');
                $data['datapeserta']=$this->m_surat->getcetakpeserta($no_surat_keluar);        
                $this->load->view('v_cetak', $data);
                
		        $tanggal=$this->uri->segment(3);  
		        // Get output html
		        $html = $this->output->get_output();		        
		        // Load library
		        $this->load->library('dompdf_gen');		        
		        // Convert to PDF
		        $this->dompdf->load_html($html);
		        $this->dompdf->render();
		        $this->dompdf->stream("$tanggal.pdf", array("Attachment" => false));
            }else{
                redirect('surat'); 
            }
        }else{
            redirect('surat');            
        }
		
	}
}
