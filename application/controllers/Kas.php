<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
    }


    public function kaskeluar()
    {
        $data['title'] = 'Kas Kas';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');



        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jurnal/kaskeluar', $data);
            $this->load->view('templates/footer');
        } else {
            $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
            $kas =  $this->db->get_where('kas', ['id_transaksi' => $idtransaksi])->row_array();
            if ($kas) {
                $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
            }
            $data = [
                'id_transaksi' => $idtransaksi,
                'tipe_kas' => 'keluar',
                'keterangan' => $this->input->post('keterangan'),
                'tgl_transaksi' => $this->input->post('tanggal'),
                'nominal' => preg_replace('/[^0-9]/', '', $this->input->post('nominal'))
            ];

            $this->db->insert('kas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kas Keluar berhasil ditambah!
          </div>');
            redirect('kas/kaskeluar');
        }
    }

    public function kasmasuk()
    {
        $data['title'] = 'Kas Masuk';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jurnal/kasmasuk', $data);
            $this->load->view('templates/footer');
        } else {
            $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
            $kas =  $this->db->get_where('kas', ['id_transaksi' => $idtransaksi])->row_array();
            if ($kas) {
                $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
            }
            $data = [
                'id_transaksi' => $idtransaksi,
                'tipe_kas' => 'masuk',
                'keterangan' => $this->input->post('keterangan'),
                'tgl_transaksi' => $this->input->post('tanggal'),
                'nominal' => preg_replace('/[^0-9]/', '', $this->input->post('nominal'))
            ];
            $this->db->insert('kas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kas Masuk berhasil ditambah!
          </div>');
            redirect('kas/kasmasuk');
        }
    }


    public function jurnalumum()
    {
        $data['title'] = 'Laporan Kas';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['jurnal'] = $this->db->query
        ("SELECT a.id, a.id_transaksi, a.keterangan, a.tgl_transaksi, kredit, debit 
        FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal 
        order by a.tgl_transaksi asc")->result_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jurnal/jurnalumum', $data);
            $this->load->view('templates/footer');
        } else {

            redirect('kas/bukukasumum');
        }
    }

    


    public function search()
    {
        $data['title'] = 'Laporan Kas';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $tgl_awal = $this->input->post('tanggal_awal');
        $tgl_akhir = $this->input->post('tanggal_akhir');


        $saldo_awal = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

        $query = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi)  between '$tgl_awal' and '$tgl_akhir'  order by a.tgl_transaksi asc";

        $data['saldo_awal'] = $this->db->query($saldo_awal)->result_array();
        $data['jurnal'] = $this->db->query($query)->result_array();

        $this->session->set_flashdata('tglawal', $tgl_awal);
        $this->session->set_flashdata('tglakhir', $tgl_akhir);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jurnal/search', $data);
        $this->load->view('templates/footer');
    }

    public function cetak()
    {
        $type = $this->input->get('p');
        $tgl_awal = $this->input->get('tglawal');
        $tgl_akhir = $this->input->get('tglakhir');
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        if ($type = 'excel') {
            if ($tgl_akhir == null && $tgl_awal == null) {
                $saldo_awal = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a
                LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

                $query = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
               LEFT JOIN jurnal_detail b on a.id = b.id_jurnal  order by a.tgl_transaksi asc";
            } else {
                $saldo_awal = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a
                LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

                $query = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
               LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi)  between '$tgl_awal' and '$tgl_akhir'  order by a.tgl_transaksi asc";
            }

            $data['saldo_awal'] = $this->db->query($saldo_awal)->result_array();
            $data['jurnal'] = $this->db->query($query)->result_array();

            $this->session->set_flashdata('tglawal', $tgl_awal);
            $this->session->set_flashdata('tglakhir', $tgl_akhir);

            $this->load->view('jurnal/excel', $data);
        } else {
            #
        }
    }

}
