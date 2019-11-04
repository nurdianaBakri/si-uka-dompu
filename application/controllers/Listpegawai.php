<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listpegawai extends CI_Controller 
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
        $data['title']="List Pegawai";
        $data['title_box']="List Pegawai ";
        $data['title_header']="Silahkan masukkan NIP untuk mencari user ";

        //get data tabel pengguna
        $this->load->view('top',$data);
        $this->load->view('admin/listpegawai/index', $data);
        $this->load->view('boton');
    }


    public function get_data()
    {
        //get data tabel pengguna
        $data['data'] = $this->M_listpegawai->getAll();
        $this->load->view('admin/listpegawai/data_pegwai',$data);
    }
 
     public function formCari()
    {
        $this->load->view('admin/listpegawai/formcari');
    } 

    public function cari()
    {
        $data = array();  
        $keyword = $this->input->post('keyword'); 
        $data['data']= $this->M_listpegawai->cari($keyword);   
        $this->load->view('admin/listpegawai/hasil_cari',$data);
    }

    public function detail($NIK)
    {
        $data['title']="List Pegawai";
        $data['title_box']="List Pegawai ";
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
                $this->load->view('admin/listpegawai/data_tidak_ditemukan',$data);
                $this->load->view('boton'); 
            }else{
                $this->load->view('top',$data);
                $this->load->view('admin/listpegawai/detail',$data);
                $this->load->view('boton'); 
            } 
        }   
    }

   
   public function download($NIK)
   {
       echo "MODUL SEDANG DI BUAT";
   }

}