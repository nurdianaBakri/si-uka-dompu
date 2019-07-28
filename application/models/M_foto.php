<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_foto extends CI_Model
{
    public function getAll($data)
    {
        $data2 = array();
        $query = $this->db->get_where("detail_surat", $data);
        foreach ($query->result_array() as $row)
        {
            if ($row['file']=='K') 
            {
               $row['file']="no.jpg";
            }
            $data2[] =  array(
                'id' => $row['id'], 
                'id_surat' => $row['id_surat'], 
                'file' => $row['file'], 
            );
        }
        return $data2;
    }

    public function tambah($data) 
    {
        $query = $this->db->insert("detail_surat", $data);
        if ($query) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function copyFoto($data, $id_surat, $jenis_baru)
    {
        $detailSrtKeluar=true;
        $getallDataFoto= $this->getAll($data);
        foreach ($getallDataFoto as $key) {
            if ($key['file']=="no.jpg") 
            {
                $key['file']="K";
            }

            //masukkan data ke database
            $data2 = array(
                'id_surat' => $id_surat,
                'jenis_surat' => $jenis_baru,
                'file' => $key['file'],
            );
            $detailSrtKeluar = $this->tambah($data2);

            //coppy foto ke folder tujuan
            if ($jenis_baru=="masuk") 
            {
                $path = "assets/files/suratkeluar/";
                $path_tujuan= "assets/files/suratmasuk/";
            }
            else
            {
                $path = "assets/files/suratmasuk/";
                $path_tujuan= "assets/files/suratkeluar/";
            }

            if ($key['file']!='K') 
            {
                $detailSrtKeluar=copy($path.$key['file'], $path_tujuan.$key['file']);
            }
        }

        return $detailSrtKeluar;
    }

    public function download($id_file, $jenis)
    {
        $text = "select file from detail_surat where id = ".$id_file." and jenis_surat=".$jenis;
        $sql2 = $this->db->query($text)->row_array();
        $dat = array();
        $dat = array('file' => $sql2['file'] );
        return $dat;
    }

    public function hapus($data, $path, $jenis_surat) 
    {
        $query1 = $this->db->get_where("detail_surat",$data)->row_array();

        //hapus data pada folder
        $file = $path.$query1['file'];

        //jika file == K, return true 
        if ($query1['file']=="K") 
        {
            return true;
        }
        else
        {
            //JIKA GAGAL MENGHAPUS FILE 
            if (!unlink($file))
            {
                return "gagal mengapus file";
            }
            else
            {
                //cek apakah data cuman 1 row 
                $this->db->where("id_surat",$query1['id_surat']);
                $this->db->where("jenis_surat",$jenis_surat);
                $query2 = $this->db->get("detail_surat");
                if ($query2->num_rows()==1) 
                {
                    $data2 = array(
                        'file' => 'K',
                    );

                    $this->db->where($data);
                    $query = $this->db->update('detail_surat', $data2);
                    return $query;
                }
                else
                {
                    $this->db->where($data);
                    $query = $this->db->delete('detail_surat');
                    return $query;
                }
            } 
        }
     
    }

    public function hapusBanyak($data, $path,$jenis_surat) 
    {
        $sukses_hapus_file=0;
        $query = $this->db->get_where("detail_surat",$data);
        foreach ($query->result_array() as $row)
        {
            //jika data foto tidak ada, hapus data dari folder
            if ($row['file']!='K') 
            {
                //hapus data pada folder
                $file = $path.$row['file'];
                //JIKA GAGAL MENGHAPUS FILE 
                if (!unlink($file))
                {
                   $sukses_hapus_file = 0 ; 
                }
            }
            else{}

            //hapus data dari database
            $arrayName = array(
                'id' => $row['id'], 
                'jenis_surat' => $jenis_surat, 
            );
            $query2 = $this->db->delete("detail_surat", $arrayName);
            if($query2)
            {
                $sukses_hapus_file  = 1;
            }
            else
            {   
                $sukses_hapus_file = 0 ; 
            }
        }
        return $sukses_hapus_file;
    }

    public function webUbahFoto($data, $id_file) 
    {
        $this->db->where('id',$id_file);
        $this->db->set($data);
        $q1 = $this->db->update('detail_surat');
        return $q1;
    }

    public function detail($where) 
    {
        $query = $this->db->get_where("detail_surat",$where)->row_array();
        return $query;
    }
}