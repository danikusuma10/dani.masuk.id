<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publik_model extends CI_Model
{

    public function cariHistori()
	{
		$cari = $this->input->GET('cari', TRUE);
		$data = $this->db->query("SELECT * from transaksi where Name like '%$cari%' ");
		return $data->result();
	}

    public function getAllTransaksi()
    {
        $query = "SELECT *
                    FROM `data_siswa` JOIN `transaksi`
                      ON `data_siswa`.`id`= `transaksi`.`id_siswa` 
        ";

        return $this->db->query($query)->result_array();
    }

    public function getTransaksi()
    {
        return $this->db->get('transaksi')->result_array();
    }



    public function getSiswaByNik($nik)
    {
        return $this->db->get_where('data_siswa', ['nik' => $nik])->row_array();
    }

    public function getSiswaById($id)
    {
        return $this->db->get_where('data_siswa', ['id' => $id])->row_array();
    }
}
