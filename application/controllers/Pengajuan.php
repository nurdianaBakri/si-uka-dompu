<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller 
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
             $this->session->set_flashdata('pesan',"Silahkan login");
            redirect("Login");
        }  
    }

    public function index($NIK)
    { 
        $data['title']="Data Pengajuan Kenaikan Pangkat";
        $data['title_box']="Data Pengajuan Kenaikan Pangkat ";
        $data['title_header']="Silahkan isi form berikut ";

        if ($this->session->userdata('NIK')!= $NIK) {
            $this->session->set_flashdata('pesan',"Anda tidak dapat mengakses data pegawai lain");

            //get data tabel pengguna
            $this->load->view('top',$data);
            $this->load->view('pengajuan/page_invalid', $data);
            $this->load->view('boton');
        }
        else{
            $data['data'] = $this->M_pengajuan->getAll($NIK);

            //get data tabel pengguna
            $this->load->view('top',$data);
            $this->load->view('pengajuan/data', $data);
            $this->load->view('boton'); 
        }  
    }

    public function form()
    { 
        $data['title']="Pengajuan Kenaikan Pangkat";
        $data['title_box']="Pengajuan Kenaikan Pangkat ";
        $data['title_header']="Silahkan isi form berikut ";
        // $data['jenis_kenaikan_pangkat']="Reguler";

        //get data tabel pengguna
        $this->load->view('top',$data);
        $this->load->view('pengajuan/index', $data);
        $this->load->view('boton');
    }

    public function do_pengajuan_fungsional($NIK)
    { 
        $pesan="";
        $data = array();
        // $pesan.= $this->do_pengajuan_fungsional();
            $uploads_dir = './assets/files/pengajuan_fungsional';
            foreach ($_FILES["UserFile2"]["error"] as $key => $error) 
            {
                if ($error == UPLOAD_ERR_OK) 
                {
                    $tmp_name = $_FILES["UserFile2"]["tmp_name"][$key]; 
                    if ($_FILES["UserFile2"]["tmp_name"][$key]!="")
                    {
                        $name="";
                        //sk cpns
                        if ($key==0)
                        {
                            $_FILES["UserFile2"]["name"][$key] = "copy_PAK.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                            $data['copy_pak'] = $name;

                        }
                        else if ($key==1)
                        {
                            $_FILES["UserFile2"]["name"][$key] = "sk_pangkat_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                            $data['sk_pangkat_terakhir'] = $name;

                        } 
                        else if ($key==2)
                        {
                            $_FILES["UserFile2"]["name"][$key] = "ppk_1tahun_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]); 
                            $data['ppk_1thn_terakhir'] = $name;
                        }
                        else
                        {
                            $_FILES["UserFile2"]["name"][$key] = "copy_pendidikan_baru.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                            $data['copy_pendidikan_baru'] = $name;

                        }

                         // $pesan.="<li>KP Struktural : ".$name."</li>";
                        if($_FILES['UserFile2']['tmp_name'][$key] <=2097152)
                        {
                            if (move_uploaded_file($tmp_name, "$uploads_dir/$name"))
                            {
                                $pesan.="<li>KP Struktural : Berhasil mengupload data ".$_FILES["UserFile2"]["name"][$key]."</li>";
                            }
                            else
                            {
                                $pesan.="<li>KP Struktural : Gagal mengupload data ".$_FILES["UserFile2"]["name"][$key]."</li>";
                            }     
                        } 
                        else{
                            $pesan.="<li>KP Reguler : File ".$_FILES["UserFile2"]["name"][$key]." tidak boleh lebih dari 2MB </li>";   
                        }             
                    }  
                }
            }

        //cek apakah nik dengan jenis kp sudah ada 
        $where = array(
            'NIP_BARU' => $NIK, 
            'jenis_kp' => 'Fungsional', 
        );
        $this->db->where($where);
        $cek = $this->db->get('pengajuan');
        if ($cek->num_rows()>0)
        {
            //input data dalam tabel 
             $where = array(
                'jenis_kp' => 'Fungsional', 
                'NIP_BARU' => $NIK, 
            );
            $insert = $this->M_pengajuan->update($where, $data);
            if ($insert==true)
            {
                $pesan.="<li>KP Fungsional : Berhasil memasukkan data kenaikan pangkat Fungsional</li>"; 
            }
            else
            {
                $pesan.="<li>KP Fungsional : Gagal memasukkan data kenaikan pangkat Fungsional</li>";
            } 
        }
        else
        {
            //input data dalam tabel
            $data['NIK'] =$NIK;
            $data['NIP_BARU'] =$NIK;
            $data['jenis_kp'] ="Fungsional";
            $insert = $this->M_pengajuan->add($data);
            if ($insert==true)
            {
                $pesan.="<li>KP Fungsional : Berhasil memasukkan data kenaikan pangkat Fungsional</li>"; 
            }
            else
            {
                $pesan.="<li>KP Fungsional : Gagal memasukkan data kenaikan pangkat Fungsional</li>";
            }   
        } 
        return $pesan;
    }

    public function do_pengajuan_struktural($NIK)
    { 
        $pesan ="";
        $name="";
        $data = array();

        $uploaded_null =false; 
        if ( ($_FILES['UserFile3']['tmp_name'][0]=="") && ($_FILES['UserFile3']['tmp_name'][1]=="") && ($_FILES['UserFile3']['tmp_name'][2]=="") && ($_FILES['UserFile3']['tmp_name'][3]==""))
        {
            $uploaded_null=true;
        }
        else
        {
            $uploads_dir = './assets/files/pengajuan_struktural';
            foreach ($_FILES["UserFile3"]["error"] as $key => $error) 
            {
                if ($error == UPLOAD_ERR_OK) 
                {
                    $tmp_name = $_FILES["UserFile3"]["tmp_name"][$key]; 
                    if ($_FILES["UserFile3"]["tmp_name"][$key]!="")
                    {
                        //sk cpns
                        if ($key==0)
                        {
                            $_FILES["UserFile3"]["name"][$key] = "sk_pangkat_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile3"]["name"][$key]);

                            $data['sk_pangkat_terakhir'] = $name;
                        }
                        else if ($key==1)
                        {
                            $_FILES["UserFile3"]["name"][$key] = "sk_jabatan_lama.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile3"]["name"][$key]);
                            $data['sk_jabatan_lama'] = $name;
                        } 
                        else if ($key==2)
                        {
                            $_FILES["UserFile3"]["name"][$key] = "sk_jabatan_baru.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile3"]["name"][$key]);
                            $data['sk_jabatan_baru'] = $name;
                        }
                        else
                        {
                            $_FILES["UserFile3"]["name"][$key] = "ppk_1tahun_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile3"]["name"][$key]);

                            $data['ppk_1thn_terakhir'] = $name;
                        }

                        // $pesan.="<li>KP Struktural : ".$name."</li>";
                        if($_FILES['UserFile3']['tmp_name'][$key] <=2097152)
                        {
                            if (move_uploaded_file($tmp_name, "$uploads_dir/$name"))
                            {
                                $pesan.="<li>KP Struktural : Berhasil mengupload data ".$_FILES["UserFile3"]["name"][$key]."</li>";
                            }
                            else
                            {
                                $pesan.="<li>KP Struktural : Gagal mengupload data ".$_FILES["UserFile3"]["name"][$key]."</li>";
                            }     
                        } 
                        else{
                            $pesan.="<li>KP Struktural : File ".$_FILES["UserFile3"]["name"][$key]." tidak boleh lebih dari 2MB </li>";   
                        } 
                    }  
                } 
            }

            $uploaded_null = false;
        } 

        if ($uploaded_null==false)
        {
           $where = array(
                'NIP_BARU' => $NIK, 
                'jenis_kp' => 'Struktural', 
            );
            $this->db->where($where);
            $cek = $this->db->get('pengajuan');
            if ($cek->num_rows()>0)
            {
                //input data dalam tabel 
                 $where = array(
                    'jenis_kp' => 'Struktural', 
                    'NIP_BARU' => $NIK, 
                );
                $insert = $this->M_pengajuan->update($where, $data);
                if ($insert==true)
                {
                    $pesan.="<li>KP Struktural : Berhasil memasukkan data kenaikan pangkat Struktural</li>"; 
                }
                else
                {
                    $pesan.="<li>KP Struktural : Gagal memasukkan data kenaikan pangkat Struktural</li>";
                } 
            }
            else
            {
                 //input data dalam tabel
                $data['NIK'] =$NIK;
                $data['NIP_BARU'] =$NIK;
                $data['jenis_kp'] ="Struktural";
                $insert = $this->M_pengajuan->add($data);
                if ($insert==true)
                {
                    $pesan.="<li>KP Struktural : Berhasil memasukkan data kenaikan pangkat Struktural</li>"; 
                }
                else
                {
                    $pesan.="<li>KP Struktural : Gagal memasukkan data kenaikan pangkat Struktural</li>";
                } 
            }   
        } 
                
        return $pesan;
    }
 

    public function do_pengajuan()
    {
        //generate id pengajuan   
        $data = array();
        $pesan="";
        $NIK = $this->input->post('nik'); 

        //proses pengajuan KP REGLER       
        $uploaded_null =false; 
        if ( ($_FILES['UserFile']['tmp_name'][0]=="") && ($_FILES['UserFile']['tmp_name'][1]=="") && ($_FILES['UserFile']['tmp_name'][2]=="") && ($_FILES['UserFile']['tmp_name'][3]==""))
        {
            $uploaded_null=true;
        }
        else
        {
            $uploads_dir = './assets/files/pengajuan_reguler';
            foreach ($_FILES["UserFile"]["error"] as $key => $error) 
            {
                if ($error == UPLOAD_ERR_OK) 
                {
                    $tmp_name = $_FILES["UserFile"]["tmp_name"][$key]; 

                    //jika file tidak kosong
                    if ($_FILES["UserFile"]["tmp_name"][$key]!="")
                    {
                        $name="";
                        //sk cpns
                        if ($key==0)
                        {   
                            // user has uploaded a file
                            $_FILES["UserFile"]["name"][$key] = "sk_cpns.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile"]["name"][$key]);
                            $data['sk_cpns'] = $name; 
                        }
                        else if ($key==1)
                        { 
                             $_FILES["UserFile"]["name"][$key] = "sk_pns.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile"]["name"][$key]);
                            $data['sk_pns'] = $name; 
                        } 
                        else if ($key==2)
                        { 
                            $_FILES["UserFile"]["name"][$key] = "sk_kp_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile"]["name"][$key]);
                            $data['sk_kp_terakhir'] = $name; 
                        }
                        else
                        { 
                            $_FILES["UserFile"]["name"][$key] = "ppk_1tahun_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile"]["name"][$key]);
                            $data['ppk_1thn_terakhir'] = $name; 
                        }

                        if($_FILES['UserFile']['tmp_name'][$key] <=2097152)
                        {
                            if (move_uploaded_file($tmp_name, "$uploads_dir/$name"))
                            {
                                $pesan.="<li>KP Reguler : Berhasil mengupload data ".$_FILES["UserFile"]["name"][$key]."</li>";
                            }
                            else
                            {
                                $pesan.="<li>KP Reguler : Gagal mengupload data ".$_FILES["UserFile"]["name"][$key]."</li>";
                            }  
                        }  
                        else
                        {

                            $pesan.="<li>KP Reguler : File ".$_FILES["UserFile2"]["name"][$key]." tidak boleh lebih dari 2MB </li>"; 
                        } 
                    }
                       
                }
            } 
            $uploaded_null = false;
        }

        if ($uploaded_null==false)
        {
            //cek apakah nik dengan jenis kp sudah ada 
            $where = array(
                'NIP_BARU' => $NIK, 
                'jenis_kp' => 'Reguler', 
            );
            $this->db->where($where);
            $cek = $this->db->get('pengajuan');
            if ($cek->num_rows()>0)
            {
                //input data dalam tabel 
                 $where = array(
                    'jenis_kp' => 'Reguler', 
                    'NIP_BARU' => $NIK, 
                );
                $insert = $this->M_pengajuan->update($where, $data);
                if ($insert==TRUE)
                {
                    $pesan.="<li>KP Regular : Berhasil memasukkan data kenaikan pangkat Regular</li>"; 
                }
                else
                {
                    $pesan.="<li>KP Regular : Gagal memasukkan data kenaikan pangkat Regular</li>";
                } 
            }
            else
            {
                //jika tidak ada iput  
                $data['NIK'] =$NIK;
                $data['NIP_BARU'] =$NIK;
                $data['jenis_kp'] ="Reguler";
                $insert = $this->M_pengajuan->add($data);
                if ($insert==TRUE)
                {
                    $pesan.="<li>KP Reguler : Berhasil memasukkan data kenaikan pangkat Reguler</li>"; 
                }
                else
                {
                    $pesan.="<li>KP Reguler : Gagal memasukkan data kenaikan pangkat Reguler</li>";
                }     
            }  
        }  
           
        //
        if ( ($_FILES['UserFile2']['tmp_name'][0]=="") && ($_FILES['UserFile2']['tmp_name'][1]=="") && ($_FILES['UserFile2']['tmp_name'][2]=="") && ($_FILES['UserFile2']['tmp_name'][3]==""))
        { }  else {
            $pesan.=$this->do_pengajuan_fungsional($NIK);  
        } 

        //jangan upload
       if ( ($_FILES['UserFile3']['tmp_name'][0]=="") && ($_FILES['UserFile3']['tmp_name'][1]=="") && ($_FILES['UserFile3']['tmp_name'][2]=="") && ($_FILES['UserFile3']['tmp_name'][3]==""))
        { } else {

            // $pesan.="yay!";
            $pesan.=$this->do_pengajuan_struktural($NIK);  
        } 

        $this->session->set_flashdata('pesan',$pesan);
        redirect('Pengajuan/index/'.$NIK);
    } 

    public function do_update_pengajuan_struktural()
    { 
        $data = array();
        $pesan="";
        $NIK = $this->input->post('nik');

        // $pesan.=$this->do_pengajuan_struktural();
        $uploads_dir = './assets/files/pengajuan_struktural'; 
 
        if ( ($_FILES['UserFile2']['tmp_name'][0]=="") && ($_FILES['UserFile2']['tmp_name'][1]=="") && ($_FILES['UserFile2']['tmp_name'][2]=="") && ($_FILES['UserFile2']['tmp_name'][3]==""))
        { 
            $pesan.="<li>KP Struktural : Anda tidak merubah data pengajuan Struktural dalam bentuk apapun</li>";
        }
        else
        {
            foreach ($_FILES["UserFile2"]["error"] as $key => $error) 
            {
                if ($error == UPLOAD_ERR_OK) 
                {
                    $tmp_name = $_FILES["UserFile2"]["tmp_name"][$key]; 
                    if ($_FILES["UserFile2"]["tmp_name"][$key]!="")
                    {
                        //sk cpns
                        if ($key==0)
                        {  
                            $_FILES["UserFile2"]["name"][$key] = "sk_pangkat_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);

                            $data['sk_pangkat_terakhir'] = $name;
                        }
                        else if ($key==1)
                        {
                            $_FILES["UserFile2"]["name"][$key] = "sk_jabatan_lama.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                            $data['sk_jabatan_lama'] = $name;
                        } 
                        else if ($key==2)
                        {
                            $_FILES["UserFile2"]["name"][$key] = "sk_jabatan_baru.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                            $data['sk_jabatan_baru'] = $name;
                        }
                        else
                        {
                            $_FILES["UserFile2"]["name"][$key] = "ppk_1tahun_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);

                            $data['ppk_1thn_terakhir'] = $name;
                        }

                        // $pesan.="<li>KP Struktural : ".$name."</li>";
                        if($_FILES['UserFile2']['tmp_name'][$key] <=2097152)
                        {
                            if (move_uploaded_file($tmp_name, "$uploads_dir/$name"))
                            {
                                $pesan.="<li>KP Struktural : Berhasil mengupload data ".$_FILES["UserFile2"]["name"][$key]."</li>";
                            }
                            else
                            {
                                $pesan.="<li>KP Struktural : Gagal mengupload data ".$_FILES["UserFile2"]["name"][$key]."</li>";
                            }     
                        } 
                        else{
                            $pesan.="<li>KP Struktural : File ".$_FILES["UserFile2"]["name"][$key]." tidak boleh lebih dari 2MB </li>";   
                        } 
                        
                    }  
                } 
            }

            //input data dalam tabel 
             $where = array(
                'jenis_kp' => $this->input->post('jenis_kp'), 
                'NIP_BARU' => $NIK, 
            );
            $insert = $this->M_pengajuan->update($where, $data);
            if ($insert==TRUE)
            {
                $pesan.="<li>KP Struktural : Berhasil memasukkan data kenaikan pangkat Struktural</li>"; 
            }
            else
            {
                $pesan.="<li>KP Struktural : Gagal memasukkan data kenaikan pangkat Struktural</li>";
            } 
        }  
            
        $this->session->set_flashdata('pesan',$pesan); 
        redirect('PengajuanBaru/detail/s/'.$NIK);
    }

    public function do_update_pengajuan_fungsional()
    { 
        $data = array();
        $pesan="";
        $NIK = $this->input->post('nik');

        // $pesan.= $this->do_pengajuan_fungsional();
        $uploads_dir = './assets/files/pengajuan_fungsional';

        if ( ($_FILES['UserFile2']['tmp_name'][0]=="") && ($_FILES['UserFile2']['tmp_name'][1]=="") && ($_FILES['UserFile2']['tmp_name'][2]=="") && ($_FILES['UserFile2']['tmp_name'][3]==""))
        { 
            $pesan.="<li>KP Fungsional : Anda tidak merubah data pengajuan Fungsional dalam bentuk apapun</li>";
        }
        else
        {
            foreach ($_FILES["UserFile2"]["error"] as $key => $error) 
            {
                if ($error == UPLOAD_ERR_OK) 
                {
                    $tmp_name = $_FILES["UserFile2"]["tmp_name"][$key]; 
                    if ($_FILES["UserFile2"]["tmp_name"][$key]!="")
                    {
                        $name="";
                        //sk cpns
                        if ($key==0)
                        {
                            $_FILES["UserFile2"]["name"][$key] = "copy_PAK.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                            $data['copy_pak'] = $name;

                        }
                        else if ($key==1)
                        {
                            $_FILES["UserFile2"]["name"][$key] = "sk_pangkat_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                            $data['sk_pangkat_terakhir'] = $name;

                        } 
                        else if ($key==2)
                        {
                            $_FILES["UserFile2"]["name"][$key] = "ppk_1tahun_terakhir.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);

                            $data['ppk_1thn_terakhir'] = $name;
                        }
                        else
                        {
                            $_FILES["UserFile2"]["name"][$key] = "copy_pendidikan_baru.pdf";
                            $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                            $data['copy_pendidikan_baru'] = $name;

                        }

                        if($_FILES['UserFile2']['tmp_name'][$key] <=2097152)
                        {
                            if (move_uploaded_file($tmp_name, "$uploads_dir/$name"))
                            {
                                $pesan.="<li>KP Fungsional : Berhasil mengupload data ".$_FILES["UserFile2"]["name"][$key]."</li>";
                            }
                            else
                            {
                                $pesan.="<li>KP Fungsional : Gagal mengupload data ".$_FILES["UserFile2"]["name"][$key]."</li>";
                            }     
                        } 
                        else{
                            $pesan.="<li>KP Fungsional : File ".$_FILES["UserFile2"]["name"][$key]." tidak boleh lebih dari 2MB </li>";   
                        }                
                    }  
                }
            }

            //input data dalam tabel
             $where = array(
                'jenis_kp' => $this->input->post('jenis_kp'), 
                'NIP_BARU' => $NIK, 
            );
            $insert = $this->M_pengajuan->update($where, $data);
            if ($insert==TRUE)
            {
                $pesan.="<li>KP Fungsional : Berhasil memasukkan data kenaikan pangkat Fungsional</li>"; 
            }
            else
            {
                $pesan.="<li>KP Fungsional : Gagal memasukkan data kenaikan pangkat Fungsional</li>";
            } 
        }

                
        $this->session->set_flashdata('pesan',$pesan); 

        redirect('PengajuanBaru/detail/f/'.$NIK);
    }

    public function do_update_pengajuan_reguler()
    {
        $data = array();
        $pesan="";
        $NIK = $this->input->post('nik'); 
        $update=false;

        //proses pengajuan KP REGLER    
        $uploads_dir = './assets/files/pengajuan_reguler';


        if ( ($_FILES['UserFile2']['tmp_name'][0]=="") && ($_FILES['UserFile2']['tmp_name'][1]=="") && ($_FILES['UserFile2']['tmp_name'][2]=="") && ($_FILES['UserFile2']['tmp_name'][3]==""))
        { 
            $pesan.="<li>KP Regular : Anda tidak merubah data pengajuan Regular dalam bentuk apapun</li>";
        }
        else
        {
            foreach ($_FILES["UserFile2"]["error"] as $key => $error) 
            { 
                if ($error == UPLOAD_ERR_OK) 
                {
                    $tmp_name = $_FILES["UserFile2"]["tmp_name"][$key];  
                    $size = $_FILES['UserFile2']['size'][$key];

                    //jika semua file kosong 
                    if (($_FILES["UserFile2"]["tmp_name"][0]=="") && ($_FILES["UserFile2"]["tmp_name"][1]=="") && ($_FILES["UserFile2"]["tmp_name"][2]=="") && ($_FILES["UserFile2"]["tmp_name"][3]==""))
                    {
                        $update = false;
                    }
                    else
                    {
                        //jika file tidak kosong
                        if ($_FILES["UserFile2"]["tmp_name"][$key]!="")
                        { 
                            if(($_FILES['UserFile2']['size'][$key] <=2097152) && $_FILES['UserFile2']['size'][$key] >0)
                            { 
                                //SET NAME FILE  
                                $name="";
                                //sk cpns
                                if ($key==0)
                                {
                                    $_FILES["UserFile2"]["name"][$key] = "sk_cpns.pdf";
                                    $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                                    $data['sk_cpns'] = $name;

                                }
                                else if ($key==1)
                                {
                                    $_FILES["UserFile2"]["name"][$key] = "sk_pns.pdf";
                                    $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                                    $data['sk_pns'] = $name;
                                } 
                                else if ($key==2)
                                {
                                    $_FILES["UserFile2"]["name"][$key] = "sk_kp_terakhir.pdf";
                                    $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                                    $data['sk_kp_terakhir'] = $name;
                                }
                                else
                                {
                                    $_FILES["UserFile2"]["name"][$key] = "ppk_1tahun_terakhir.pdf";
                                    $name = basename($NIK."_".$_FILES["UserFile2"]["name"][$key]);
                                    $data['ppk_1thn_terakhir'] = $name;
                                }

                                if (move_uploaded_file($tmp_name, "$uploads_dir/$name"))
                                {
                                    $pesan.="<li>KP Reguler : Berhasil mengupload file ".$_FILES["UserFile2"]["name"][$key]."</li>";
                                }
                                else
                                {
                                    $pesan.="<li>KP Reguler : Gagal mengupload file ".$_FILES["UserFile2"]["name"][$key]."</li>";
                                }   
                            } 
                            else{  
                                $pesan.="<li>KP Reguler : File ".$_FILES["UserFile2"]["name"][$key]." tidak boleh lebih dari 2MB atau 0 KB </li>";   
                            }     
                              
                        }

                        $update =true;
                    } 
                }
            }


            $where = array();
            $insert=false;
            if ($update==true)
            {
                $jenis_kp = $this->input->post('jenis_kp');
                $where = array(
                    'jenis_kp' => $jenis_kp, 
                    'NIP_BARU' => $NIK, 
                );

                $insert = $this->M_pengajuan->update($where, $data);
                if ($insert==TRUE)
                {
                    $pesan.="<li>KP Reguler : Berhasil mengubah data kenaikan pangkat Reguler</li>"; 
                }
                else
                {
                    $pesan.="<li>KP Reguler : Gagal mengubah data kenaikan pangkat Reguler</li>";
                }    
            }  
            else
            {
                $pesan="KP Reguler : Anda tidak mengubah data pengajuan";
            }    
        } 
        
        $this->session->set_flashdata('pesan',$pesan);  
        // var_dump($update);
        redirect('PengajuanBaru/detail/r/'.$NIK);
    }

     public function detail_user($id_pengajuan)
    {
        $data['title']="Detail Pengajuan Kenaikan Pangkat";
        $data['title_box']="Detail Pengajuan Kenaikan Pangkat ";
        $data['title_header']="Detail pengajuan ";
        $data['title_header2']="Detail pengajuan ";

        //cek session 
        $cek = $this->M_pengajuan->detail( array('id_pengajuan' => $id_pengajuan ));

        //cek apakah $id_peangajuan ada di DB
        if ($cek->num_rows()>0)
        {
            # cek apakah user yang mengakses berhak mengakses data ?
            if ($this->session->userdata('NIK')!= $cek->row_array()['NIK']) {
 
                $this->session->set_flashdata('pesan','Data pengajuan Tidak Di Temukan'); 
                $this->load->view('top',$data);
                $this->load->view('pengajuan/page_invalid',$data);
                $this->load->view('boton');
            }
            else
            {
                $data['data'] = $cek->row_array(); 

                $where = array('NIK' => $this->session->userdata('NIK') );   
                $data['data_pegawai'] = $this->M_kpreguler->detail($where); 

                $data['gol_ru'] = $this->db->get('tb_golru')->result_array();   
                $this->load->view('top',$data);
                $this->load->view('pengajuan/detail',$data);
                $this->load->view('boton'); 
            }
        }
        else
        {
            $this->session->set_flashdata('pesan','Data pengajuan Tidak Di Temukan'); 
            
            $this->load->view('top',$data);
            $this->load->view('pengajuan/page_invalid',$data);
            $this->load->view('boton');
        } 
    }

    public function detail($jenis_kp, $id_pengajuan)
    {
        $data['title']="Detail Pengajuan Kenaikan Pangkat";
        $data['title_box']="Detail Pengajuan Kenaikan Pangkat ";
        $data['title_header']="Detail pengajuan ";
        $data['title_header2']="Detail pengajuan ";

        //cek session 
        $cek = $this->M_pengajuan->detail( array('id_pengajuan' => $id_pengajuan ));

        //cek apakah $id_peangajuan ada di DB
        if ($cek->num_rows()>0)
        {
            # cek apakah user yang mengakses berhak mengakses data ?
            if ($this->session->userdata('NIK')!= $cek->row_array()['NIK']) {

                // var_dump($this->session->userdata('NIK'));
                // var_dump($cek->row_array()['NIK']);
                $this->session->set_flashdata('pesan','Data pengajuan Tidak Di Temukan'); 

                $this->load->view('top',$data);
                $this->load->view('pengajuan/page_invalid',$data);
                $this->load->view('boton');
            }
            else
            {
                $data['data'] = $cek->row_array(); 
                $this->load->view('top',$data);
                $this->load->view('pengajuan/detail',$data);
                $this->load->view('boton'); 
            }
        }
        else
        {
            $this->session->set_flashdata('pesan','Data pengajuan Tidak Di Temukan'); 
            
            $this->load->view('top',$data);
            $this->load->view('pengajuan/page_invalid',$data);
            $this->load->view('boton');
        } 
    }

    public function page_invalid()
    {
        $data['title']="Page Invalid";
        $data['title_box']="Page Invalid ";
        $data['title_header']="Page Invalid";
        $data['title_header2']="Page Invalid";
        $this->load->view('top',$data);
        $this->load->view('pengajuan/page_invalid',$data);
        $this->load->view('boton');
    }

   public function download($NIK)
   {
       echo "MODUL SEDANG DI BUAT";
   }

}