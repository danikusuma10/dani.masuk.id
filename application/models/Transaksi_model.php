<?php

/**
 * 
 */
class Transaksi_model extends CI_Model
{

	function ambil_data()
	{
		return $this->db->get('siswa');
	}
	function tampil_data()
	{
		$this->db->select('*');
		$this->db->from('siswa');
		return $query = $this->db->get();
	}

	function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function copy_input($where)
	{
		$this->db->query('INSERT INTO hapus_transaksi (id_transaksi,nis,id_bulan,id_tahun,tanggal_bayar,id)
                      SELECT id_transaksi,nis,id_bulan,id_tahun,tanggal_bayar,id
                      FROM transaksi WHERE id_transaksi = \'' . $where . '\'');
	}

	function tampil_detail($where1)
	{
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}

	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	function hapus_data($where2, $table)
	{
		$this->db->where($where2);
		$this->db->delete($table);
	}
	function cek_login($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	function ambil_databulan()
	{
		return $this->db->get('bulan');
	}

	function tampil_databulan()
	{
		return $this->db->get('bulan');
	}

	function tampil_datatahun($where)
	{
		return $this->db->get('tahun_ajaran');
		$this->db->query('SELECT tahun_ajaran.id_tahun, tahun_ajaran.tahun_ajaran, tahun_ajaran.besar_spp FROM tahun_ajaran JOIN tahun_aktif ON tahun_ajaran.id_tahun=tahun_aktif.id_tahun WHERE nis=\'' . $where . '\'');
	}
	function jumlahtransaksi()
	{
		$query = $this->db->get('transaksi');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	function tampil_transaksi($where1)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('bulan', 'transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'transaksi.id_tahun = tahun_ajaran.id_tahun');
		$this->db->join('user', 'transaksi.id = user.id');
		$this->db->where_in('nis', $where1);
		$this->db->order_by('transaksi.id_tahun,transaksi.id_bulan', 'ASC');
		return $query = $this->db->get();
	}

	function tampil_xtrans($where1)
	{
		$this->db->select('*');
		$this->db->from('hapus_transaksi');
		$this->db->join('bulan', 'hapus_transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'hapus_transaksi.id_tahun = tahun_ajaran.id_tahun');
		$this->db->join('user', 'hapus_transaksi.id = user.id');
		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}

	public function id_transaksi()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(id_transaksi,3)) AS kd_max FROM transaksi WHERE DATE(tanggal_bayar)=CURDATE()");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int) $k->kd_max) + 1;
				$kd = sprintf("%03s", $tmp);
			}
		} else {
			$kd = "001";
		}
		$kode = "SPP";
		date_default_timezone_set('Asia/Jakarta');
		return $kode . date('dmy') . $kd;
	}

	/*LAPORAN TRANSAKSI*/

	public function view_by_date($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'transaksi.nis = siswa.nis');
		$this->db->join('bulan', 'transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = transaksi.id_tahun');
		$this->db->join('user', 'transaksi.id = user.id');
		$this->db->where('tanggal_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
		$this->db->order_by('tanggal_bayar');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}

	public function nis()
	{
		$this->db->select('*');
		$this->db->from('siswa');
		return $query = $this->db->get()->result();
	}

	public function tahun()
	{
		$this->db->select('*');
		$this->db->from('tahun_ajaran');
		return $query = $this->db->get()->result();
	}

	public function view_by_nis($nis)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'transaksi.nis = siswa.nis');
		$this->db->join('bulan', 'transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = transaksi.id_tahun');
		$this->db->join('user', 'transaksi.id = user.id');
		$this->db->where('transaksi.nis', $nis);
		$this->db->order_by('transaksi.id_tahun');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}

	public function view_by_year($tahun)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'transaksi.nis = siswa.nis');
		$this->db->join('bulan', 'transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = transaksi.id_tahun');
		$this->db->join('user', 'transaksi.id = user.id');
		$this->db->where('transaksi.id_tahun="' . $tahun . '"');
		$this->db->order_by('transaksi.id_tahun');
		return $query = $this->db->get();
	}

	function view_all()
	{

		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'siswa.nis = transaksi.nis');
		$this->db->join('bulan', 'transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = transaksi.id_tahun');
		$this->db->join('user', 'transaksi.id = user.id');
		$this->db->order_by('id_transaksi');
		return $this->db->get()->result();
	}

	function update_tunggakan($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
