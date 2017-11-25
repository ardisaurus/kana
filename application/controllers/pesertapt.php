<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesertapt extends CI_Controller {

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
	}
	
	public function index()
	{

        if ($this->session->userdata('namapesertapt')) {            
            $this->session->unset_userdata('namapesertapt');
        }
		date_default_timezone_set('Asia/Jakarta');
		$data['tanggal']=date("Y-m-d");  

        $config['base_url']=base_url()."pesertapt/index";
        $config['total_rows']= $this->db->query("SELECT `id_peserta` FROM `peserta` JOIN `pendidikan` WHERE `peserta`.`id_lembaga`=`pendidikan`.`id_lembaga` AND `jenis`=1 ;")->num_rows();
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
        $data['datapeserta']=$this->m_peserta->getpesertapt($config); 

        $data['title']='Peserta dari Perguruan Tinggi';
        $data['page']='v_pesertapt';
        $this->load->view('v_dashboard', $data);
	}

    public function formtambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['tanggal']=date("Y-m-d"); 
        $data['lembaga']=$this->m_wilayah->get_all_lembagapt();
        $data['divisi']=$this->m_wilayah->get_all_divisi();                
        $data['path'] = base_url('assets');

        $data['title']='Tambah Peserta dari Perguruan Tinggi';
        $data['page']='v_tambahpesertapt';
        $this->load->view('v_dashboard', $data);
    }

    function tambah(){
        $this->form_validation->set_rules('nim','NIM','required|trim|min_length[4]|max_length[50]');        
        $this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('lembaga','lembaga','required|trim|callback_cek_lembaga'); 
        $this->form_validation->set_rules('jurusan','jurusan','required|trim|callback_cek_jurusan'); 
        $this->form_validation->set_rules('divisi','divisi','required|trim|callback_cek_divisi'); 
        $this->form_validation->set_rules('pembimbing','pembimbing','required|trim|callback_cek_pembimbing'); 
        $this->form_validation->set_rules('harimulai','hari mulai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('bulanmulai','bulan mulai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('tahunmulai','tahun mulai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('hariselesai','hari selesai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('bulanselesai','bulan selesai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('tahunselesai','tahun selesai','required|trim|callback_cek_tanggal'); 
        if ($this->form_validation->run() == FALSE)
        {   
            $this->formtambah();
        }else{                    
            $data['ni']=$this->input->post('nim');                    
            $data['nama']=strtoupper($this->input->post('nama'));           
            $data['id_lembaga']=$this->input->post('lembaga');                 
            $data['id_jurusan']=$this->input->post('jurusan');                 
            $data['id_divisi']=$this->input->post('divisi');                 
            $data['id_pembimbing']=$this->input->post('pembimbing');                 
            $data['waktu_mulai']=$this->input->post('tahunmulai')."-".$this->input->post('bulanmulai')."-".$this->input->post('harimulai');   
            $data['waktu_selesai']=$this->input->post('tahunselesai')."-".$this->input->post('bulanselesai')."-".$this->input->post('hariselesai'); 
            $this->session->set_flashdata('message',"Peserta berhasil ditambahkan.");
            $this->m_peserta->tambah($data);
            redirect("pesertapt"); 
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

    function cek_lembaga($input){
        if($input=="0"||$input=""){                
            $this->form_validation->set_message('cek_lembaga', 'Pilih jurusan!');
            return FALSE;
        }else{            
            return TRUE;
        }
    }

    function cek_jurusan($input){
        if($input=="0"||$input=""){                
            $this->form_validation->set_message('cek_jurusan', 'Pilih jurusan!');
            return FALSE;
        }else{            
            return TRUE;
        }
    }

    function cek_divisi($input){
        if($input=="0"||$input=""){                
            $this->form_validation->set_message('cek_divisi', 'Pilih divisi!');
            return FALSE;
        }else{            
            return TRUE;
        }
    }

    function cek_pembimbing($input){
        if($input=="0"||$input=""){                
            $this->form_validation->set_message('cek_pembimbing', 'Pilih pembimbing!');
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
            $this->form_validation->set_rules('nama','nama','trim|min_length[4]|max_length[50]|required');
            if ($this->form_validation->run() == FALSE)
            {   
                $this->session->set_flashdata('warning',validation_errors());
                redirect('pesertapt');
            }else{                  
                $namapesertapt=$this->input->post('nama');
                $this->session->set_userdata("namapesertapt", $this->input->post('nama'));
            }
              
        }else{                   
            $namapesertapt=$this->session->userdata('namapesertapt');
        }

        $config['base_url']=base_url()."pesertapt/cari/index";
        $config['total_rows']= $this->db->query("SELECT `id_peserta`, `peserta`.`nama` AS `nama_peserta`, `peserta`.`id_lembaga`, `peserta`.`id_divisi`, `divisi`.`nama` AS `nama_divisi`, `pendidikan`.`nama` AS `nama_pendidikan` FROM `peserta` LEFT JOIN `divisi` ON `peserta`.`id_divisi` = `divisi`.`id_divisi` LEFT JOIN `pendidikan` ON `peserta`.`id_lembaga` = `pendidikan`.`id_lembaga` WHERE `jenis` = 1 AND `peserta`.`nama` LIKE '%".$namapesertapt."%';")->num_rows();
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

        $data['datapeserta']=$this->m_peserta->getcari_pesertapt($namapesertapt, $config); 
        $data['title']='Jenjang Pendidikan';
        $data['page']='v_pesertapt';
        $this->load->view('v_dashboard', $data);
    }

    function add_ajax_jurusan($id_lembaga){
        $query = $this->db->get_where('jurusan',array('id_lembaga'=>$id_lembaga));
        $data = "<option value=''>- Select Jurusan -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_jurusan."'>".$value->nama."</option>";
        }
        echo $data;
    }

    function add_ajax_pembimbing($id_divisi){
        $query = $this->db->get_where('pembimbing',array('id_divisi'=>$id_divisi));
        $data = "<option value=''>- Select Pembimbing -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_pembimbing."'>".$value->nama."</option>";
        }
        echo $data;
    }

	function hapuspeserta(){
    	$data['id_peserta']=$this->input->post('id_peserta');
        $this->m_peserta->hapuspeserta($data);            
        $this->session->set_flashdata('message','Peserta berhasil dihapus.');
        redirect('pesertapt');
    }

    function detail(){
        $id_peserta=$this->uri->segment(3);
        $id=$id_peserta;
        $cek=$this->m_peserta->cekpeserta($id);
        if($cek->num_rows()>0){                      	
        	$data['datapeserta']=$this->m_peserta->getpesertabyid($id);

            $data['lembaga']=$this->m_wilayah->get_all_lembagapt();
            $data['divisi']=$this->m_wilayah->get_all_divisi();                
            $data['path'] = base_url('assets');

            date_default_timezone_set('Asia/Jakarta');
            $data['tanggal']=date("Y-m-d");            
            $data['title']='Detail Peserta';                
            $data['page']='v_detailpeserta';        
            $this->load->view('v_dashboard', $data);
        }else{
        	redirect('pesertapt'); 
        }       
    }

    function ubahpeserta(){
        $this->form_validation->set_rules('ni','Nomor Induk','required|trim|min_length[4]|max_length[50]');         
        $this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[100]');   
        $id=$this->input->post('id_peserta');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("pesertapt/detail/$id");
        }else{
            $id_peserta=$this->input->post('id_peserta');
            $data['ni']=$this->input->post('ni');         
            $data['nama']=$this->input->post('nama');
            $this->m_peserta->ubahpeserta($id_peserta, $data);        
            $this->session->set_flashdata('message','Detail peserta berhasil diubah.');
        	redirect("pesertapt/detail/$id");           
        }
    }

    function ubahpendidikan(){
        $this->form_validation->set_rules('lembaga','lembaga','required|trim|callback_cek_lembaga'); 
        $this->form_validation->set_rules('jurusan','jurusan','required|trim|callback_cek_jurusan');   
        $id=$this->input->post('id_peserta');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("pesertapt/detail/$id");
        }else{
            $id_peserta=$this->input->post('id_peserta');         
            $data['id_lembaga']=$this->input->post('lembaga');                 
            $data['id_jurusan']=$this->input->post('jurusan');
            $this->m_peserta->ubahpeserta($id_peserta, $data);        
            $this->session->set_flashdata('message','Detail peserta berhasil diubah.');
            redirect("pesertapt/detail/$id");           
        }
    }

    function ubahpenempatan(){
        $this->form_validation->set_rules('divisi','divisi','required|trim|callback_cek_divisi'); 
        $this->form_validation->set_rules('pembimbing','pembimbing','required|trim|callback_cek_pembimbing');   
        $id=$this->input->post('id_peserta');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("pesertapt/detail/$id");
        }else{
            $id_peserta=$this->input->post('id_peserta');                
            $data['id_divisi']=$this->input->post('divisi');                 
            $data['id_pembimbing']=$this->input->post('pembimbing'); 
            $this->m_peserta->ubahpeserta($id_peserta, $data);        
            $this->session->set_flashdata('message','Detail peserta berhasil diubah.');
            redirect("pesertapt/detail/$id");           
        }
    }

    function ubahwaktumulai(){        
        $this->form_validation->set_rules('harimulai','hari mulai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('bulanmulai','bulan mulai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('tahunmulai','tahun mulai','required|trim|callback_cek_tanggal');   
        $id=$this->input->post('id_peserta');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("pesertapt/detail/$id");
        }else{
            $id_peserta=$this->input->post('id_peserta');           
            $data['waktu_mulai']=$this->input->post('tahunmulai')."-".$this->input->post('bulanmulai')."-".$this->input->post('harimulai');  
            $this->m_peserta->ubahpeserta($id_peserta, $data);        
            $this->session->set_flashdata('message','Detail peserta berhasil diubah.');
            redirect("pesertapt/detail/$id");           
        }
    }

    function ubahwaktuselesai(){        
        $this->form_validation->set_rules('hariselesai','hari selesai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('bulanselesai','bulan selesai','required|trim|callback_cek_tanggal'); 
        $this->form_validation->set_rules('tahunselesai','tahun selesai','required|trim|callback_cek_tanggal');  
        $id=$this->input->post('id_peserta');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("pesertapt/detail/$id");
        }else{
            $id_peserta=$this->input->post('id_peserta');           
            $data['waktu_selesai']=$this->input->post('tahunselesai')."-".$this->input->post('bulanselesai')."-".$this->input->post('hariselesai'); 
            $this->m_peserta->ubahpeserta($id_peserta, $data);        
            $this->session->set_flashdata('message','Detail peserta berhasil diubah.');
            redirect("pesertapt/detail/$id");           
        }
    }
}