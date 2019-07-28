<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_srtKeluar extends CI_Model
{
     public function getLastIsSurat()
    {
        $this->db->select_max('id_surat', 's');
        $id= $query = $this->db->get('suratkeluar')->row()->s;     
        return $id;
    }
    

    public function getPenerimaWeb($id_surat, $idUser)
    {
        $data = array();

        //cek tujuan surat

        $this->db->where('id_surat', $id_surat);
        $data_surat= $this->db->get('suratkeluar')->row_array();

        //if tujuan surat == diluar unram
        if ($data_surat['tujuan']!='-') 
        {
            $data[] = array(
                'nama' => $data_surat['tujuan'],
                'id' => 0,
            );
        }
        else
        {
            $where = array('id' => $idUser );
            $datauser= $this->M_user1->detail($where);

            $id_fak=$datauser['id_fak'];
            $id_jur=$datauser['id_jur'];
            $bagian=$datauser['bagian'];
            $subagian=$datauser['subagian'];

            $sql2 = $this->db->query("SELECT id, nama, username,nama_panggilan from user where id in 
                (SELECT tujuan from disposisi where dari IN
                (SELECT tujuan FROM disposisi where id_surat in 
                    (SELECT id_surat FROM suratmasuk where id_surat_asal =$id_surat) AND dari in 
                        (SELECT id from user where id in
                            (SELECT id FROM user where id_fak=$id_fak and id_jur=$id_jur and subagian=$subagian and bagian=$bagian AND active=1) and level='protokol') ) )")->result_array();
            foreach ($sql2 as $key ) 
            {
                $key['username']=true;
                $data[]=$key;
            }
        }
            
        return ($data);
    }

    public function getUserPenerima($id_surat)
    {
        $data = array();
        $sql1 = $this->db->query("SELECT distinct(id_surat_asal) as id_surat_asal  FROM suratmasuk where id_surat_asal=$id_surat")->row_array()['id_surat_asal'];
        $sql = $this->db->query("SELECT id, nama, username, nama_panggilan FROM user where active=1")->result_array();
        foreach ($sql as $row) 
        {
            $sql2 = $this->db->query("SELECT tujuan FROM disposisi where id_surat=$sql1")->result_array();
            foreach ($sql2 as $key) 
            {
                $idUser=$key['tujuan'];
                if ($row['id']==$idUser) 
                {
                    $row['username']=true;
                }
                else
                {
                    $row['username']=false;
                }
                $data[] = $row;
            }
        }
        return ($data);
    }

    public function getUserCalonPenerima($idUser)
    {
        $data = array();
        $where = array('id' => $idUser );
        $datauser= $this->M_user1->detail($where);

        $id_fak=$datauser['id_fak'];
        $id_jur=$datauser['id_jur'];
        $bagian=$datauser['bagian'];
        $subagian=$datauser['subagian'];
        
        $query = $this->db->query("SELECT id, nama,level, username, nama_panggilan from user where id not in (SELECT id FROM user WHERE level='staff' or level='dosen' or level='protokol' or level='kabag' or level='kasubag' or level='superadmin') and id not in (SELECT id FROM user where id_fak=$id_fak and id_jur=$id_jur and subagian=$subagian and bagian=$bagian AND active=1)");

        foreach ($query->result_array() as $row)
        {
            $id_user=$row['id'];
            $data_penerima = $this->db->query("SELECT *  from user where id=$id_user")->row_array();

            $id_jur=$data_penerima['id_jur'];
            $id_fk=$data_penerima['id_fak'];
            $id_bagian=$data_penerima['bagian'];
            $id_subbagian=$data_penerima['subagian'];

            $nama_jurusan = $this->db->query("SELECT *  from jurusan where id_jur=$id_jur")->row_array()['nama_jur'];
            $nama_fakultas = $this->db->query("SELECT *  from fakultas where id_fk=$id_fk")->row_array()['nama_fk'];
            $nama_bagian = $this->db->query("SELECT *  from bagiansubag where id=$id_bagian  and jenis='bagian'")->row_array()['nama'];
            $nama_subagian = $this->db->query("SELECT *  from bagiansubag where id=$id_subbagian  and jenis='subbagian'")->row_array()['nama'];

            
            if ($nama_fakultas=="") 
            {
                $nama_fakultas="-";
            }
            if ($nama_jurusan=="") 
            {
                $nama_jurusan="-";
            }
            if ($nama_bagian=="") 
            {
                $nama_bagian="-";
            }
            if ($nama_subagian=="") 
            {
                $nama_subagian="-";
            }

            $row['username']=false;
            $row['id_jur']=$nama_jurusan;
            $row['id_fak']=$nama_fakultas;
            $row['bagian']=$nama_bagian;
            $row['subagian']=$nama_subagian;
            $data[] = $row;
        }
        return ($data);
    }

    public function getAll($where)
    {
        $data = array();

        //dapatkan data srat keluar
        $query = $this->db->get_where("suratkeluar",$where);
        //$query = $this->db->get("suratkeluar");
        if ($query->num_rows()>0)
        {
            foreach ($query->result_array() as $row)
            {
                $noAgenda = $row['noAgenda'];
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

                $row['insertedDate'] = date("d M Y, g:i A", strtotime($row['insertedDate'] ));
                /*$data[]= $row;*/
                $data[] = array(
                    'insertedDate' => date("d M Y, g:i A", strtotime($row['insertedDate'] )), 
                    'sifat' => $row['sifat'], 
                    'noAgenda' => $row['noAgenda'], 
                    'hal' => $row['hal'], 
                    'noSurat' => $row['noAgenda']."/".$row['kode_surat']."/".date("Y", strtotime($row['insertedDate'] )), 
                    'id_surat' => $row['id_surat'], 
                    'deskripsi' => $row['deskripsi'],
                    'tglSurat' => $row['tglSurat'],
                    'ada' => "true", 
                );
            }
        }
        else 
        {
           $data[] = array(
                'ada' => "false", 
            );

        }
        return $data;
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
        $id2= $query = $this->db->get('suratkeluar')->row()->s2;
        return $id2;
    }


    public function getLastId($idUser)
    {
        $kolom = array(
           'id' => $idUser,
        );
        $dataUser = $this->M_user1->detail($kolom);
       
        $this->db->select_max('noAgenda', 's');
        $this->db->where('id_fak', $dataUser['id_fak']);
        $this->db->where('id_jur', $dataUser['id_jur']);
        $this->db->where('bagian', $dataUser['bagian']);
        $this->db->where('subagian', $dataUser['subagian']);
        $id= $query = $this->db->get('suratmasuk')->row()->s;

        $id2= $this->getLastNoAgenda($idUser);

        if ($id > $id2 ) 
        {
            return $id;
        }
        else
        {
            return $id2;
        }
    }

    public function detail($where)
    {
        $data = array();
        $query = $this->db->get_where("suratkeluar",$where);
        foreach ($query->result_array() as $row)
        {
            $staff = $row['id_protokol']; 
            $query = $this->db->query("select nama from user where id = '$staff'");
            $nama_staff = $query->row()->nama;

            $row['staff'] = $nama_staff;
            $row['insertedDate'] = date("d M Y, g:i A", strtotime($row['insertedDate'] ));

            $data[] = array(
                'tglSurat' => $row['tglSurat'], 
                'noSurat' => $row['noAgenda'].'/'.$row['kode_surat'].'/'.date("Y", strtotime($row['insertedDate'] )), 
                'insertedDate' => $row['insertedDate'] , 
                'noAgenda' => $row['noAgenda'], 
                'sifat' => $row['sifat'], 
                'hal' => $row['hal'], 
                'kode_surat' => $row['kode_surat'], 
                'id_surat' => $row['id_surat'], 
                'deskripsi' => $row['deskripsi'], 
            );
        }
       return $data;
    }

    public function tambah($data) 
    {
        $query = $this->db->insert("suratkeluar", $data);
        if ($query) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function hapus($data) 
    {
        $query2 = $this->db->delete("suratkeluar", $data);
        if ($query2) 
        {
            $data_tujuan = [
                'status' => 1,
                'eror' => "Berhasil menghapus data surat keluar",
            ];
           return ($data_tujuan);
        }
        else
        {
            $data_tujuan = [
                'status' => 0,
                'eror' => "Gagal menghapus data surat keluar, silahakan coba kembali",
            ];
           return ($data_tujuan);
        }
    }

    public function updateField($fieldName, $value, $id_surat)
    {
        $data = array();

        if ($value!="")
        {
            $text = "UPDATE suratkeluar SET ".$fieldName."='$value' where id_surat = ".$id_surat;
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

    public function traceSurat($id_surat)
    {
        $data = array();
        //dapatkan data terakhir 

       /* $query1 = $this->db->query("SELECT id_surat FROM suratmasuk where id_surat_asal=$id_surat and jenis_asal_surat='keluar'")->result_array();
        foreach ($query1 as $row) 
        {*/
            //$id_surat2 =$row['id_surat'];

            $tanggal_aksi = $this->db->query("SELECT max(tanggal_aksi) as tanggal_aksi from disposisi where id_surat =$id_surat")->row_array()['tanggal_aksi'];
            
            $query3 = $this->db->query("SELECT * FROM disposisi where id_surat=$id_surat and tanggal_aksi='$tanggal_aksi' order by id_disposisi DESC")->result_array();
            foreach ($query3 as $row2) 
            {
                $data_tambahan="";
                $id_disposisi=$row2['id_disposisi'];
                $query2 = $this->db->query("SELECT tujuan from disposisi where id_disposisi=$id_disposisi")->row_array()['tujuan'];
                $data_penerima = $this->db->query("SELECT *  from user where id=$query2")->row_array();

                $id_jur=$data_penerima['id_jur'];
                $id_fk=$data_penerima['id_fak'];
                $id_bagian=$data_penerima['bagian'];
                $id_subbagian=$data_penerima['subagian'];

                $jurusan = $this->db->query("SELECT *  from jurusan where id_jur=$id_jur")->row_array();
                $fakultas = $this->db->query("SELECT *  from fakultas where id_fk=$id_fk")->row_array();
                $bagian = $this->db->query("SELECT *  from bagiansubag where id=$id_bagian  and jenis='bagian'")->row_array();
                $subagian = $this->db->query("SELECT *  from bagiansubag where id=$id_subbagian  and jenis='subbagian'")->row_array();

                if ($id_fk!=0 && $id_jur!=0 && $bagian!=0 && $subagian==0) //bagian jurusan
                {
                    $data_tambahan ="Fk ".$fakultas['nama_fk'].", jurusan ".$jurusan['nama_jur'].", bagian ".$bagian['nama'];
                }
                else if ($id_fk!=0 && $id_jur!=0 && $bagian!=0 && $subagian!=0) // sub bagian jurusan
                {
                    $data_tambahan ="Fk ".$fakultas['nama_fk'].", jurusan ".$jurusan['nama_jur'].", bagian ".$bagian['nama'].", sub bagian ".$subagian['nama'];
                }
                else if ($id_fk!=0 && $id_jur==0 && $bagian!=0 && $subagian!=0) //sub bagian fakultas
                {
                    $data_tambahan =" fakultas ".$fakultas['nama_fk'].", bagian ".$bagian['nama'].", sub bagian ".$subagian['nama'];
                }
                else if ($id_fk!=0 && $id_jur==0 && $bagian!=0 && $subagian==0) //sub bagian fakultas
                {
                    $data_tambahan =" fakultas ".$fakultas['nama_fk'].", sub bagian ".$subagian['nama'];
                }
                else if ($id_fk==0 && $id_jur==0 && $bagian!=0 && $subagian!=0) //sub bagian rektorat
                {
                    $data_tambahan ="bagian ".$bagian['nama'].", sub bagian ".$nama_bagian;
                }
                else if ($id_fk==0 && $id_jur==0 && $bagian!=0 && $subagian==0) //bagian rektorat
                {
                    $data_tambahan =" bagian ".$bagian['nama'];
                }
                else if ($id_fk!=0 && $id_jur==0 && $bagian==0 && $subagian==0) //fakultas
                {
                    $data_tambahan ="fakultas ".$fakultas['nama_fk'];
                }
                else if ($id_fk==0 && $id_jur!=0 && $bagian==0 && $subagian==0) //jurusan
                {
                    $data_tambahan =" jurusan ".$jurusan['nama_jur'];
                }
                 else if ($id_fk!=0 && $id_jur!=0 && $bagian==0 && $subagian==0) //jurusan
                {
                    $data_tambahan ="fakultas ".$fakultas['nama_fk'].", jurusan ".$jurusan['nama_jur'];
                }

                //jika user==protokol, jangan tampilkan nama
                /*if ($data_penerima['level']!='protokol') 
                {*/
                    $data[] = array(
                    'nama' => $data_penerima['nama'], 
                    'data_tambahan' => $data_tambahan,
                    'tanggal' => date("d M Y, g:i A", strtotime($row2['tanggal_aksi'] )),
                    );
                /*}
*/            }
        /*}*/
        return $data;
    }


    public function get_pengirim($idStaff)
    {
        $user = array(
            'id=' => $idStaff,
        );
        $dataStaff= $this->M_user1->detail($user);
        $id_fak_staff=$dataStaff['id_fak'];
        $id_jur_staff=$dataStaff['id_jur'];
        $bagian_staff=$dataStaff['bagian'];
        $subagian_staff=$dataStaff['subagian'];

        $nama_fk="";
        $nama_jur="";
        $nama_bagian="";
        $nama_subagian="";

        $pengirim_2 ="";

        //get nama fakultas sesuai id faklutas staff
        if ($id_fak_staff!=0) 
        {
            $nama_fk = $this->M_fakultas->detail(array('id_fk' =>$id_fak_staff ))['nama_fk'];
        }

        //get nama jurusan sesuai id jurusan staff
        if ($id_jur_staff!=0) 
        {
            $nama_jur = $this->M_jurusan->detail(array('id_jur' =>$id_jur_staff ))['nama_jur'];
        }

        //get nama bagian sesuai id bagian staff
        if ($bagian_staff!=0) 
        {
            $nama_bagian = $this->M_bagianSub->detail(array('id' =>$bagian_staff))['nama'];
        }

        //get nama sub bagian sesuai sub bagian staff
        if ($subagian_staff!=0) 
        {
            $nama_subagian = $this->M_bagianSub->detail(array('id' =>$subagian_staff ))['nama'];
        }

        // susun nama pengirim 
        if ($nama_fk!="" && $nama_jur!="" && $nama_bagian!="" && $nama_subagian=="") //bagian jurusan
        {
            $pengirim_2 ="Fk ".$nama_fk.", jurusan ".$nama_jur.", bagian ".$nama_bagian;
        }
        else if ($nama_fk!="" && $nama_jur!="" && $nama_bagian!="" && $nama_subagian!="") // sub bagian jurusan
        {
            $pengirim_2 ="Fk ".$nama_fk.", jurusan ".$nama_jur.", bagian ".$nama_bagian.", sub bagian ".$nama_subagian;
        }
        else if ($nama_fk!="" && $nama_jur=="" && $nama_bagian!="" && $nama_subagian!="") //sub bagian fakultas
        {
            $pengirim_2 =" fakultas ".$nama_fk.", bagian ".$nama_bagian.", sub bagian ".$nama_subagian;
        }
        else if ($nama_fk!="" && $nama_jur=="" && $nama_bagian!="" && $nama_subagian=="") //sub bagian fakultas
        {
            $pengirim_2 =" fakultas ".$nama_fk.", sub bagian ".$nama_subagian;
        }
        else if ($nama_fk=="" && $nama_jur=="" && $nama_bagian!="" && $nama_subagian!="") //sub bagian rektorat
        {
            $pengirim_2 ="bagian ".$nama_bagian.", sub bagian ".$nama_bagian;
        }
        else if ($nama_fk=="" && $nama_jur=="" && $nama_bagian!="" && $nama_subagian=="") //bagian rektorat
        {
            $pengirim_2 =" bagian ".$nama_bagian;
        }
        else if ($nama_fk!="" && $nama_jur=="" && $nama_bagian=="" && $nama_subagian=="") //fakultas
        {
            $pengirim_2 ="fakultas ".$nama_fk;
        }
        else if ($nama_fk=="" && $nama_jur!="" && $nama_bagian=="" && $nama_subagian=="") //jurusan
        {
            $pengirim_2 =" jurusan ".$nama_jur;
        }
        else{}
        return $pengirim_2;
    }

    ////////////////////////// fungsi di web ///////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////

    public function webUpdateSrt($data, $id_surat)
    {
        $this->db->where('id_surat',$id_surat);
        $this->db->set($data);
        $q1 = $this->db->update('suratkeluar');

       return $q1;
    }

    public function getPemimpin($id_protokol)
    {
        $user = array(
            'id=' => $id_protokol,
        );
        $dataStaff= $this->M_user1->detail($user);
        $id_fak=$dataStaff['id_fak'];
        $id_jur=$dataStaff['id_jur'];
        $bagian=$dataStaff['bagian'];
        $subagian=$dataStaff['subagian'];
        $txt1 ="SELECT id, level from user where id in(SELECT id FROM user where id_fak=$id_fak and id_jur=$id_jur and subagian=$subagian and bagian=$bagian AND active=1) and ";
        $txt2 ="";

        if ($id_fak!=0 && $id_jur!=0 && $bagian!=0 && $subagian==0) //bagian jurusan
        {
            $txt2 ="level='kabag'";
        }
        else if ($id_fak!=0 && $id_jur!=0 && $bagian!=0 && $subagian!=0) // sub bagian jurusan
        {
            $txt2 ="level='kasubag'";
        }
        else if ($id_fak!=0 && $id_jur==0 && $bagian!=0 && $subagian!=0) //sub bagian fakultas
        {
            $txt2 ="level='kasubag'";
        }
        else if ($id_fak!=0 && $id_jur==0 && $bagian!=0 && $subagian==0) //bagian jurusan
        {
            $txt2 ="level='kabag'";
        }
        else if ($id_fak==0 && $id_jur==0 && $bagian!=0 && $subagian!=0) //sub bagian rektorat
        {
            $txt2 ="level='kasubag'";
        }
        else if ($id_fak==0 && $id_jur==0 && $bagian!=0 && $subagian==0) //bagian rektorat
        {
            $txt2 ="level='wr1'";
        }
        else if ($id_fak!=0 && $id_jur==0 && $bagian==0 && $subagian==0) //fakultas
        {
            $txt2 ="level='dekan'";
        }
        else if ($id_fak==0 && $id_jur!=0 && $bagian==0 && $subagian==0) //jurusan
        {
            $txt2 ="level='kajur'";
        }
        else{}
        $query = $this->db->query($txt1.$txt2)->row_array();
        return $query;
    }


}