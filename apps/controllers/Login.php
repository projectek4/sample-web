<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->database();
		$this->load->helper(array('app', 'html', 'form', 'url'));
		$this->load->model('app_model');
	}
	public function index()
	{
		//if(is_login())
		//	redirect('posting/index','refresh');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Alamat email', 'trim|required|callback_check_user');
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|required|callback_check_password');
		$this->form_validation->set_error_delimiters('<span class="text-error">', '</span>');

		if ($this->form_validation->run() == TRUE) {
			$id = print_data('get_where', array('user', array('username'=>$this->input->post('username'))), 'id');
			
			add_session('id', $id);
			add_session('nama', print_data('get_where', array('user', array('username'=>$this->input->post('username'))), 'nama'));
			add_session('level', print_data('get_where', array('user', array('username'=>$this->input->post('username'))), 'level'));
			add_cookie('login', md5($this->input->post('username')));
			$this->app_model->update_field('user', array('cookie'=>md5($this->input->post('username'))), array('username'=>$this->input->post('username')));
			redirect('admin/index','refresh');
		} else {
			$this->load->view('login-index');
		}
	}
	public function check_user()
	{
		if(empty($this->input->post('username'))) {
			$this->form_validation->set_message('check_user', 'Username harus diisi');
			return FALSE;
		}elseif($this->app_model->check_exist('user', array('username'=>$this->input->post('username'), 'active'=>1)) == FALSE) {
			$this->form_validation->set_message('check_user', 'username tidak ditemukan di basis data');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_password()
	{
		$pass 	= print_data('get_where', array('user', array('username'=>$this->input->post('username'))), 'password');

		if (empty($this->input->post('password'))) {
			$this->form_validation->set_message('check_password', 'kata sandi harus diisi');
			return FALSE;
		}elseif($this->app_model->check_exist('user', array('username'=>$this->input->post('username'), 'active'=>1)) == FALSE) {
			$this->form_validation->set_message('check_password', 'kata sandi tidak cocok dengan username apapun');
			return FALSE;
		} elseif($this->app_model->check_exist('user', array('username'=>$this->input->post('username'), 'active'=>1)) == TRUE and check_this($this->input->post('password'), $pass) == FALSE) {
			$this->form_validation->set_message('check_password', 'kata sandi yg anda masukkan salah');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function logout()
	{
		$this->app_model->update_field('user', array('cookie'=>''), array('id'=>print_session('id')));
		remove_session('id');
		remove_session('nama');
		remove_session('level');
		remove_cookie('login');
		redirect('login.php','refresh');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */