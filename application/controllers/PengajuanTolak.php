<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanTolak extends CI_Controller 
{ 
    public function __construct()
    { 
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
        $data['title']="List Pengajuan di Tolak";
        $data['title_box']="List Pengajuan di Tolak ";
        $data['title_header']="Silahkan masukkan NIP untuk mencari user ";

        //get data tabel pengguna
        $this->load->view('top',$data);
        $this->load->view('admin/pengajuan_ditolak/index', $data);
        $this->load->view('boton');
    }


    public function get_data()
    {
        //get data tabel pengguna
        $data['data'] = $this->M_pengajuan->getPengajuanDitolak();
        $this->load->view('admin/pengajuan_ditolak/data_pegwai',$data);
    }
 
     public function formCari()
    {
        $this->load->view('admin/pengajuan_ditolak/formcari');
    } 

    public function cari()
    {
        $data = array();  
        $keyword = $this->input->post('keyword'); 
        $data['data']= $this->M_listpegawai->cari($keyword);   
        $this->load->view('admin/pengajuan_ditolak/hasil_cari',$data);
    }

    public function detail($NIK)
    {
        $data['title']="List Pengajuan di Tolak";
        $data['title_box']="List Pengajuan di Tolak ";
        $data['title_header']="Detail Pegawai ". $NIK;
        $data['title_header2']="Detail Pegawai ". $NIK;

        if ($this->session->userdata('level')=='Admin' || $this->session->userdata('NIK')==$NIK)
        {
            $where = array('NIK' => $NIK );  
            $data['data'] = $this->M_listpegawai->detail($where); 
            $data['gol_ru'] = $this->db->get('tb_golru')->result_array(); 

            if ($data['data']['data_tidak_ditemukan']==TRUE)
            {
                $this->session->set_flashdata('pesan','Data Pegawai Tidak Di Temukan'); 

                $this->load->view('top',$data);
                $this->load->view('admin/pengajuan_ditolak/data_tidak_ditemukan',$data);
                $this->load->view('boton'); 
            }else{
                $this->load->view('top',$data);
                $this->load->view('admin/pengajuan_ditolak/detail',$data);
                $this->load->view('boton'); 
            } 
        }   
    }

   
   public function download($NIK)
   {
       echo "MODUL SEDANG DI BUAT";
   }

}