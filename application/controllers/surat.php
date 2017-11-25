<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
	}
	
	public function index()
	{

        if ($this->session->userdata('cari_no_surat_keluar')) {            
            $this->session->unset_userdata('cari_no_surat_keluar');
        }
        if ($this->session->userdata('no_surat_keluar')) {            
            $this->session->unset_userdata('no_surat_keluar');
        }
        if ($this->session->userdata('id_surat')) {            
            $this->session->unset_userdata('id_surat');
        }
		date_default_timezone_set('Asia/Jakarta');
		$data['tanggal']=date("Y-m-d");  

        $config['base_url']=base_url()."surat/index";
        $config['total_rows']= $this->db->query("SELECT `id_surat` FROM `surat`;")->num_rows();
        $config['per_page']=10;
        $config['num_links']=3;
        $config['uri_segment']=3;
        $config['next_tag_open'] = '<li>'; $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>'; $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a class="bg-orange">'; $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>'; $config['num_tag_close'] = '</li>';
        $config['first_link']='< Pertama';
        $config['last_link']='Terakhir >';
        $config['next_link']='>';
        $config['prev_link']='<';
        $this->pagination->initialize($config);
        $data['datasurat']=$this->m_surat->getsurat($config); 

        $data['title']='Persuratan';
        $data['page']='v_surat';
        $this->load->view('v_dashboard', $data);
	}

    public function formtambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['tanggal']=date("Y-m-d"); 
        $data['title']='Tambah Surat';
        $data['page']='v_tambahsurat';
        $this->load->view('v_dashboard', $data);
    }

    public function formtambahpeserta()
    { 
        if ($this->session->userdata('no_surat_keluar')) {
            $no_surat_keluar=$this->session->userdata('no_surat_keluar');
            $data['datapeserta']=$this->m_surat->getsuratpeserta($no_surat_keluar);     
            $data['title']='Tambah Peserta Surat';
            $data['page']='v_tambahpesertasurat';
            $this->load->view('v_dashboard', $data);
        }else{
            redirect('surat');
        }
    }

    public function listpeserta()
    { 
        if ($this->session->userdata('no_surat_keluar')) {
            $no_surat_keluar=$this->session->userdata('no_surat_keluar');

            $config['base_url']=base_url()."surat/listpeserta/index";            
            $config['per_page']=10;
            $config['num_links']=3;
            $config['uri_segment']=4;
            $config['next_tag_open'] = '<li>'; $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>'; $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a class="bg-orange">'; $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>'; $config['num_tag_close'] = '</li>';
            $config['first_link']='< Pertama';
            $config['last_link']='Terakhir >';
            $config['next_link']='>';
            $config['prev_link']='<';
            $jum=$this->db->query("SELECT * FROM `suratpeserta`WHERE `no_surat_keluar` = '".$no_surat_keluar."'")->num_rows();
            if ($jum<1) {
                $data['datapeserta']=$this->m_surat->getpeserta($config);
                $config['total_rows']= $this->db->query("SELECT `id_peserta` FROM `peserta`;")->num_rows();
            }else{
                $query = $this->db->query("SELECT `id_lembaga` FROM `suratpeserta` LEFT JOIN `peserta` ON `suratpeserta`.`id_peserta` = `peserta`.`id_peserta` WHERE `no_surat_keluar` = '".$no_surat_keluar."'");
                foreach ($query->result() as $row)
                {
                        $id_lembaga = $row->id_lembaga;
                }
                $data['datapeserta']=$this->m_surat->getpesertabylembaga($config, $id_lembaga);                
            } 
            $this->pagination->initialize($config); 

            $data['title']='Peserta';
            $data['page']='v_pesertasuratlist';
            $this->load->view('v_dashboard', $data);
        }else{
            redirect('surat');
        }
    }

    function tambahpeserta(){                    
            $data['no_surat_keluar']=$this->session->userdata('no_surat_keluar');
            $data['id_peserta']=$this->input->post('id_peserta');            
            $this->m_surat->tambahpeserta($data);
            redirect('surat/formtambahpeserta');
    }

    function hapuspeserta(){                    
            $data['idsuratpeserta']=$this->input->post('idsuratpeserta');            
            $this->m_surat->hapuspeserta($data);
            redirect('surat/formtambahpeserta');
    }

    function tambah(){
        $this->form_validation->set_rules('no_surat_keluar','No surat keluar','required|trim|min_length[4]|max_length[50]|callback_cek_nomor_surat_keluar'); 
        $this->form_validation->set_rules('no_surat_masuk','No surat masuk','required|trim|min_length[4]|max_length[50]'); 
        $this->form_validation->set_rules('kepada','kepada','required|trim|min_length[4]|max_length[50]');  
        $this->form_validation->set_rules('harimasuk','hari masuk','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('bulanmasuk','bulan masuk','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('tahunmasuk','tahun masuk','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('harikeluar','hari keluar','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('bulankeluar','bulan keluar','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('tahunkeluar','tahun keluar','required|trim|callback_cek_tanggal'); 
        if ($this->form_validation->run() == FALSE)
        {   
            $this->formtambah();
        }else{                    
            $data['kepada']=$this->input->post('kepada');   
            $data['no_surat_masuk']=$this->input->post('no_surat_masuk');   
            $data['no_surat_keluar']=$this->input->post('no_surat_keluar');
            $this->session->set_userdata("no_surat_keluar", $this->input->post('no_surat_keluar'));                    
            $data['tgl_surat_masuk']=$this->input->post('tahunmasuk')."-".$this->input->post('bulanmasuk')."-".$this->input->post('harimasuk');   
            $data['tgl_surat_keluar']=$this->input->post('tahunkeluar')."-".$this->input->post('bulankeluar')."-".$this->input->post('harikeluar'); 
            $this->session->set_flashdata('message',"Surat berhasil ditambahkan.");
            $this->m_surat->tambah($data);
            $this->formtambahpeserta();
        }
    }

    function cek_tanggal($input){
        if($input=="0"||$input=""){                
            $this->form_validation->set_message('cek_tanggal', 'Masukan pada bagian tanggal belum lengkap!');
            return FALSE;
        }else{            
            return TRUE;
        }
    }

    function cek_nomor_surat_keluar($input){
        $cek=$this->m_surat->ceknomorsuratkeluar($input);
            if($cek->num_rows()>0){                
                $this->form_validation->set_message('cek_nomor_surat_keluar', 'Nomor surat keluar sudah ada!');
                return FALSE;
            }else{            
                return TRUE;
            }
    }

    public function cari()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['tanggal']=date("Y-m-d");

        if(isset($_POST['submit'])){       
        $this->form_validation->set_rules('cari_no_surat_keluar','No surat keluar','required|trim|min_length[4]|max_length[50]'); 
            if ($this->form_validation->run() == FALSE)
            {   
                $this->session->set_flashdata('warning',validation_errors());
                redirect('surat');
            }else{                  
                $cari_no_surat_keluar=$this->input->post('cari_no_surat_keluar');
                $this->session->set_userdata("cari_no_surat_keluar", $this->input->post('cari_no_surat_keluar'));
            }
              
        }else{                   
            $cari_no_surat_keluar=$this->session->userdata('cari_no_surat_keluar');
        }

        $config['base_url']=base_url()."surat/cari/index";
        $config['total_rows']= $this->db->query("SELECT * FROM `surat` WHERE `no_surat_keluar` LIKE '%".$cari_no_surat_keluar."%' OR `no_surat_masuk` LIKE '%".$cari_no_surat_keluar."%';")->num_rows();
        $config['per_page']=10;
        $config['num_links']=3;
        $config['uri_segment']=4;
        $config['next_tag_open'] = '<li>'; $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>'; $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a class="bg-orange">'; $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>'; $config['num_tag_close'] = '</li>';
        $config['first_link']='< Pertama';
        $config['last_link']='Terakhir >';
        $config['next_link']='>';
        $config['prev_link']='<';
        $this->pagination->initialize($config);

        $data['datasurat']=$this->m_surat->getcari_surat($cari_no_surat_keluar, $config); 
        $data['title']='Surat';
        $data['page']='v_surat';
        $this->load->view('v_dashboard', $data);
    }

	function hapussurat(){
    	$data['id_surat']=$this->input->post('id_surat');
        $this->m_surat->hapussurat($data);            
        $this->session->set_flashdata('message','Surat berhasil dihapus.');
        redirect('surat');
    }

    function detail(){
        $id=$this->uri->segment(3);
        $cek=$this->m_surat->ceksurat($id);
        if($cek->num_rows()>0){                         
            $data['datasurat']=$this->m_surat->getsuratbyid($id);
            $query = $this->db->query("SELECT `no_surat_keluar` FROM `surat` WHERE `id_surat` = '".$id."'");
            foreach ($query->result() as $row){
                    $no_surat_keluar = $row->no_surat_keluar;
                } 
            $this->session->set_userdata("no_surat_keluar", $no_surat_keluar);
            $this->session->set_userdata("id_surat", $id);
            $data['datapeserta']=$this->m_surat->getsuratpeserta($no_surat_keluar);
            date_default_timezone_set('Asia/Jakarta');
            $data['tanggal']=date("Y-m-d");            
            $data['title']='Detail Surat';                
            $data['page']='v_detailsurat';        
            $this->load->view('v_dashboard', $data);
        }else{
            redirect('surat'); 
        }       
    }

    function cetak(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal=date("Ymd-his");
        redirect("cetak/surat/$tanggal");     
    }

    public function listpesertaedit()
    { 
        if ($this->session->userdata('no_surat_keluar')) {
            $no_surat_keluar=$this->session->userdata('no_surat_keluar');

            $config['base_url']=base_url()."surat/listpesertaedit/index";            
            $config['per_page']=10;
            $config['num_links']=3;
            $config['uri_segment']=4;
            $config['next_tag_open'] = '<li>'; $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>'; $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a class="bg-orange">'; $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>'; $config['num_tag_close'] = '</li>';
            $config['first_link']='< Pertama';
            $config['last_link']='Terakhir >';
            $config['next_link']='>';
            $config['prev_link']='<';
            $jum=$this->db->query("SELECT * FROM `suratpeserta`WHERE `no_surat_keluar` = '".$no_surat_keluar."'")->num_rows();
            if ($jum<1) {
                $data['datapeserta']=$this->m_surat->getpeserta($config);
                $config['total_rows']= $this->db->query("SELECT `id_peserta` FROM `peserta`;")->num_rows();
            }else{
                $query = $this->db->query("SELECT `id_lembaga` FROM `suratpeserta` LEFT JOIN `peserta` ON `suratpeserta`.`id_peserta` = `peserta`.`id_peserta` WHERE `no_surat_keluar` = '".$no_surat_keluar."'");
                foreach ($query->result() as $row)
                {
                        $id_lembaga = $row->id_lembaga;
                }
                $data['datapeserta']=$this->m_surat->getpesertabylembaga($config, $id_lembaga);                
            } 
            $this->pagination->initialize($config); 

            $data['title']='Peserta';
            $data['page']='v_pesertasuratlistedit';
            $this->load->view('v_dashboard', $data);
        }else{
            redirect('surat');
        }
    }

    function tambahpesertaedit(){                    
            $data['no_surat_keluar']=$this->session->userdata('no_surat_keluar');
            $id_surat=$this->session->userdata('id_surat');
            $data['id_peserta']=$this->input->post('id_peserta');            
            $this->m_surat->tambahpeserta($data);
            redirect("surat/detail/$id_surat");
    } 

    function hapuspesertaedit(){                    
            $data['idsuratpeserta']=$this->input->post('idsuratpeserta');   
            $id_surat=$this->session->userdata('id_surat');         
            $this->m_surat->hapuspeserta($data);
            redirect("surat/detail/$id_surat");
    }

    function ubahnosuratkeluar(){
        $this->form_validation->set_rules('nosuratkeluar','No surat keluar','required|trim|min_length[4]|max_length[50]|callback_cek_nomor_surat_keluar');   
        $id=$this->input->post('id_surat');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("surat/detail/$id");
        }else{
            $id_surat=$this->input->post('id_surat');
            $data['no_surat_keluar']=$this->input->post('nosuratkeluar');    
            $this->m_surat->ubahsurat($id_surat, $data);        
            $this->session->set_flashdata('message','Nomor surat keluar berhasil diubah.');
            redirect("surat/detail/$id");           
        }
    }

    function ubahnosuratmasuk(){
        $this->form_validation->set_rules('nosuratmasuk','No surat masuk','required|trim|min_length[4]|max_length[50]');    
        $id=$this->input->post('id_surat');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("surat/detail/$id");
        }else{
            $id_surat=$this->input->post('id_surat');
            $data['no_surat_masuk']=$this->input->post('nosuratmasuk');    
            $this->m_surat->ubahsurat($id_surat, $data);        
            $this->session->set_flashdata('message','Nomor surat masuk berhasil diubah.');
            redirect("surat/detail/$id");           
        }
    }

    function ubahkepada(){
        $this->form_validation->set_rules('kepada','kepada','required|trim|min_length[4]|max_length[50]');     
        $id=$this->input->post('id_surat');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("surat/detail/$id");
        }else{
            $id_surat=$this->input->post('id_surat');
            $data['kepada']=$this->input->post('kepada');    
            $this->m_surat->ubahsurat($id_surat, $data);        
            $this->session->set_flashdata('message','Kepada berhasil diubah.');
            redirect("surat/detail/$id");           
        }
    }

    function ubahtglkeluar(){ 
        $this->form_validation->set_rules('harikeluar','hari keluar','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('bulankeluar','bulan keluar','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('tahunkeluar','tahun keluar','required|trim|callback_cek_tanggal');     
        $id=$this->input->post('id_surat');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("surat/detail/$id");
        }else{
            $id_surat=$this->input->post('id_surat');
            $data['tgl_surat_keluar']=$this->input->post('tahunkeluar')."-".$this->input->post('bulankeluar')."-".$this->input->post('harikeluar');
            $this->m_surat->ubahsurat($id_surat, $data);        
            $this->session->set_flashdata('message','Tanggal Surat Keluar berhasil diubah.');
            redirect("surat/detail/$id");           
        }
    }

    function ubahtglmasuk(){  
        $this->form_validation->set_rules('harimasuk','hari masuk','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('bulanmasuk','bulan masuk','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('tahunmasuk','tahun masuk','required|trim|callback_cek_tanggal');      
        $id=$this->input->post('id_surat');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("surat/detail/$id");
        }else{
            $id_surat=$this->input->post('id_surat');
            $data['tgl_surat_masuk']=$this->input->post('tahunmasuk')."-".$this->input->post('bulanmasuk')."-".$this->input->post('harimasuk'); 
            $this->m_surat->ubahsurat($id_surat, $data);        
            $this->session->set_flashdata('message','Tanggal Surat Masuk berhasil diubah.');
            redirect("surat/detail/$id");           
        }
    }
}