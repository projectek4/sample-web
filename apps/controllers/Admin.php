<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->database();
		$this->load->helper(array('html', 'app', 'url'));
		$this->load->model('app_model');
		$this->_init();
	}
	private function _init()
	{
		if(!is_login())
			redirect('login.php','refresh');

		$this->output->set_template('admin');

		//nprogress/nprogress.css
		//iCheck/skins/flat/green.css
		//bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css
		//jqvmap/dist/jqvmap.min.css
		//bootstrap-daterangepicker/daterangepicker.css

		$this->load->css('lib/bootstrap/css/bootstrap.min.css');
		//$this->load->css('vendors/font-awesome/css/font-awesome.min.css');
		$this->load->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		$this->load->css('build/css/custom.min.css');
		
		//$this->load->js('vendors/jquery/dist/jquery.min.js');
		$this->load->js('lib/jquery/jquery.min.js');
		$this->load->js('lib/bootstrap/js/bootstrap.min.js');
		$this->load->js('vendors/fastclick/lib/fastclick.js');
		//$this->load->js('vendors/nprogress/nprogress.js');
		//$this->load->js('vendors/Chart.js/dist/Chart.min.js');
		//$this->load->js('vendors/gauge.js/dist/gauge.min.js');
		//$this->load->js('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js');
		//$this->load->js('vendors/iCheck/icheck.min.js');
		//$this->load->js('vendors/skycons/skycons.js');
		//$this->load->js('vendors/Flot/jquery.flot.js');
		//$this->load->js('vendors/Flot/jquery.flot.pie.js');
		//$this->load->js('vendors/Flot/jquery.flot.time.js');
		//$this->load->js('vendors/Flot/jquery.flot.stack.js');
		//$this->load->js('vendors/Flot/jquery.flot.resize.js');
		//$this->load->js('vendors/flot.orderbars/js/jquery.flot.orderBars.js');
		//$this->load->js('vendors/flot-spline/js/jquery.flot.spline.min.js');
		//$this->load->js('vendors/flot.curvedlines/curvedLines.js');
		//$this->load->js('vendors/DateJS/build/date.js');
		//$this->load->js('vendors/jqvmap/dist/jquery.vmap.js');
		//$this->load->js('vendors/jqvmap/dist/maps/jquery.vmap.world.js');
		//$this->load->js('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js');
		//$this->load->js('vendors/moment/min/moment.min.js');
		//$this->load->js('vendors/bootstrap-daterangepicker/daterangepicker.js');
		$this->load->js('build/js/custom.min.js');
		//$this->load->js('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js');

		//$this->load->js('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
		//$this->load->js('https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js');


	}
	/* ckeditor config */
	function editor($width,$height) {
		$this->ckeditor->basePath 					= base_url('assets/ckeditor/');
		$this->ckeditor->config['toolbar']			= 'Basic';
		$this->ckeditor->config['language'] 		= 'en';
		$this->ckeditor->config['width'] 			= $width;
		$this->ckeditor->config['height'] 			= $height;

		/* edit config.php di assets/ckfinder/config.php line 64 */
		
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../assets/ckfinder');
	}

	public function index()
	{
		$data['heading'] = 'Dasboard';
		$this->load->view('admin-index', $data);
	}
	public function artikel()
	{
		$this->load->js('vendors/datatables.net/js/jquery.dataTables.min.js');
		$this->load->js('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');
		$this->load->css('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css');

		switch (print_url(3)) {
			case 'berita':
				$data['list'] 			= $this->app_model->berita('article')->result();
				$data['heading'] 	= 'Daftar Berita';
				break;
			case 'halaman':
				$data['list'] 			= $this->app_model->berita('page')->result();
				$data['heading'] 	= 'Daftar Halaman';
				break;
			case 'agenda':
				$data['list'] 			= $this->app_model->berita('agenda')->result();
				$data['heading'] 	= 'Daftar Agenda';
				break;
			default:
				$data['list'] 			= $this->app_model->get_all('posting_category')->result();
				$data['heading'] 	= 'Daftar Kategori Berita';
				break;
		}
		$this->load->view('admin-artikel', $data);
	}
	public function tambah()
	{
		error_reporting(0);

		$this->load->library(array('form_validation', 'ckeditor', 'ckfinder'));
		$this->load->helper(array('form', 'bootstrap', 'stemming'));

		if (print_url(3) == 'berita') {
			$this->form_validation->set_rules('title', 'judul artikel', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('content', 'konten artikel', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('category', 'Kategoti berita', 'trim|required');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		} elseif (print_url(3) == 'agenda') {
			$this->form_validation->set_rules('title', 'judul artikel', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('content', 'konten artikel', 'trim|required|min_length[5]');
		} else {
			$this->form_validation->set_rules('value', 'Kategoti berita', 'trim|required');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		}

		$width 	= '100%';
		$height = '300px';
		$this->editor($width,$height);

		if ($this->form_validation->run()) {
			if (print_url(3) == 'berita' OR print_url(3) == 'agenda') {
				$data 							= array();
				$konten 						= explode('src="', $this->input->post('content'));
				$pecah1 						= explode('"', $konten[1]);
				$data['media'] 				= $pecah1[0];
				$data['id'] 					= $this->app_model->create_id('posting');
				$data['date_posting'] 	= date('Y-m-d H:i:s');
				$data['category'] 			= $this->input->post('category');
				$data['author']  			= print_session('id');
				$data['type'] 				= $this->input->post('type');
				$data['title'] 					= $this->input->post('title');
				$data['url']					= str_replace(' ', '-', $this->input->post('title')).'.html';
				$data['content'] 			= $this->input->post('content');
				$data['active'] 				= $this->input->post('active');

				$this->app_model->add_field('posting', $data);
			} else {
				$data = array('id'=>$this->app_model->create_id('posting_category'),
					'value'=>$this->input->post('value'));
				$this->app_model->add_field('posting_category', $data); 
			}
			
			redirect('admin/artikel/'.$this->input->post('url'),'refresh');
		} else {
			switch (print_url(3)) {
				case 'berita':
					$data['kategori'] = $this->app_model->get_where('posting_category', array('active'=>1))->result();
					break;
			}
			$data['heading'] = 'Form Artikel';
			$this->load->view('admin-tambah', $data);
		}
	}
	public function edit()
	{
		error_reporting(0);

		$this->load->library(array('form_validation', 'ckeditor', 'ckfinder'));
		$this->load->helper(array('form', 'bootstrap', 'stemming'));

		if (print_url(3) == 'berita') {
			$this->form_validation->set_rules('title', 'judul artikel', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('content', 'konten artikel', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('category', 'Kategoti berita', 'trim|required');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		} else {
			$this->form_validation->set_rules('value', 'Kategoti berita', 'trim|required');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		}


		$width 	= '100%';
		$height = '300px';
		$this->editor($width,$height);

		if ($this->form_validation->run()) {
			if (print_url(3) == 'berita') {
				$data 							= array();
				$konten 						= explode('src="', $this->input->post('content'));
				$pecah1 						= explode('"', $konten[1]);
				$data['media'] 				= $pecah1[0];
				$data['date_modified'] 	= date('Y-m-d H:i:s');
				$data['category'] 			= $this->input->post('category');
				//$data['author']  			= print_session('id');
				$data['type'] 				= $this->input->post('type');
				$data['title'] 					= $this->input->post('title');
				$data['url']					= str_replace(' ', '-', $this->input->post('title')).'.html';
				$data['content'] 			= $this->input->post('content');
				$data['active'] 				= $this->input->post('active');

				$id 								= array('id'=>$this->input->post('id'));

				$this->app_model->update_field('posting', $data, $id);
			} else {
				$id 								= array('id'=>$this->input->post('id'));
				$data 							= array('value'=>str_replace(' ', '-', $this->input->post('value')));
				$this->app_model->update_field('posting_category', $data, $id); 
			}
			
			redirect('admin/artikel/'.$this->input->post('url'),'refresh');
		} else {
			switch (print_url(3)) {
				case 'berita':
				case 'halaman':
					$data['kategori'] 		= $this->app_model->get_where('posting_category', array('active'=>1))->result();
					$data['detail'] 			= $this->app_model->get_where('posting', array('id'=>print_url(4)))->result();
					break;
				default:
					$data['detail'] 			= $this->app_model->get_where('posting_category', array('id'=>print_url(4)))->result();
					break;
			}
			$data['heading'] = 'Form Edit';
			$this->load->view('admin-edit', $data);
		}
	}
	public function media()
	{
		$this->load->js('vendors/datatables.net/js/jquery.dataTables.min.js');
		$this->load->js('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');
		$this->load->css('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css');

		switch (print_url(3)) {
			case 'foto':
				$data['list'] = $this->app_model->get_where('upload', array('type'=>'images'))->result();
				break;
			case 'video':
				$data['list'] = $this->app_model->get_where('upload', array('type'=>'video'))->result();
				break;
			default:
				$data['list'] = $this->app_model->get_where('upload', array('type'=>'file'))->result();
				break;
		}
		$data['heading'] = 'Berkas Unggahan';
		$this->load->view('admin-media', $data);
	}
	public function unggah()
	{
		error_reporting(1);

		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));

		if ($this->input->post('url') == 'video') {
			$this->form_validation->set_rules('title', 'Judul video', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('url', 'URL Youtube', 'trim|required');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			if ($this->form_validation->run()) {
				$data = array('id'=>$this->app_model->create_id('upload'),
					'date'=>date('Y-m-d H:i:s'),
					'type'=>'video',
					'media'=>$this->input->post('media'),
					'title'=>$this->input->post('title'),
					'format'=>'video/flash');
				$this->app_model->add_field('upload', $data);
				redirect('admin/media/'.$this->input->post('url'),'refresh');
			} else {
				$data['heading'] = ucwords('form unggah '.print_url(3));
				$this->load->view('admin-unggah', $data);
			}
		} else {
			$this->form_validation->set_rules('title', 'Judul berkas', 'trim|required|min_length[5]');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

			$config['upload_path']				= '././assets/media/upload/';
			$config['allowed_types']			= 'gif|jpg|png|pdf|docx|xlsx';
			$config['max_size']					= 2000;
			$config['max_width']				= 2000;
			$config['max_height']				= 2000;
				
			$this->load->library('upload', $config);

			if ($this->form_validation->run()) {
				if ($this->upload->do_upload('file')){
					$data = array('id'=>$this->app_model->create_id('upload'),
						'date'=>date('Y-m-d H:i:s'),
						'type'=>$this->input->post('type'),
						'media'=>$this->upload->data('file_name'),
						'title'=>$this->input->post('title'),
						'format'=>$this->upload->data('file_type'));
					$this->app_model->add_field('upload', $data);

				} else {
					$data['heading'] = ucwords('form unggah '.print_url(3));
					$this->load->view('admin-unggah', $data);
				}
				redirect('admin/media/'.$this->input->post('url'),'refresh');
			} else {
				$data['heading'] = ucwords('form unggah '.print_url(3));
				$this->load->view('admin-unggah', $data);
			}
		}
	}
	public function delete()
	{
		$id = array('id'=>print_url(6));
		$this->app_model->delete_field(print_url(5), $id);
		redirect('admin/'.print_url(3).'/'.print_url(4),'refresh');
	}
	public function kotak()
	{
		switch (print_url(3)) {
			case 'kuesioner':
				$data['list'] 		= $this->app_model->polling()->result();
				$data['heading']	= 'Kuesioner';
				break;
			
			default:
				$data['list']		= $this->app_model->get_all('saran')->result();
				$data['heading']	= 'Kotak Saran';
				break;
		}
		$this->load->view('admin-kotak', $data);
	}
	public function pengguna()
	{
		$this->load->library(array('form_validation'));
		$this->form_validation->set_rules('username', 'Judul berkas', 'trim|required');
		$data['heading'] = 'Manajemen Pengguna';

		switch (print_url(3)) {
			case 'daftar':
				$data['list'] = $this->app_model->get_all('user')->result();
				break;
			case 'hapus':
				$this->app_model->delete_field('user', array('id'=>print_url(4)));
				redirect('admin/pengguna/daftar','refresh');
				break;
			default:
				if ($this->form_validation->run()) {
					$id 	= array('id'=>$this->input->post('id'));
					$data = array();
						$data['username'] 	= $this->input->post('username');
						$data['nama'] 			= $this->input->post('nama');
						$data['level' ]			= $this->input->post('level');
					if($this->input->post('password'))
						$data['password'] 	= encrypt_this($this->input->post('password'));
					$this->app_model->update_field('user', $data, $id);
					redirect('admin/pengguna/daftar','refresh');
				} else {
					$data['detail'] = $this->app_model->get_where('user', array('id'=>print_url(3)))->result();
				}
				break;
		}
		$this->load->view('admin-pengguna', $data);
	}
	public function website()
	{
		$this->load->library(array('form_validation'));
		$this->form_validation->set_rules('name', 'Judul berkas', 'trim|required');

		$data['heading'] = 'Website';

		if (empty(print_url(3))) {
			$data['list'] = $this->app_model->get_all('website')->result();
		} else {
			if ($this->form_validation->run()) {
				$id 	= array('id'=>$this->input->post('id'));
				$data = array();
				$data['name'] 	= $this->input->post('name');
				$data['value'] 	= $this->input->post('value');

				$this->app_model->update_field('website', $data, $id);
				redirect('admin/website');
			} else {
				$data['detail'] = $this->app_model->get_where('website', array('id'=>print_url(3)))->result();
			}
		}
		$this->load->view('admin-website', $data);
	}
	public function profil()
	{
		$this->load->library(array('form_validation'));
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama admin', 'trim|required');

		if ($this->form_validation->run()) {
			$id 								= array('id'=>print_session('id'));
			$data 							= array();
			$data['username'] 		= $this->input->post('username');
			$data['nama'] 				= $this->input->post('nama');
			
			if($this->input->post('password'))
				$data['password'] 	= encrypt_this($this->input->post('password'));

			$this->app_model->update_field('user', $data, $id);
			redirect('admin/profil');
		} else {
			$data['detail'] 				= $this->app_model->get_where('user', array('id'=>print_session('id')))->result();
		}
		$data['heading']				= 'Edit Profil';
		$this->load->view('admin-profil', $data);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */