<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{

   
    public function getAllTranksaksi()
    {
        return $this->db->get('tbl_requesttransaksi')->result_array();
    }


}
