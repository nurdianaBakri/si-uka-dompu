<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kpRegular extends CI_Controller 
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
		$data_balikan['title']="KP Regular";
		$data_balikan['title_box']="Pencarian Pegawai ";
		$data_balikan['title_header']="Silahkan masukkan NIP untuk mencari pegawai ";
		//get data tabel pengguna

		$this->load->view('top',$data_balikan);
	    $this->load->view('kpReguler/index',$data_balikan);
	    $this->load->view('boton');
	}

	public function get_data()
	{
		$data['data'] = $this->M_kpreguler->getAll(); 
	    $this->load->view('kpReguler/tabel_data',$data);
	}

	public function detail($NIK)
	{ 
		$data['title']="KP Regular";
		$data['title_box']="Detail Pegawai ";
		$data['title_header']="Detail Pegawai ".$NIK;
		$data['title_header2']="Detail Pegawai ".$NIK;

		if ($this->session->userdata('level')=='Admin' || $this->session->userdata('NIK')==$NIK)
		{
			$where = array('NIK' => $NIK );  
			$data['data'] = $this->M_kpreguler->detail($where); 
			$data['gol_ru'] = $this->db->get('tb_golru')->result_array(); 

			if ($data['data']['data_tidak_ditemukan']==TRUE)
			{
				$this->session->set_flashdata('pesan','Data Pegawai Tidak Di Temukan'); 

				$this->load->view('top',$data);
			    $this->load->view('kpReguler/detail_data_tidak_ditemukan',$data);
			    $this->load->view('boton'); 
			}else{
				$this->load->view('top',$data);
			    $this->load->view('kpReguler/detail',$data);
			    $this->load->view('boton'); 
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
		$data['data']= $this->M_kpreguler->cari($searcValue);   
	    $this->load->view('kpReguler/hasil_cari',$data);
	}

	public function formUpload($jenis_aksi, $jenis_sk, $NIK)
	{ 
		$title_jenis_sk  = str_replace("_", " ", $jenis_sk); 
		$title_jenis_sk2 = strtoupper($title_jenis_sk);
		
		$data['title']="KP Regular";
		$data['title_box']="Upload/Edit ".$title_jenis_sk2;
		$data['jenis_sk'] =$jenis_sk;
		$data['jenis_aksi'] =$jenis_aksi;
		$data['NIK'] =$NIK;  

		$this->load->view('top',$data);
	    $this->load->view('kpReguler/formUpload',$data);
	    $this->load->view('boton'); 
	}

	public function hapus_sk($jenis_sk, $NIK)
	{
		$path="";
		$nama_table="";
		if ($jenis_sk=="sk_cpns")
		{
			//get nama by nik
			$where = array(
				'NIK' => $NIK 
			);
			$NAMA_FILE = $this->master_model->getById("tb_skcpns",$where)->row_array()['NAMA_FILE'];
			$path  = './assets/files/sk_cpns/'.$NAMA_FILE;

			$nama_table = "tb_skcpns";
		}
		else if ($jenis_sk=="sk_pns")
		{
			//get nama by nik
			$where = array(
				'NIK' => $NIK 
			);
			$NAMA_FILE = $this->master_model->getById("tb_skpns",$where)->row_array()['NAMA_FILE'];
			$path  = './assets/files/sk_pns/'.$NAMA_FILE;

			$nama_table = "tb_skpns";
		}
		else if ($jenis_sk=="sk_pangkat_terakhir") {
			//get nama by nik
			$where = array(
				'NIK' => $NIK 
			);
			$NAMA_FILE = $this->master_model->getById("tb_sk_pangkat_terakhir",$where)->row_array()['NAMA_FILE'];
			$path  = './assets/files/sk_pangkat_terakhir/'.$NAMA_FILE;

			$nama_table = "tb_sk_pangkat_terakhir";
		}

		//HAPUS file SK    
		if (unlink($path))
		{
			//hapus data dari tabel
			$proses_hapus_Data= $this->master_model->delte($nama_table,$where); 
			if ($proses_hapus_Data==true)
			{
				$this->session->set_flashdata('pesan', "Proses hapus SK berhasil");
			}
			else
			{
				$this->session->set_flashdata('pesan', "Proses hapus SK gagal, silahkan coba kembali");
			}
		}
		else
		{
			$this->session->set_flashdata('pesan', "Proses hapus SK gagal, silahkan coba kembali"); 
		}  

		redirect('kpRegular/detail/'.$NIK);
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
    	$this->load->view('kpReguler/form_cari_terpisah');
    }

    public function updatePns()
    { 
    	$NIK = $this->input->post('NIK');
    	$NIP = $this->input->post('NIP');
		$GLRDPN = $this->input->post('GLRDPN');
		$NAMA = $this->input->post('NAMA');
		$GLRBLKG = $this->input->post('GLRBLKG');
		$KD_GOLRU = $this->input->post('KD_GOLRU');
		$JABATAN = $this->input->post('JABATAN');
		// $KD_JABATAN = $this->input->post('KD_JABATAN');
		// $KD_UNKER = $this->input->post('KD_UNKER');

		//update data user 
		$where = array(
			'NIP_BARU' => $NIP, 
		);

		$data = array(
			'GLRDPN' => $GLRDPN,
			'NAMA' => $NAMA,
			'GLRBLKG' => $GLRBLKG, 
		);  

		$data2 = array(
			'KD_GOLRU' => $KD_GOLRU, 
			'JABATAN' => $JABATAN, 
		);

		$update_user = $this->M_user->update('pengguna', $where, $data);
		if ($update_user==FALSE)
		{
			$this->session->set_flashdata('pesan', "Proses update pengguna PNS gagal, silahkan coba kembali");
		} 

		//update data pns 
		$update_pns = $this->M_kpreguler->update('tb_dbpns', $where, $data2);
		if ($update_pns==true)
		{
			$this->session->set_flashdata('pesan', "Proses update data PNS berhasil"); 
		}
		else
		{
			$this->session->set_flashdata('pesan', "Proses update data PNS gagal, silahkan coba kembali"); 
		}
		redirect('kpRegular/detail/'.$NIK);
    } 
	
}
