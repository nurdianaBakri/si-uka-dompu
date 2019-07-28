<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_srtMasuk extends CI_Model
{

    public function getLastIsSurat()
    {
        $this->db->select_max('id_surat', 's');
        $id= $query = $this->db->get('suratmasuk')->row()->s;     
        return $id;
    }

    public function getLastNoAgenda($idUser)
    {
        $kolom = array(
           'id' => $idUser,
        );
        $dataUser = $this->M_user1->detail($kolom);

        //DAPATKAN NO AGENDA DI SERTIAP PRODI/JURUSAN/BAGIAN/SUBBAGIAN 
        $this->db->select_max('noAgenda', 's2');
        $this->db->where('id_fak', $dataUser['id_fak']);
        $this->db->where('id_jur', $dataUser['id_jur']);
        $this->db->where('bagian', $dataUser['bagian']);
        $this->db->where('subagian', $dataUser['subagian']);
        $id2= $query = $this->db->get('suratmasuk')->row()->s2;
        return $id2;
    }

    public function tambah($data) 
    {
        $query = $this->db->insert("suratmasuk", $data);
        if ($query) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function disposisi($data) 
    {
        $datadisposisi = $this->db->insert('disposisi', $data);
        if ($datadisposisi) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getNotif($iduser)
    {
        $pengirim="";
        $dari="";
        $nama_dari="";
        $n_baris="";
        $data = array();

        $query = $this->db->query("SELECT * from disposisi where tujuan = $iduser and status='D'");
        if ($query->num_rows()>0) 
        {
            $baris = 1;
            foreach ($query->result_array() as $row)
            {
                //id_disposisi temp dari tabel detail_siposisi
                $id_disposisi =  $row['id_disposisi'];
                $dari =  $row['dari'];
                $id_surat = $row['id_surat'];


                //get data dari tabel disposisi jika disposisi.id_disposisi = detail_disposisi.id_disposisi
                $query2 = $this->db->query("SELECT * from suratmasuk where id_surat = $id_surat")->row_array();

                //jika data dari tabel disposisi == 1
               /* if ($query2->num_rows()==1) 
                {
                    $row2 = $query2->row_array();*/
                    //noAgenda temp dari tabel disposisi
                    $noAgenda = $query2['noAgenda'];

                    //get data dari tabel user jika detail_disposisi.dari = user.id
                    $query3 = $this->db->query("SELECT * from user where id = $dari");
                    if ($query3->num_rows()==1) 
                    {
                        $row3 = $query3->row_array();
                        $nama_dari = $row3['nama'];
                        $n_baris= $baris++;
                    }
                    else{}
                /*}

                else{}*/

                $data[] = array(
                    'sukses' => 1,
                    'id_disposisi' => $row['id_disposisi'],
                    'tanggal_disposisi' => $row['tanggal_disposisi'],
                    'dari' =>$nama_dari,
                    'id_surat' => $id_surat,
                    'status' => $row['status'],
                    'n_baris' => $n_baris,
                    'noAgenda' => $noAgenda,
                );
            }

            return ($data);    
        }

        //jika output row == 0 
        else 
        {
            $data [] = array(
                'n_baris' => "0",
            );
            return ($data);
        }
    }

    public function getAll($where)
    {
        $data = array();

        //dapatkan data srat keluar
        $this->db->order_by("noAgenda","DESC");
        $query = $this->db->get_where("suratmasuk",$where);
        if ($query->num_rows()<1) 
        {
            $data2[] = array(
                'kosong' => "ya", 
            );
            return $data2;
        }
        else
        {
            foreach ($query->result_array() as $row)
            {
                if ($row['sifat']=='s') 
                {
                    $row['sifat']='Segera';
                }
                else if ($row['sifat']=='b') 
                {
                    $row['sifat']='Biasa';
                }
                else
                {
                    $row['sifat']='Penting';
                }
                $row['tanggalTerima'] = date("d M Y", strtotime($row['tanggalTerima'] ));

                 $n_baris = "n";
                 $data[]= array(
                    'noAgenda' => $row['noAgenda'], 
                    'id_surat' => $row['id_surat'], 
                    'noSurat' => $row['noSurat'], 
                    'tanggalTerima' => $row['tanggalTerima'],
                    'sifat' => $row['sifat'], 
                    'kosong' => "tidak",
                    'hal' => $row['hal'], 
                    'noSurat2' => $row['noAgenda'].'/'.$row['kode_surat'].'/'.date("Y", strtotime($row['tanggalTerima'] )),
                    'tglSurat' => $row['tglSurat'],
                    'id_protokol' => $row['id_protokol'],
                    'deskripsi' => $row['deskripsi'],
                    'id_fak' => $row['id_fak'],
                    'id_jur' => $row['id_jur'],
                    'bagian' => $row['bagian'],
                    'subagian' => $row['subagian'],
                    'kosong' => "tidak", 
                    'n_baris' => $n_baris, 
                );
            }
            return $data;
        }
    }

     public function eksekusi($data)
    {
        $sql = $this->db->query("UPDATE disposisi SET status='ESC' WHERE id_disposisi=$data");
        if ($sql) {
             $data_tujuan = [
                'sukses' => true
            ];
            return $data_tujuan;
        }
        else
        {
            $data_tujuan= [ 
                    'sukses' => false
                ];
            return $data_tujuan;
        }
    }

    public function detailSrt($where)
    {
        $data = array();
        $query = $this->db->get_where("suratmasuk",$where);
        foreach ($query->result_array() as $row)
        {
            $staff = $row['id_protokol']; 
            $query = $this->db->query("select nama from user where id = '$staff'");
            $nama_staff = $query->row();

            if ($row['sifat']=="s") {
                $row['sifat'] = "Segera";
            }

            else if ($row['sifat']=="p") {
                $row['sifat'] = "Penting";
            }

            else if ($row['sifat']=="b") {
                $row['sifat'] = "Biasa";
            }


            $row['staff'] = $nama_staff;
          	$row['tanggalTerima'] = date("d M Y, g:i A", strtotime($row['tanggalTerima'] ));

			$data[] = array(
			   'staff' => $row['staff'], 
                'sifat' => $row['sifat'], 
                'id_surat' => $row['id_surat'], 
                'noAgenda' => $row['noAgenda'], 
                'hal' => $row['hal'], 
                'tglSurat' => $row['tglSurat'], 
                'tanggalTerima' => $row['tanggalTerima'], 
                'asal_surat' => $row['asal_surat'], 
                'noSurat2' => $row['noAgenda'].'/'.$row['kode_surat'].'/'.date("Y", strtotime($row['tanggalTerima'] )),
                'kode_surat' => $row['kode_surat'], 
                'sifat' => $row['sifat'], 
                'noSurat' => $row['noSurat'], //NOMOR SURAT ASLI
                'deskripsi' => $row['deskripsi'], 
                'TglDeadline' => $row['TglDeadline'], 
			);
        }
      
       return $data;
    }

    public function detailDis($where, $idUser)
    {
        $data = array();
        $data_disposisi = array();

        //varible TMP untuk menampung nama_dari, dan nama_tujuan dari table disposisi
        $nama_dari = "";
        $nama_tujuan = "";
        $id_tujuan_terakhir ="";

        //varible TMP untuk menampung data dari dan tujuan  dari table disposisi
        $id_dari = "";
        $id_tujuan = "";
        $id_dari2 = "";
        $id_tujuan2 = "";
        $hak_tujuan = "";
        $jenis_aksi = "";

        $id_surat = "";
        $tanggal_disposisi = "";
        $id_disposisi="";
        $pesan="";
        $status="";

        $this->db->order_by('id_disposisi', 'DESC');
        $query = $this->db->get_where("disposisi",$where);
        foreach ($query->result_array() as $row)
        {
            $tanggal_disposisi = $row['tanggal_disposisi'];
            $status = $row['status'];
            $pesan = $row['pesan'];
            $id_dari =  $row['dari'];
            $id_tujuan = $row['tujuan'];
            $id_disposisi = $row['id_disposisi'];
            $jenis_aksi = $row['jenis_aksi'];
            $id_surat = $row['id_surat'];

            $query2 = $this->db->query("SELECT * FROM user WHERE id = $id_dari")->row_array();
            $nama_dari = $query2['nama_panggilan'];
            $id_dari2 = $query2['id'];

            $query3 = $this->db->query("SELECT * FROM user WHERE id = $id_tujuan")->row_array();
            $nama_tujuan = $query3['nama_panggilan'];
            $id_tujuan2=$query3['id'];


            if ($id_tujuan2==$idUser) 
            {
                //jika yang mengirim == protokol dan yang menerima == protokol
                //penerima tidak bisa mendisposisikan surat
                if ($query2['level']=="protokol" && $query3['level']=="protokol") 
                {
                    $hak_tujuan="false";
                }
                else
                {
                    $hak_tujuan = "true";
                }
            }
            else{
                $hak_tujuan = "false";
            }

            //detail disposisi
            $query3 = $this->db->query("SELECT * FROM detail_disposisi WHERE id_disposisi = $id_disposisi");
            if ($query3->num_rows()>0) 
            {
                foreach ($query3->result_array() as $row2)
                {
                    $sifat = $row2['isi_disposisi'];
                    $query4 = $this->db->query("SELECT * FROM isi_disposisi WHERE id = $sifat")->row_array();

                    $nama_sifat = $query4['nama'];
                    $id_sifat = $query4['id'];

                    $data_sifat[] = array(
                        'id_macro_detdisposisi'=>$row2['id'],
                        'id_sifat'=>$id_sifat,
                        'nama_sifat'=>$nama_sifat,
                        'ada'=>"true",
                    );
                }
            }
            else
            {
                $data_sifat[] = array(
                    'ada'=>"false",
                );
            }

            $data_disposisi[] = array(
                'nama_dari' => $nama_dari, 
                'nama_tujuan' => $nama_tujuan, 
                'id_dari' => $id_dari2,
                'id_tujuan' =>$id_tujuan2,
                'hak_tujuan' =>$hak_tujuan,
                'id_surat'=>$id_surat,
                'id_detail'=>$id_disposisi,
                'jenis_aksi'=>$jenis_aksi,
                'data_sifat'=>$data_sifat,
                'pesan'=>$pesan,
                'tanggal_disposisi'=>date('D, d M h:i A', strtotime($tanggal_disposisi)),
                'status'=>$status,
            );
        }
        return ($data_disposisi);
    }

    public function getDTdisposisi($iduser) 
    {
        $data = array();

        /*$kolom = array(
            'id' => $iduser,
        );
        $dataUser = $this->M_user1->detail($kolom);
        $detail_user = array(
            'id_fak' => $dataUser['id_fak'],
            'id_jur' => $dataUser['id_jur'],
            'bagian' => $dataUser['bagian'],
            'subagian' => $dataUser['subagian'],
        );

        $srt_msk =$this->db->get_where("suratmasuk",$detail_user);
        if ($srt_msk->num_rows()>0) 
        {*/
            $query1 = $this->db->query("SELECT * from disposisi WHERE id_disposisi in (SELECT max(id_disposisi) as id_disposisi from disposisi WHERE tujuan = $iduser or dari = $iduser GROUP by id_surat) order by id_disposisi DESC");
            if ($query1->num_rows()>0) 
            {
                foreach ($query1->result_array() as $row)
                {
                    $id_surat=$row['id_surat'];
                    $tanggal_aksi=$row['tanggal_aksi'];

                    $where = array('id_surat' => $row['id_surat'] );

                    $data_surat = $this->SrtMasukGetOne($where);
                    $sifat2= "";
                    if ($data_surat['sifat']=='s') 
                    {
                        $sifat2 = "Segera";
                    }
                    else if ($data_surat['sifat']=='b') 
                    {
                        $sifat2 = "Biasa";
                    }
                    else
                    {
                        $sifat2 = "Penting";
                    }
                    $noSurat=$data_surat['noSurat'];
                    $sifat=$sifat2;
                    $id_surat=$data_surat['id_surat'];
                    $TglDeadline=$data_surat['TglDeadline'];
                  

                     $n_baris = "n";
                     $data[]= array(
                        'id_surat' => $id_surat, 
                        'noAgenda' => $data_surat['noAgenda'], 
                        'noSurat' => $noSurat, 
                        'sifat' => $sifat, 
                        'noSurat2' => $data_surat['noAgenda'].'/'.$data_surat['kode_surat'].'/'.date("Y", strtotime($data_surat['tanggalTerima'] )),
                        'status' => $row['status'], 
                        'n_baris' => $n_baris,
                        'TglDeadline' => $TglDeadline,
                        'tanggal_aksi' => $tanggal_aksi,
                    );
                }
            }
            else
            {
                $data[]= array(
                    'n_baris' => "0",
                );
            }
        /*}
        else
        {
             $data[]= array(
                'n_baris' => "0",
            );
        }*/
        
       return $data;
    }


    public function SrtMasukGetOne($where)
    {
        $query = $this->db->get_where("suratmasuk",$where);
        $query = $query->result_array();
        if ($query)
        {
            return $query[0];
        }
    }

    public function cekAda($id_surat, $iduser)
    {
        $dataTujuan = $this->M_user1->detail(array('id' =>$iduser ));

        //disposisikan surat ke tujuan
        $kolom = array(
            'id_surat' => $id_surat,
        );
        $row = $this->db->get_where("suratmasuk",$kolom)->row_array();
       
        $data_cek = array(
            'noSurat' => $row['noAgenda']."/".$row['kode_surat']."/".date("Y", strtotime($row['tanggalTerima'] )),
            'sifat' => $row['sifat'], 
            'TglDeadline' => $row['TglDeadline'], 
            'tglSurat' => $row['tglSurat'], 
            'hal' => $row['hal'], 
            'deskripsi' => $row['deskripsi'], 
            'id_fak' => $dataTujuan['id_fak'],
            'id_jur' => $dataTujuan['id_jur'],
            'bagian' => $dataTujuan['bagian'],
            'subagian' => $dataTujuan['subagian'],
        );
        $avaliable = $this->SrtMasukGetOne($data_cek);
        return $avaliable;
    }



    public function updateNotif($data)
    {
        $query = $this->db->get_where("disposisi",$data);
        if ($query->num_rows()>0) 
        {
            foreach ($query->result_array() as $row)
            {
                $id_disposisi = $row['id_disposisi'];
                if ($row['status']=='TERDISPOSISI') 
                {
                    
                }
                else if($row['status']=='ESC')
                {

                }
                else if($row['status']=='DITERIMA')
                {

                }
                else if($row['status']=='DITERUSKAN')
                {

                }
                else
                {
                    $databaru = array(
                    'status' => 'R',
                    );

                    $this->db->where('id_disposisi', $id_disposisi);
                    $query1 = $this->db->update('disposisi', $databaru);
                    if ( $query1) 
                    {
                        return "true";
                    }
                }
            }
        }
        else
        {
            return "false";
        }
        
    }

    public function hapus($data)
    {
        $sukses=0;

        $query = $this->db->get_where("disposisi",$data);
        foreach ($query->result_array() as $row)
        {
            $arrayName = array(
                'id_disposisi' => $row['id_disposisi'], 
            );

            //check num rows
            $query5 = $this->db->get_where("disposisi",$arrayName);
            if ($query->num_rows()>0) 
            {
               $query2 = $this->db->delete("detail_disposisi", $arrayName);
                if ($query2) 
                {
                    $sukses=1;
                }
                else
                {
                    $sukses=0;
                }
            }
            else
            {
                $sukses=1;
            }
           
        }

        if ($sukses==1) 
        {
            $query3 = $this->db->delete("disposisi", $data);
            $query4 = $this->db->delete("suratmasuk", $data);
            if ($query4) 
            {
                $data_tujuan = [
                    'status' => 1
                ];
                return ($data_tujuan);
            }
            else
            {
                $data_tujuan = [
                    'status' => 0
                ];
                return ($data_tujuan);
            }
        }
        else
        {
            $data_tujuan = [
                'status' => 0
            ];
            return ($data_tujuan);
        }
    }

     public function hapus2($data)
    {
        $query4 = $this->db->delete("suratmasuk", $data);
        if ($query4) 
        {
            $query5 = $this->db->get_where("disposisi", $data);
            if ($query5->num_rows()>0) 
            {
                foreach ($query5->result_array() as $key) 
                {
                    # delete data detail disposisi
                    $id_disposisi = $key['id_disposisi'];
                    $this->db->where("id_disposisi", $id_disposisi);
                    $query6 = $this->db->delete("detail_disposisi");
                }
            }

            $query7 = $this->db->delete("disposisi", $data);
            if ($query7) 
            {
                $data_tujuan = [
                    'status' => 1
                ];
                return ($data_tujuan);
            }
        }
        else
        {
            $data_tujuan = [
                'status' => 0
            ];
            return ($data_tujuan);
        }
    }

    public function traceSurat($id_surat)
    {
        $data = array();
        //dapatkan data terakhir 
        $tanggal_aksi = $this->db->query("SELECT max(tanggal_aksi) as tanggal_aksi from disposisi where id_surat=$id_surat")->row_array()['tanggal_aksi'];
     
        $query1 = $this->db->query("SELECT id_disposisi from disposisi where id_surat=$id_surat and tanggal_aksi='$tanggal_aksi'")->result_array();
        foreach ($query1 as $row) 
        {
            $id_disposisi=$row['id_disposisi'];
            $query2 = $this->db->query("SELECT tujuan from disposisi where id_disposisi=$id_disposisi")->row_array()['tujuan'];
            $data_penerima = $this->db->query("SELECT *  from user where id=$query2")->row_array();

            $where = array('id' =>$query2 );
            $asal = $this->M_user1->getAsalUser($where);

            $data[] = array(
                'nama' => $data_penerima['nama'], 
                'fakultas' => $asal['nama_fakultas'], 
                'jurusan' => $asal['nama_jurusan'], 
                'bagian' => $asal['nama_bagian'], 
                'subagian' => $asal['nama_subagian'], 
            );
        }
        return $data;
    }

    public function updateField($fieldName, $value, $id_surat)
    {
        $data = array();
        $text = "UPDATE suratmasuk SET ".$fieldName."='$value' where id_surat = ".$id_surat;

        if ($value!="")
        {
            $query =  $this->db->query($text);
            if ($query) 
            {
                $data = [
                    'status' => 1,
                ]; 
            }
            //jika gagal memasukkan data ke table suratkeluar
            else 
            {
                $data = [
                    'status' => 0,
                    'pesan_eror' => "Gagal merubah data ".$fieldName.", silahkan coba lagi ",
                ]; 
            }
        }
        else{   }
        return $data;
    }

    public function CalonPenerimaDispoisi($idUser)
    {
        $data = array();
        $where = array('id' => $idUser );
        $datauser= $this->M_user1->detail($where);

        $id_fak=$datauser['id_fak'];
        $id_jur=$datauser['id_jur'];
        $bagian=$datauser['bagian'];
        $subagian=$datauser['subagian'];

        //$sql = $this->db->query("SELECT id, nama,level, username, nama_panggilan from user where id in(SELECT id FROM user where id_fak=$id_fak and id_jur=$id_jur and subagian=$subagian and bagian=$bagian AND active=1 and id!=$idUser)")->result_array();

        $sql = $this->db->query("SELECT id, nama,level, username, nama_panggilan from user where id in(SELECT id FROM user where active=1 and id!=$idUser)")->result_array();
        foreach ($sql as $row) 
        {
            $id_user=$row['id'];
            $where = array('id' =>$id_user );
            $asal = $this->M_user1->getAsalUser($where);
            $row['username']=false;
            $row['id_jur']=$asal['nama_jurusan'];
            $row['id_fak']=$asal['nama_fakultas'];
            $row['bagian']=$asal['nama_bagian'];
            $row['subagian']=$asal['nama_subagian'];
            $data[] = $row;
        }

        /*$sql2 = $this->db->query("SELECT id, nama,level, username, nama_panggilan from user where id not in
        (SELECT id FROM user WHERE id_fak=$id_fak and id_jur=$id_jur and subagian=$subagian and bagian=$bagian AND active=1 ) and level in 
            (SELECT id FROM user WHERE level='staff' or level='dosen' or level='protokol' or level='kabag' or level='kasubag')")->result_array();
        foreach ($sql2 as $row) 
        {
            $id_user=$row['id'];
            $where = array('id' =>$id_user );
            $asal = $this->M_user1->getAsalUser($where);
            $row['username']=false;
            $row['id_jur']=$asal['nama_jurusan'];
            $row['id_fak']=$asal['nama_fakultas'];
            $row['bagian']=$asal['nama_bagian'];
            $row['subagian']=$asal['nama_subagian'];
            $data[] = $row;
        }*/
        return ($data);
    }

    ////////////////////////// fungsi di web ///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function webUpdateSrt($data, $id_surat)
    {
        $this->db->where('id_surat',$id_surat);
        $this->db->set($data);
        $q1 = $this->db->update('suratmasuk');

       return $q1;
    }

   
}