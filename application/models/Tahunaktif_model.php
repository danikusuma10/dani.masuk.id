<?php

/**
 * 
 */
class Tahunaktif_model extends CI_Model
{

	function ambil_data()
	{
		return $this->db->get('tahun_aktif');
	}
	function tampil_data()
	{
		$this->db->select('*');
		$this->db->from('tahun_aktif');
		$this->db->join('siswa', 'tahun_aktif.nis = siswa.nis');
		$this->db->join('tahun_ajaran', 'tahun_aktif.id_tahun = tahun_ajaran.id_tahun');
		$this->db->order_by('siswa.nis', 'ASC');
		$query = $this->db->get();
		return $query->result();
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

	function input_data_tunggakan($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function hapus_tunggakan($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}
