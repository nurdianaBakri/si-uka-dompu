<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanBaru extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();

	 	if($this->session->userdata('logged_in') != TRUE){
            redirect("Login/index");
        }
    }

	public function index()
	{
		$data['title']="Pengajuan Baru";
		$data['title_box']="Pencarian Pegawai ";
		$data['title_header']="Silahkan masukkan NIP untuk mencari pegawai ";
		//get data tabel pengguna

		$data['data'] = $this->M_pengajuan->getAll();

		$this->load->view('top',$data);
	    $this->load->view('admin/list_pengajuan/index',$data);
	    $this->load->view('boton');
	}

	public function get_data()
	{
		$data['data'] = $this->M_kpStrukural->getAll(); 
	    $this->load->view('kpStruktural/tabel_data',$data);
	}

	public function detail($jenis_kp, $NIK)
	{ 
		$data['title']="Pengajuan Baru";
		$data['title_box']="Detail Pegawai ";
		$data['title_header']="Detail Pegawai ".$NIK;
		$data['title_header2']="Detail Pegawai ".$NIK;

		if ($this->session->userdata('level')=='Admin' || $this->session->userdata('NIK')==$NIK)
		{
			if ($jenis_kp=="s")
			{
				$jenis_kp="Struktural";
			}
			else if ($jenis_kp=="f") {
				$jenis_kp="Fungsioanal";
			}
			else {
				$jenis_kp="Reguler";
			}

			$where = array(
				'NIK' => $NIK, 
			);  

			$data['data'] = $this->M_kpStrukural->detail($where); 

			$where['jenis_kp'] = $jenis_kp;			
         	$data['pengajuan'] = $this->M_pengajuan->detail($where)->row_array();

			if ($data['data']['data_tidak_ditemukan']==TRUE)
			{
				$this->session->set_flashdata('pesan','Data Pegawai Tidak Di Temukan'); 

				$this->load->view('top',$data);
			    $this->load->view('kpStruktural/detail_data_tidak_ditemukan',$data);
			    $this->load->view('boton'); 
			}else{

				if ($jenis_kp=="Struktural")
				{
					$this->load->view('top',$data);
				    $this->load->view('kpStruktural/detail_pengajuan_struktural',$data);
				    $this->load->view('boton'); 
				}
				else if ($jenis_kp=="Fungsioanal") {
					$this->load->view('top',$data);
				    $this->load->view('kpStruktural/detail_pengajuan_fungsional',$data);
				    $this->load->view('boton'); 
				}
				else {
					$this->load->view('top',$data);
				    $this->load->view('kpStruktural/detail_pengajuan_reguler',$data);
				    $this->load->view('boton'); 
					// $jenis_kp="Reguler";
				} 					
			} 
		}  
	}  


	public function copy_Data()
	{  
		$data = $this->db->query('SELECT * FROM `tb_skpns`')->result();
		foreach ($data as $key) {

			$this->db->where(array('NIP_BARU' => $key->NIP_BARU));  
			$data_input = array(
				'NIK' => $key->NIP_BARU."000" , 
			);

			$this->db->update('tb_skpns',$data_input); 
		}
	}

	public function hapus($NIK)
	{  
		echo("Module sedang di buat ");
	}

	public function searchPns()
	{
		$data = array();  
		$searcValue = $this->input->post('nikAtauNip');
		// $searcValue = "195803211978032007000";
		$data['data']= $this->M_kpStrukural->cari($searcValue);   
	    $this->load->view('kpStruktural/hasil_cari',$data);
	}

	public function formUpload($jenis_aksi, $jenis_sk, $NIK)
	{
		$title_jenis_sk  = str_replace("_", " ", $jenis_sk); 
		$title_jenis_sk2 = strtoupper($title_jenis_sk);

		$data['title']="Pengajuan Baru";
		$data['title_box']="Upload/Edit sds".$title_jenis_sk2;
		$data['jenis_sk'] =$jenis_sk;
		$data['jenis_aksi'] =$jenis_aksi;
		$data['NIK'] =$NIK; 
		$this->load->view('top',$data);
	    $this->load->view('kpStruktural/formUpload',$data);
	    $this->load->view('boton');
	}

	public function upload()
	{
		$jenis_aksi = $this->input->post('jenis_aksi');
		$jenis_sk = $this->input->post('jenis_sk');
		$NIK = $this->input->post('NIK'); 

		//uplod file
		$file_name = $jenis_sk."_".$NIK;
		$data = $this->doConfig($jenis_sk, $file_name);

		if ($data['berhasil']==TRUE)
		{
			$pesan = "";
			//cek file existing or not
			if ($jenis_sk=="sk_pns")
			{
				$pesan = $this->updateInsertSKPNS($NIK, $data['error']['file_name'], "tb_skpns", $jenis_sk);
			}
			else if ($jenis_sk=="sk_cpns")
			{ 
				$pesan =$this->updateInsertSKCPNS($NIK, $data['error']['file_name'], "tb_skcpns", $jenis_sk);
			}
			else if ($jenis_sk=="sk_pangkat_terakhir") {
				$pesan =$this->updateInsertSk_pangkat_terakhir($NIK, $data['error']['file_name'], "tb_sk_pangkat_terakhir", $jenis_sk); 
			}
			else
			{

			}

			$this->session->set_flashdata('pesan', $pesan);
		}
		else
		{
			$this->session->set_flashdata('pesan', $data['error']);
		}

	     redirect('kpRegular/detail/'.$NIK);
    }

    public function updateInsertSk_pangkat_terakhir($NIK, $file_name, $tabel, $jenis_sk)
    {
    	$data_inputan = array();
    	$pesan ="";
    	$cek_query =  FALSE;

    	$where = array(
    		'NIK' => $NIK, 
    	);
		$data_sk_pangkat_terakhir = $this->master_model->getById($tabel, $where);
		if ($data_sk_pangkat_terakhir->num_rows()<=0)
		{
			//insert data baru
			$data_inputan = array(
				'NAMA_FILE' => $file_name, 
				'NIK' => $NIK, 
			);
			$cek_query = $this->db->insert($tabel, $data_inputan);
		}
		else
		{
			$NAMA_FILE = $data_sk_pangkat_terakhir->row()->NAMA_FILE;
			$data_inputan = array(
				'NAMA_FILE' => $file_name, 
			);

			if ($NAMA_FILE==NULL)
			{
				$this->db->where($where);
				$cek_query = $this->db->update($tabel, $data_inputan);
			}
			else
			{
				$pesan = "proses delete file gagal, silahkan coba kembali";
				$cek_query=1;
			}
		}

		//cek apakah proses update/tambah data berhasil
		if ($cek_query==1)
		{
			$pesan = 'Proses update/tambah SK CPNS berhasil';
		}
		else
		{
			$pesan = 'Proses update/tambah SK CPNS gagal, silahkan coba kembali';
		}
		return $pesan;
    }


    public function updateInsertSKCPNS($NIK, $file_name, $tabel, $jenis_sk)
    {
    	$data_inputan = array();
    	$pesan ="";
    	$cek_query =  FALSE;

    	$where = array(
    		'NIK' => $NIK, 
    	);
		$data_sk_pns = $this->master_model->getById($tabel, $where);
		if ($data_sk_pns->num_rows()<=0)
		{
			//insert data baru
			$data_inputan = array(
				'NAMA_FILE' => $file_name, 
				'NIK' => $NIK, 
			);
			$cek_query = $this->db->insert($tabel, $data_inputan);
		}
		else
		{
			$NAMA_FILE = $data_sk_pns->row()->NAMA_FILE;
			$data_inputan = array(
				'NAMA_FILE' => $file_name, 
			);

			if ($NAMA_FILE==NULL)
			{
				$this->db->where($where);
				$cek_query = $this->db->update($tabel, $data_inputan);
			}
			else
			{
				$pesan = "proses delete file gagal, silahkan coba kembali";
				$cek_query=1;
			}
		}

		//cek apakah proses update/tambah data berhasil
		if ($cek_query==1)
		{
			$pesan = 'Proses update/tambah SK CPNS berhasil';
		}
		else
		{
			$pesan = 'Proses update/tambah SK CPNS gagal, silahkan coba kembali';
		}
		return $pesan;
    }

    public function updateInsertSKPNS($NIK, $file_name, $tabel, $jenis_sk)
    {
    	$data_inputan = array();
    	$pesan ="";
    	$cek_query =  FALSE;

    	$whereSkPns = array('NIK' => $NIK);
		$data_sk_pns = $this->master_model->getById($tabel, $whereSkPns);
		if ($data_sk_pns->num_rows()<=0)
		{

			//get data by NIK 
			$NIP_BARU = $this->master_model->getById("tb_dbpns", $whereSkPns)->row_array()['NIP_BARU'];

			//insert data baru
			$data_inputan = array(
				'NIK' => $NIK, 
				'NIP_BARU' => $NIP_BARU, 
				'NAMA_FILE' => $file_name, 
				'TGL_INPUT' => $date = date('m-d-Y h:i:s'), 
			);
			$cek_query = $this->db->insert($tabel, $data_inputan);
		}
		else
		{
			$NAMA_FILE = $data_sk_pns->row()->NAMA_FILE;
			$data_inputan = array(
				'NAMA_FILE' => $file_name,  
				'TGL_INPUT' => $date = date('m-d-Y h:i:s'), 
			);

			if ($NAMA_FILE==NULL)
			{
				$this->db->where('NIK',$NIK);
				$cek_query = $this->db->update($tabel, $data_inputan);
			}
			else
			{
				$pesan = "proses delete file gagal, silahkan coba kembali";
				$cek_query=1;
			}
		}

		//cek apakah proses update/tambah data berhasil
		if ($cek_query==1)
		{
			$pesan = 'Proses update/tambah SK berhasil';
		}
		else
		{
			$pesan = 'Proses update/tambah SK gagal, silahkan coba kembali';
		}
		return $pesan;
    }

    public function doConfig($path, $file_name)
    {
    	$data = array();
    	$config['upload_path']        = 'assets/files/'.$path;
		$config['file_name']          = $file_name.".png";
        $config['allowed_types']      = 'jpg|png|jpeg';
        $config['overwrite'] = TRUE;

		$path = $_FILES['userfile']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $data = array(
                'berhasil' =>FALSE ,
                'error' => $this->upload->display_errors(),
            );
        }
        else
        {
            $upload = $this->upload->data();
            $data = array(
                'berhasil' =>TRUE ,
                'error' => $upload,
            );
        }
        return $data;
    }

    public function formCariPegawai()
    {
    	$this->load->view('kpStruktural/form_cari_terpisah');
    }

    public function tolak($jenis_kp, $nik)
    {
    	$data['title']="Tolak pengajuan";
		$data['title_box']="Detail Pegawai ";
		$data['title_header']="Detail Pegawai ".$nik;
		$data['title_header2']="Detail Pegawai ".$nik;

		$where = array(
			'NIK' => $nik, 
		);  
		$data['data'] = $this->M_kpStrukural->detail($where); 

		$where['jenis_kp'] = $jenis_kp;			
         	$data['pengajuan'] = $this->M_pengajuan->detail($where)->row_array();

		//get data pegawai		
		$this->load->view('top',$data);
	    $this->load->view('kpStruktural/form_tolak_pengajuan_reguler',$data);
	    $this->load->view('boton'); 
    }

    public function do_tolak()
    {    	 
    	 $data = array(
    	 	'alasan' => $this->input->post('alasan'), 
    	 	'status_pengajuan' => "Tolak", 
    	 );
    	$where = array(
            'jenis_kp' => $this->input->post('jenis_kp'), 
            'NIP_BARU' => $this->input->post('nik'), 
        );
        $tolak = $this->M_pengajuan->update($where, $data);

        $this->session->set_flashdata('pesan','Proses penolakan berhasil');
        redirect('PengajuanBaru');
    }

	
}
