<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengajuan extends CI_Model{


  private $tabel = "pengajuan";
 
  public function __construct()
  {
    parent::__construct();
  }
 	
  public function getAll($NIK=null)
  {
    if ($NIK==NULL)
    {
      $data = array( ); 
      // $this->db->where('status_pengajuan',"Dalam Proses");
      // $this->db->where('status_pengajuan',"Terima");
      $query = $this->db->query("select * From pengajuan where status_pengajuan='Dalam Proses' or status_pengajuan='Terima'");
      foreach ($query->result_array() as $key) { 
 
        //get DATA PENGGUNA
        $this->db->select('NAMA');
        $this->db->select('NIP_BARU');
        $this->db->where('NIK', $key['NIK']);
        $pengguna = $this->db->get('pengguna')->row_array();

        $key['nama'] = $pengguna['NAMA'];
        $key['nip_baru'] = $pengguna['NIP_BARU']; 
        $key['status'] = $key['status_pengajuan']; 
        $key['jenis_kp'] = $key['jenis_kp']; 
        $data[] = $key;
      }
      return $data;
    }
    else{
      $where = array('NIK' => $NIK);
      $query = $this->db->get($this->tabel);
      return $query;
    }
  }

  public function getPengajuanDitolak()
  {
    $data = array( ); 
    $this->db->where('status_pengajuan',"Tolak");
    $query = $this->db->get($this->tabel);
    foreach ($query->result_array() as $key) { 

      //get DATA PENGGUNA
      $this->db->select('NAMA');
      $this->db->select('NIP_BARU');
      $this->db->where('NIK', $key['NIK']);
      $pengguna = $this->db->get('pengguna')->row_array();

      $key['nama'] = $pengguna['NAMA'];
      $key['nip_baru'] = $pengguna['NIP_BARU']; 
      $key['status'] = $key['status_pengajuan']; 
      $key['jenis_kp'] = $key['jenis_kp']; 
      $data[] = $key;
    }
    return $data;
  }

  public function add( $data)
  {
    $this->db->insert($this->tabel,$data);
    return $this->db->insert_id();
  }

  public function detail($where)
  {
    $this->db->where($where);
    return $this->db->get($this->tabel);
  }  

  public function update($where, $data)
  {
    $this->db->update($this->tabel, $data, $where);
    return $this->db->affected_rows();
  }

  public function delte($where)
  {
    $this->db->where($where);
   return $this->db->delete($this->tabel);
  }


}
