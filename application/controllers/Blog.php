<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	 function __construct() {

        parent::__construct();
        //load model web
        $this->load->model('web');
    }

	public function index()
	{
		$blog = $this->web->get_blog();
		$response = array();
		$posts = array();

		foreach ($blog as $hasil)
		{
			$posts[] = array(
				"id_produk" => $hasil->id_produk,
				"image" =>$hasil->image,
				"title" =>$hasil->title,
				"price" =>$hasil->price,
				"link" =>$hasil->link,
				"Deskripsi"=>$hasil->Deskripsi);
		}
		$response['status'] = "200";
		$response['blog'] = $posts;
		header('Content-Type: application/json');
		echo json_encode($response,TRUE);

	}
	public function halamaniklan()
	{	
		$ch = curl_init();

		$url = "http://localhost/latihanujian/index.php/blog";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);     ////// i was missing this line.
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
		$response = json_decode(curl_exec($ch), TRUE);
		echo curl_error($ch);
		curl_close($ch);

		$data = array('blog' => $response['blog']);
		$this->load->view('halamaniklan', $data);
	}
}