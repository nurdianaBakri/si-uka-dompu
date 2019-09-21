<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pns extends CI_Model{


  private $tabel = "tb_dbpns";
 
  public function __construct()
  {
    parent::__construct();
  }
 	
  public function getAll()
  {
      $data_balikan = array();
      $query = $this->db->get($this->tabel);
      $data= $query->result_array();

      foreach ($data as $data ) {

        $this->db->where('NIK', $data['NIK']);
        $data_warga = $this->db->get('warga');
        if ($data_warga->num_rows()>0)
        {
          $data_warga = $data_warga->row_array();
          $data_balikan[] = array(
            'data_pns' => $data, 
            'data_warga' => $data_warga, 
          );
        }   
      }
      return $data_balikan;
  }

  public function getById($where)
  {
    $data=$this->db->get_where($this->tabel,$where);
    return $data;
  }

  public function add( $data)
  {
    $this->db->insert($this->tabel,$data);
    return $this->db->insert_id();
  }

  public function update( $where, $data)
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
