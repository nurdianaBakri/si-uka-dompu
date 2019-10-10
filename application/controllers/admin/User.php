<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	private $tabel_pengguna;
	public function __construct()
    {
       	$this->tabel_pengguna = "tabel_pengguna";
        parent::__construct();
        ob_start();
        $this->load->library('Session');
        $this->load->helper('cookie');
	 	if($this->session->userdata('logged_in') != TRUE){
            redirect("Login");
        }   
    }

	public function index()
	{ 
		$data['title']="Master Data User";
		$data['title_box']="Data User ";
		$data['title_header']="Silahkan masukkan NIP untuk mencari user ";

		//get data tabel pengguna
		$this->load->view('top',$data);
		$this->load->view('admin/user/index', $data);
	    $this->load->view('boton');
	}


	public function get_data()
	{
		//get data tabel pengguna
		$data['data'] = $this->M_user->getAll();
		$this->load->view('admin/user/tabel_user',$data);
	}
 
	 public function formCari()
    {
    	$this->load->view('admin/user/formcari');
    } 

	public function cari()
	{
		$data = array();  
		$keyword = $this->input->post('keyword'); 
		$data['data']= $this->M_user->cari($keyword);   
	    $this->load->view('admin/user/hasil_cari',$data);
	}

	public function detail($NIK)
	{
		$data['title']="Master Data User";
		$data['title_box']="Data User ";
		$data['title_header']="Detail User ". $NIK;
		$data['title_header2']="Detail User ". $NIK;
		$data['data']= $this->M_user->detail($NIK);   

		if ($data['data']['data_tidak_ditemukan']==TRUE)
		{
			$this->session->set_flashdata('pesan','Data User Tidak Di Temukan');  

			$this->load->view('top',$data);
		    $this->load->view('admin/user/data_tidak_ditemukan',$data);
		    $this->load->view('boton'); 
		}else{
			//get data tabel pengguna
			$this->load->view('top',$data);
			$this->load->view('admin/user/detail', $data);
		    $this->load->view('boton');
		}  
	}

	public function hapus($NIK)
	{  
		$where = array(
			'NIK' => $NIK, 
		);
		$getallData= $this->M_user->delete("pengguna",$where);
        if ($getallData==true) 
        { 
            $getallData= $this->M_user->delete("tb_dbpns",$where);
	        if ($getallData==true) 
	        {
            	$this->session->set_flashdata('pesan', 'Berhasil menghapus data user dan PNS dengan NIK : '.$NIK); 
	        }
	         else
	        {
	            $this->session->set_flashdata('pesan', 'Gagal menghapus data PNS dengan NIK : '.$NIK.', silahkan coba kembali');
	        } 
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Gagal menghapus data user dengan NIK : '.$NIK.', silahkan coba kembali');
        } 
        redirect('admin/User'); 
	}

}