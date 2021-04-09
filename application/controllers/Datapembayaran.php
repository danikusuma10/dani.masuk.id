<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('email')) {
            redirect(base_url("Auth"));
        }
        $this->load->model('Datapembayaran_model');
        $this->load->helper('url');
    }


    public function index()
    {
        $data['title'] = 'Data Pembayaran SPP Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['siswa'] = $this->Datapembayaran_model->tampil_data()->result();

        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Datapembayaran/Index', $data1);
        $this->load->view('Templates/Footer');
    }

    public function detail($nis)
    {
        $data['id_transaksi'] = $this->Datapembayaran_model->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Data Pembayaran SPP Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('nis' => $nis);
        $data1['siswa'] = $this->Datapembayaran_model->tampil_detail($where1)->result();
        $data2['trans'] = $this->Datapembayaran_model->tampil_transaksi($where1)->result();
        $data2['xtrans'] = $this->Datapembayaran_model->tampil_xtrans($where1)->result();
        $data2['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE nis =' . $nis . '');

        if ($query->num_rows() == 0) {
            $this->load->view('Templates/Header', $data);
            $this->load->view('Templates/Sidebar', $data);
            $this->load->view('Templates/Topbar', $data);
            $this->load->view('Datapembayaran/Detail', $data1);
            $this->load->view('Templates/Footer');
        } else {
            $this->load->view('Templates/Header', $data);
            $this->load->view('Templates/Sidebar', $data);
            $this->load->view('Templates/Topbar', $data);
            $this->load->view('Datapembayaran/Detail', $data1);
            $this->load->view('Datapembayaran/Detail_transaksi', $data2);
            $this->load->view('Datapembayaran/Transaksi_hapus', $data2);
            $this->load->view('Templates/Footer');
        }
    }

    function tambah_aksi()
    {

        $nis = $this->input->post('nis');
        $id = $this->input->post('id');
        $id_transaksi = $this->input->post('id_transaksi');
        $tgl_bayar = $this->input->post('tgl_bayar');
        $id_bulan = $this->input->post('bulan');
        $id_tahun = $this->input->post('tahun_ajaran');

        $data = array(
            'id_transaksi' => $id_transaksi,
            'nis' => $nis,
            'id_bulan' => $id_bulan,
            'id_tahun' => $id_tahun,
            'tanggal_bayar' => $tgl_bayar,
            'id' => $id,
        );

        $query = $this->db->query('SELECT * FROM datapembayaran 
				WHERE id_bulan =' . $id_bulan . ' 
				AND id_tahun=' . $id_tahun . ' AND nis=' . $nis . '');

        if ($query->num_rows() > 0) {
            redirect('Datapembayaran/detail/' . $nis, '');
        } else {
            $this->Datapembayaran_model->input_data($data, 'datapembayaran');
            redirect('Datapembayaran/kurang_tunggakan/' . $nis . '/' . $id_tahun, '');
        }
    }

    function hapus($id_transaksi, $nis, $id_tahun)
    {

        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->Datapembayaran_model->copy_input($where);
        $this->Datapembayaran_model->hapus_data($where2, 'datapembayaran');
        redirect('Datapembayaran/tambah_tunggakan/' . $nis . '/' . $id_tahun, '');
    }

    function tambah_tunggakan($nis, $id_tahun)
    {

        foreach ($this->db->query('SELECT tunggakan.tunggakan, tahun_ajaran.besar_spp FROM tahun_ajaran JOIN tunggakan ON tahun_ajaran.id_tahun = tunggakan.id_tahun WHERE tunggakan.id_tahun=' . $id_tahun . '')->result() as $res); {

            $b_spp = $res->besar_spp;
            $totunggak = $res->tunggakan + $b_spp;
        }

        $data = array(
            'tunggakan' => $totunggak,
        );

        $where = array('nis' => $nis, 'id_tahun' => $id_tahun);
        $this->Datapembayaran_model->update_tunggakan($where, $data, 'tunggakan');
        redirect('Datapembayaran/detail/' . $nis, '');
    }

    function kurang_tunggakan($nis, $id_tahun)
    {

        foreach ($this->db->query('SELECT tunggakan.tunggakan, tahun_ajaran.besar_spp FROM tahun_ajaran JOIN tunggakan ON tahun_ajaran.id_tahun = tunggakan.id_tahun WHERE tunggakan.id_tahun=' . $id_tahun . '')->result() as $res); {

            $b_spp = $res->besar_spp;
            $totunggak = $res->tunggakan - $b_spp;
        }

        $data = array(
            'tunggakan' => $totunggak,
        );

        $where = array('nis' => $nis, 'id_tahun' => $id_tahun);
        $this->Datapembayaran_model->update_tunggakan($where, $data, 'tunggakan');
        redirect('Datapembayaran/detail/' . $nis, '');
    }
    /*LAPORAN TRANSAKSI*/

    function laporan()
    {

        if (isset($_GET['filter']) && !empty($_GET['filter'])) {

            $filter = $_GET['filter'];

            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'Datapembayaran/cetak1?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $transaksi = $this->Datapembayaran_model->view_by_date($tanggal1, $tanggal2)->result();
            } else if ($filter == '2') {
                $nis = $_GET['nis'];
                $ket = 'Data Transaksi dari Siswa dengan Nomor Induk ' . $nis;
                $url_cetak = 'Datapembayaran/cetak2?&nis=' . $nis;
                $transaksi = $this->Datapembayaran_model->view_by_nis($nis)->result();
            } else {
                $tahun = $_GET['tahun'];
                $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
                $url_cetak = 'Datapembayaran/cetak4?&tahun=' . $tahun;
                $transaksi = $this->Datapembayaran_model->view_by_year($tahun)->result();
            }
        } else {

            $ket = 'Semua Data Datapembayaran';
            $url_cetak = 'Datapembayaran/cetak';
            $transaksi = $this->Datapembayaran_model->view_all();
        }

        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['transaksi'] = $transaksi;
        $data['nis'] = $this->Datapembayaran_model->nis();
        $data['tahun'] = $this->Datapembayaran_model->tahun();


        $data['title'] = 'Laporan Data Pembayaran SPP Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Datapembayaran/Laporan', $data);
        $this->load->view('Templates/Footer');
    }

    public function cetak()
    {

        $ket = 'Semua Data Transaksi';

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->Datapembayaran_model->view_all();
        $data['ket'] = $ket;
        $this->load->view('Datapembayaran/Preview', $data);
    }

    public function cetak1()
    {

        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->Datapembayaran_model->view_by_date($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        $this->load->view('Datapembayaran/Preview', $data);
    }

    public function cetak2()
    {

        $nis = $_GET['nis'];
        $ket = 'Data Transaksi dari Siswa dengan Nomor Induk ' . $nis;

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->Datapembayaran_model->view_by_nis($nis)->result();
        $data['ket'] = $ket;
        $this->load->view('Datapembayaran/Preview', $data);
    }

    public function cetak3()
    {

        $kelas = $_GET['kelas'];
        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Kelas ' . $kelas . ' Tahun Ajaran' . $tahun;

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->Datapembayaran_model->view_by_kelas($kelas, $tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('Datapembayaran/Preview', $data);
    }

    public function cetak4()
    {

        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->Datapembayaran_model->view_by_year($tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('Datapembayaran/Preview', $data);
    }
}
