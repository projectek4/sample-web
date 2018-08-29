<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Run extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->database('stjm');
		$this->load->helper(array('app', 'html', 'url', 'form'));
		$this->load->model('app_model');
		$this->_init();
	}
	private function _init()
	{
		/* cek status login */
		if(!is_login() & print_url(2) != 'login')
			redirect('run/login','refresh');

		$this->output->set_template('run');

		meta(array('http-equiv'=>'X-UA-Compatible', 'content'=>'IE-edge'));
		meta('viewport', 'width=device-width, initial-scale=1');
		meta('resource-type', 'document');
		meta('robots', 'all, index, follow');
		meta('googleboot', 'all, index, follow');

		//$this->load->css('jquery-ui-1.9.2.custom.css');
		$this->load->css('run.css');

		$this->load->js('jquery.min.js');
		$this->load->js('bootstrap-3.3.7/dist/js/bootstrap.min.js');
		//$this->load->js('jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js');
		//$this->load->js('less.min.js');
		$this->load->js('run.js');
	}
	public function login()
	{	
		$this->output->unset_template();

		if(is_login())
			redirect('run','refresh');

		$this->load->view('run-login');
	}
	public function index()
	{
		$per_page = 10;

		if(empty(print_url(3)))
			$page = 0;
		else
			$page = print_url(3);

		if(empty($this->input->get('order')))
			$order_by = 'DESC';
		else
			$order_by = 'ASC';

		$like = array();
		if(!empty($this->input->get('string'))) {
			$like = array('registrasi.email'=>$this->input->get('string'), 'formulir_event2.nama'=>$this->input->get('string'));
		}

		$this->load->helper(array('text', 'date_format'));     

		$data['page']	= pagination('registrasi','', 3, '/run/index/', $per_page);
		$data['list']	= $this->app_model->list_peserta('registrasi', $like, $per_page, $page, $order='id', $order_by)->result();
		$this->load->view('run-index', $data);
	}
	public function trf()
	{
		$per_page = 10;

		if(empty(print_url(3)))
			$page = 0;
		else
			$page = print_url(3);

		$data['page'] 	= pagination('upload','', 3, '/run/trf/', $per_page);
		$data['list'] 	= $this->app_model->get_all('upload', $per_page, $page, 'id', 'DESC')->result();
		$this->load->view('run-trf', $data);
	}
	public function guestbook()
	{	
		$this->load->helper('text');

		$per_page = 10;

		if(empty(print_url(3)))
			$page = 0;
		else
			$page = print_url(3);

		$data['page'] 	= pagination('guestbook','', 3, '/run/guestbook/', $per_page);
		$data['list'] = $this->app_model->get_all('guestbook', $per_page, $page, 'id', 'DESC')->result();
		$this->load->view('run-guestbook', $data);
	}

	
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */