<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: PUT, GET, POST");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$params = array('server_key' => 'SB-Mid-server-agj15d5qnNn06ZuKmkPA785C', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('Snapmodel');
	}

	public function index()
	{
		$this->load->view('Pembayaran/Checkout_snap');
	}

	

	public function token()
	{
		$nama = $this->input->post('nama');
		$nohp = $this->input->post('nohp');
		$email = $this->input->post('email');
		$jmlbayar = $this->input->post('jmlbayar');

		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $jmlbayar, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
			'id' => 'a1',
			'price' => $jmlbayar,
			'quantity' => 1,
			'name' => "Pembayaran SPP"
		);

		// Optional
		//$item2_details = array(
		//  'id' => '$id_siswa',
		//  'price' => 20000,
		//  'quantity' => 2,
		//  'name' => "Orange"
		//);

		// Optional
		$item_details = array($item1_details,);
		//$item2_details
		// Optional
		

		// Optional
		$customer_details = array(
			
			'first_name'    => "$nama",
			'email'         => "$email",
			'phone'         => "$nohp",
			
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'minute',
			'duration'  => 60
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		
		$result = json_decode($this->input->post('result_data'));
		$nama= $this->input->post('nama');
		$kelas=$this->input->post('kelas');
		if (isset($result->va_numbers[0]->bank)) {
			$bank = $result->va_numbers[0]->bank;
		} else {
			$bank = '-';
		}
		//bca
		if (isset($result->va_numbers[0]->va_number)) {
			$va_number = $result->va_numbers[0]->va_number;
		} else {
			$va_number = '-';
		}

		
		//mandiri
		if (isset($result->bill_key)) {
			$bill_key = $result->bill_key;
		} else {
			$bill_key = '-';
		}

		if (isset($result->biller_code)) {
			$biller_code = $result->biller_code;
		} else {
			$biller_code = '-';
		}


		$data = [

			'order_id' => $result->order_id,
			'nama'=>$nama,
			'kelas'=>$kelas,
			'transaction_status' => $result->transaction_status,
			'gross_amount' => $result->gross_amount,
			'payment_type' => $result->payment_type,
			'bank' => $bank,
			'va_number' => $va_number,
			'transaction_time' => $result->transaction_time,
			'bill_key' => $bill_key,
			'biller_code' => $biller_code
			
		];

	
		$return = $this->Snapmodel->insert($data);
		if ($return) {
			echo "Success,Lets Make a Pay";
		} else {
			echo "Please try again Request Payment Failed";
		}

		// $result = json_decode($this->input->post('result_data')); 
		// print_r($result);
		
		$this->data['finish'] = json_decode($this->input->post('result_data')); 
		$this->load->view('konfirmasi', $this->data);
	}
}