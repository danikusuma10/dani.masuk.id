

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mymodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function search($keyword)
    {
        $this->db->like('id',$keyword);
        $query  =   $this->db->get('transaksi');
        return $query->result();
    }
}
