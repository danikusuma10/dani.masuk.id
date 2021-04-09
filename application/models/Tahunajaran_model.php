<?php

/**
 * 
 */
class Tahunajaran_model extends CI_Model
{

	function ambil_data()
	{
		return $this->db->get('tahun_ajaran');
	}
	function tampil_data()
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
}
