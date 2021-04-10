<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->database();
        $this->load->helper('url');
        $params = array('server_key' => 'SB-Mid-server-agj15d5qnNn06ZuKmkPA785C', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
        $this->load->model('Pembayaran_model');
    }


    public function index()
    {
        $this->load->view('Templates/Header');
        $this->load->view('Pembayaran/Bayar');
        $this->load->view('Templates/Footer');
    }

    public function requesttransaksi()
    {
        
        $data['title'] = 'Transaksi Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['tranksaksi'] = $this->Pembayaran_model->getAllTranksaksi();

        $this->load->view('Templates/Header', $data);
        $this->load->view('templates/Sidebar', $data);
        $this->load->view('templates/Topbar', $data);
        $this->load->view('Pembayaran/Data_tranksaksi', $data);
        $this->load->view('Templates/Footer');
    }

    public function cektransaksi()
    {
       
        $this->load->view('Pembayaran/Transaction');
    }
    public function status($order_id)
	{
		echo 'test get status </br>';
		
		print_r($this->veritrans->status($order_id));
		
		

		$response = $this->veritrans->status(($order_id));
		$transaction_status = $response->transaction_status;
		$settlement_time= $response->settlement_time;
	
		

		$update = $this->db->query("update tbl_requesttransaksi set transaction_status='$transaction_status', settlement_time='$settlement_time'   where order_id='$order_id' ");
		if($update){
			echo "status tranksaksi berhasil di update";
		}
		else {echo "status tarnksaksi gagal di update";
			
		}
	}

		
}
