<?php

/**
 * 
 */
class Siswa_model extends CI_Model
{

	function ambil_data()
	{
		return $this->db->get('siswa');
	}
	function tampil_data()
	{
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->join('tahun_ajaran', 'siswa.id_tahun = tahun_ajaran.id_tahun');
		return $query = $this->db->get();
	}



	function tampildata_tahun()
	{
		return $this->db->get('tahun_ajaran');
	}

	function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}
	function edit_data($where1, $table)
	{
		return $this->db->get_where($table, $where1);
	}
	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	function hapus_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	function cek_login($table, $where)
	{
		return $this->db->get_where($table, $where);
	}
	function jumlahsiswa()
	{
		$query = $this->db->get('siswa');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
}
